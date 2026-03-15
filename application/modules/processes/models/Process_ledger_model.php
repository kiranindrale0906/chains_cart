<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_ledger_model extends BaseModel {
  protected $table_name = "process_ledgers";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('processes/process_model', 'melting_lots/melting_lot_model', 'processes/process_out_wastage_detail_model',
                             'issue_departments/issue_department_detail_model', 'issue_departments/issue_department_model'));
    $this->set_fields();
  }

  public function validation_rules($klass='record') {
    $rules = array(array('field' => 'process_ledgers[lot_no]', 'label' => 'Lot no',
                         'rules' => 'trim|required'));
    return $rules;
  }

  public function check_process_balance_by_lot_no($lot_no) {
    $where = array('lot_no' => $lot_no);
    $fields = 'id, department_name, ';
    $fields .= ' in_weight - out_weight - next_department_wastage + '.implode(' + ', $this->in_array);
    $fields .= ' - ('.implode(' + ', $this->out_array).') ';
    $fields .= ' - ('.implode(' + ', $this->out_return_array).') ';
    $fields .= ' - ('.implode(' + ', $this->wastage_array).') as balance';
    $processes = $this->process_model->get($fields, $where);
    return $processes; 
  }

  public function create_ledger_entries() {
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '3000');
    $this->db->query('truncate table process_ledgers');

    $melting_lots = $this->melting_lot_model->get('');
    //$melting_lots = $this->melting_lot_model->get('', array('parent_lot_name' => '75IN-17'));
    foreach ($melting_lots as $melting_lot)   $this->create_ledger_entry_for_melting_lot($melting_lot);
    
    $processes = $this->process_model->get('');
    //$processes = $this->process_model->get('', array('product_name' => 'Daily Drawer'));
    foreach ($processes as $process) {
      $this->create_ledger_entries_for_process($process);
      $this->create_daily_drawer_out_and_balance_ledger_entries($process);
      $this->create_ghiss_out_and_balance_ledger_entries($process);
      $this->create_fire_tounch_out_and_balance_ledger_entries($process);
      $this->create_hcl_ghiss_out_and_balance_ledger_entries($process);
      $this->create_hcl_wastage_out_and_balance_ledger_entries($process);
      //$this->create_loss_out_and_balance_ledger_entries($process);
    }

    $this->create_process_out_wastage_details_loss_out_ledger_entries();

    $issue_department_details = $this->issue_department_detail_model->get('', 
                                  array('field_name' => array('Daily Drawer Wastage', 'Cutting Ghiss', 'Ice Cutting Ghiss',
                                                              'Castic Loss', 'Ghiss Melting Loss')));
    foreach ($issue_department_details as $issue_detail) $this->create_ledger_entry_for_issue_department_detail($issue_detail);
    
    $issue_departments = $this->issue_department_model->get('', array('product_name' => 'GPC Powder'));
    foreach ($issue_departments as $issue_department) $this->create_ledger_entry_for_issue_department($issue_department);
  }
  
  private function create_ledger_entry_for_melting_lot($melting_lot) {
    $ledger =  array();
    $ledger['product_name'] = $melting_lot['process_name'];
    if ($melting_lot['parent_lot_name'] != '')
      $ledger['lot_no'] = 'Parent Lot: '.$melting_lot['parent_lot_name'];
    else
      $ledger['lot_no']     = $melting_lot['lot_no'];
    $ledger['field_name'] = 'Melting Lot Gross Wt';

    $ledger['in_weight']  = $melting_lot['gross_weight'];
    $ledger['purity']     = 100;
    $ledger['lot_purity'] = $melting_lot['lot_purity'];
  
    $ledger_obj = new Process_ledger_model($ledger);
    $ledger_obj->store();
  }

  private function create_ledger_entries_for_process($process) {
    foreach ($this->in_array as $field) $this->create_ledger_entry($process, $field, 'in');
    foreach ($this->out_array as $field) $this->create_ledger_entry($process, $field, 'out');
    foreach ($this->out_return_array as $field) $this->create_ledger_entry($process, $field, 'out');
    foreach ($this->wastage_array as $field) $this->create_ledger_entry($process, $field, 'wastage');
    foreach ($this->wastage_array_in_process as $field) $this->create_ledger_entry($process, $field, 'wastage');
  }

  private function create_daily_drawer_out_and_balance_ledger_entries($process) {
    if (   $process['product_name']=='Daily Drawer' 
        && $process['department_name']=='Melting') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Daily Drawer Wastage Auto Entry');
    }

    if ($process['balance_daily_drawer_wastage'] != 0)
      $this->create_ledger_entry($process, 'balance_daily_drawer_wastage', 'out', 1, 'Daily Drawer Wastage Auto Entry');
  }

  private function create_ghiss_out_and_balance_ledger_entries($process) {
    if (   $process['product_name']=='Ghiss Out' 
        && $process['process_name'] == 'Melting' 
        && $process['department_name']=='Ghiss Melting') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Ghiss Auto Entry');
    }

    if ($process['balance_ghiss'] != 0)
      $this->create_ledger_entry($process, 'balance_ghiss', 'out', 1, 'Ghiss Auto Entry');

    //this is required as both out_ghiss and out_tounch_ghiss are melting together in Ghiss Melting Process
    if ($process['balance_tounch_ghiss'] != 0)
      $this->create_ledger_entry($process, 'balance_tounch_ghiss', 'out', 1, 'Ghiss Auto Entry');
  }

  private function create_fire_tounch_out_and_balance_ledger_entries($process) {
    if ($process['fire_tounch_out'] != 0) 
        $this->create_ledger_entry($process, 'fire_tounch_out', 'out', 1, 'Fire Tounch In Auto Entry');
      
      if ($process['process_name'] == 'Fire Tounch Daily Drawer Wastage')
        $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Fire Tounch In Auto Entry');

      if (round($process['fire_tounch_in'] - $process['fire_tounch_out'] - $process['fire_tounch_gross'],4) != 0) {
        $this->create_ledger_entry($process, 'balance_fire_tounch_out', 'out', 1, 'Fire Tounch In Auto Entry', 
                                    $process['fire_tounch_in'] - $process['fire_tounch_out'] - $process['fire_tounch_gross']);
      }
  }

  private function create_hcl_ghiss_out_and_balance_ledger_entries($process) {
    if (   $process['product_name']=='HCL Ghiss Out' 
        && $process['process_name']=='Melting'
        && $process['department_name']=='HCL Process') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Hcl Ghiss Auto Entry');
    }

    if ($process['balance_hcl_ghiss'] != 0)
      $this->create_ledger_entry($process, 'balance_hcl_ghiss', 'out', 1, 'Hcl Ghiss Auto Entry');
  }

  private function create_hcl_wastage_out_and_balance_ledger_entries($process) {
    if (   $process['product_name']=='HCL' 
        && $process['process_name']=='HCL Melting Process'
        && $process['department_name']=='HCL Process') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Hcl Wastage Auto Entry');
    }

    if ($process['balance_hcl_wastage'] != 0)
      $this->create_ledger_entry($process, 'balance_hcl_wastage', 'out', 1, 'Hcl Wastage Auto Entry');
  }

  private function create_process_out_wastage_details_loss_out_ledger_entries() {
    $loss_out_in_weight = $this->process_model->find('sum(in_weight) as in_weight', 
                                                      array('product_name' => 'Loss Out',
                                                            'process_name' => 'Melting',
                                                            'department_name' => 'Loss Melting'));
    $this->create_ledger_entry($loss_out_in_weight, 'loss_out_in_weight', 'in', 1, 'Loss Out Process Wastage', $loss_out_in_weight['in_weight']);

    //$loss_out_out_weight = $this->process_out_wastage_detail_model->find('sum(out_weight) as out_weight', 
    //                                                  array('field_name' => 'Loss Out'));
    //$this->create_ledger_entry($process, 'loss_out_in_weight', 'out', 1, 'Loss Out Process Wastage', $loss_out_out_weight['out_weight']);
  }  
    
  private function create_loss_out_and_balance_ledger_entries($process) {
    if (   $process['product_name']=='Loss Out' 
        && $process['process_name']=='Melting'
        && $process['department_name']=='Loss Melting') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Loss Auto Entry');
    }

    if (   $process['product_name']=='Melting Loss Out' 
        && $process['process_name']=='Melting'
        && $process['department_name']=='Loss Melting') {
      $this->create_ledger_entry($process, 'in_weight', 'in');
      $this->create_ledger_entry($process, 'in_weight', 'out', 1, 'Loss Auto Entry');
    }

    if ($process['balance_loss'] != 0)
      $this->create_ledger_entry($process, 'balance_loss', 'out', 1, 'Loss Auto Entry');
  }


  private function create_ledger_entry($process, $field_name, $type, $is_wastage = 0, $product_name = '', $value = 0) {
    if ($process[$field_name]==0 && $value==0) return;

    $ledger =  array();
    
    //We will need to set the wastage_in_lot as 1 for tounch out and tounch ghiss
    //This is because both these fields are present in the processes table and do not have a provision of a separate
    //process to create out records
    //If we do not make wastage_in_lot = 1, then in_weight and out_weight for the lot will not match
    if (   $is_wastage==1
        || $field_name == 'tounch_out'
        || $field_name == 'tounch_ghiss') 
      $ledger['wastage_in_lot'] = 1;

    if ($process['process_name']=='Fire Tounch Daily Drawer Wastage') 
      $ledger['process_id'] = $process['parent_id'];
    else
      $ledger['process_id'] = $process['id'];
        
    if ($process['parent_lot_id'] > 0)
      $ledger['lot_no'] = 'Parent Lot: '.$process['parent_lot_name'];
    elseif (in_array($process['product_name'], array('Issue', 'Daily Drawer Receipt'))) {
      $ledger['lot_no'] = ($process['type'] == 'GPC Powder') ? 'GPC Powder ' : 'Daily Drawer Transfer ';
      $ledger['lot_no'] .= ($process['parent_id'] > 0) ?  $process['parent_id'] : $process['id'];
    } else
      $ledger['lot_no'] = $process['lot_no'];
  
        
    $ledger['parent_lot_id'] = $process['parent_lot_id'];
    $ledger['parent_id'] = $process['parent_id'];
    $ledger['parent_process_detail_id'] = $process['parent_process_detail_id'];
    $ledger['product_name'] = $product_name=='' ? $this->get_product_name($process, $field_name, $type, $is_wastage) : $product_name;
    $ledger['process_name'] = $process['process_name'];
    $ledger['department_name'] = $process['department_name'];
    $ledger['field_name'] = $field_name;

    if ($value != 0) $process[$field_name] = $value;
    $ledger['in_weight'] = $type == 'in' ? $process[$field_name] : 0;
    $ledger['out_weight'] = $type != 'in' ? $process[$field_name] : 0;
    
    //Daily Drawer Wastage is used to transfer Daily Drawer In Weight to Daily Drawer Wastage
    //daily_drawer_out_weight is issued and daily_drawer_wastage is received
    //we will convert daily_drawer_out_weight is in_weight and use daily_drawer_wastage as out weight
    if (   ($process['product_name']=='Daily Drawer Wastage' && $field_name=='daily_drawer_out_weight')
        || ($process['product_name']=='Daily Drawer Receipt' && $field_name=='daily_drawer_in_weight')) {
      $ledger['in_weight'] = $ledger['out_weight'];
      $ledger['out_weight'] = 0;
    }

    if ($type == 'in') {
      $ledger['purity'] = $process['in_purity'];
      $ledger['lot_purity'] = $process['in_lot_purity'];
    } elseif ($type == 'out') {
      $ledger['purity'] = $process['out_purity'];
      $ledger['lot_purity'] = $process['out_lot_purity'];
    } elseif ($type == 'wastage') {
      $ledger['purity'] = $process['wastage_purity'];
      $ledger['lot_purity'] = $process['wastage_lot_purity'];
    }

    $ledger_obj = new Process_ledger_model($ledger);
    $ledger_obj->store();
  
    if ($type=='wastage'
        && !in_array($process['product_name'], array('Issue', 'Daily Drawer Receipt'))) 
      $this->create_ledger_entry($process, $field_name, 'in', 1);    

    if (in_array($field_name, $this->out_return_array) && $type=='out'){
      $this->create_ledger_entry($process, $field_name, 'in', 0);    
    }
  }

  private function create_ledger_entry_for_issue_department($issue_department) {
    $ledger =  array();
    if ($issue_department['product_name'] == 'GPC Powder') 
      $ledger['product_name'] = 'GPC Powder';
    
    $ledger['lot_no']     = 'Issue Department '.$issue_department['id'];
    $ledger['field_name'] = 'daily_drawer_out_weight';
    $ledger['out_weight'] = $issue_department['in_weight'];
    $ledger['purity']     = 100;
    $ledger['lot_purity'] = $issue_department['in_purity'];
  
    $ledger_obj = new Process_ledger_model($ledger);
    $ledger_obj->store();
  }

  private function create_ledger_entry_for_issue_department_detail($issue_detail) {
    $ledger =  array();
    if ($issue_detail['field_name'] == 'Cutting Ghiss' || $issue_detail['field_name'] == 'Ice Cutting Ghiss') 
      $ledger['product_name'] = 'Ghiss Auto Entry';
    elseif ($issue_detail['field_name'] == 'Ghiss Melting Loss' || $issue_detail['field_name'] == 'Castic Loss') 
      $ledger['product_name'] = 'Loss Auto Entry';
    else
      $ledger['product_name'] = $issue_detail['field_name'].' Auto Entry';
    $process = $this->process_model->find('lot_no, wastage_lot_purity', array('id' => $issue_detail['process_id']));
    $ledger['lot_no']     = $process['lot_no'];
    $ledger['field_name'] = $issue_detail['field_name'];
    $ledger['out_weight'] = $issue_detail['out_weight'];
    $ledger['purity']     = 100;
    $ledger['lot_purity'] = $process['wastage_lot_purity'];
  
    $ledger_obj = new Process_ledger_model($ledger);
    $ledger_obj->store();
  }

  private function get_product_name($process, $field_name, $type, $is_wastage) {
    if ($process['process_name']=='Refresh Final Process')    return 'Refresh';

    //this is required as both out_ghiss and out_tounch_ghiss are melting together in Ghiss Melting Process
    elseif ($is_wastage==1 && $field_name == 'tounch_ghiss')   return 'Ghiss Auto Entry';
    elseif ($is_wastage==1)                                   return ucwords(str_replace("_", " ", $field_name)).' Auto Entry';
    elseif ($field_name == 'tounch_out')                      return 'Tounch Out';
    elseif ($field_name=='tounch_ghiss')                      return 'Tounch Ghiss';
    elseif ($process['product_name']=='HCL')                  return 'Hcl Wastage';
    elseif ($process['product_name']=='Daily Drawer Wastage') return 'Daily Drawer Out to Wastage';
    elseif ($process['product_name']=='Daily Drawer')         return 'Daily Drawer Wastage';
    elseif ($process['product_name']=='Issue')                return 'Daily Drawer Transfer';
    elseif ($process['product_name']=='Daily Drawer Receipt' && $process['type']=='GPC Powder') return 'GPC Powder';
    elseif ($process['product_name']=='Daily Drawer Receipt') return 'Daily Drawer Transfer';

    elseif ($process['product_name']=='Office Outside') {
      $process_name = $process['process_name'];
      if ($process_name=='Choco Chain Dye Final Process') $process_name = 'Choco Dye Process';
      if ($process_name=='Choco Chain Dye Process') $process_name = 'Choco Dye Process';
      if ($process_name=='Hollow Choco Dye Final Process') $process_name = 'Hollow Choco Dye Process';
      if ($process_name=='Imp Italy Dye Final Process') $process_name = 'Imp Italy Dye Process';
      if ($process_name=='Lotus Dye Final Process') $process_name = 'Lotus Dye Process';
      return $process['product_name'].' '.$process_name;
    } 
    return $process['product_name'];
  }

  private function set_fields() {
    $this->in_array = array('fe_in', 'copper_in', 'stone_in', 'solder_in', 'alloy_weight', 
                            'in_rod', 'in_machine_gold', 'hook_in', 'spring_in', 'rhodium_in', 
                            'micro_coating', 'stone_vatav', 'liquor_in', 'flash_wire');

    $this->out_array = array('hook_out', 'accept_packing_list', 'rejected', 'spring_out', 
                             'out_stone_vatav', 'stone_out', 'liquor_out', 'out_rod', 'out_machine_gold', 
                             'fe_out', 'bounch_out', 'tanishq_out', 'closing_out', 'copper_out', 
                             'gpc_out', 'rejected_out', 'balance', 'wastage_fe');

    $this->out_return_array = array('hallmark_out', 'customer_out', 'recutting_out', 'factory_out');

    $this->wastage_array = array('daily_drawer_in_weight', 'daily_drawer_out_weight', 'out_alloy_weight', 
                                 'refine_loss', 'melting_wastage', 'in_melting_wastage', 'solder_wastage', 
                                 'hcl_wastage', 'daily_drawer_wastage', 'tounch_in', 'fire_tounch_in', 
                                 'ghiss', 'hcl_ghiss', 'pending_ghiss', 'loss', 
                                 'karigar_loss', 'pending_loss', 'repair_out');

    $this->wastage_array_in_process = array('tounch_out', 'tounch_ghiss');
  }

}
