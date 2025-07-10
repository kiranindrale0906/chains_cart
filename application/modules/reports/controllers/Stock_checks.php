<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_checks extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'melting_lots/melting_lot_model'));
  }
  
  public function index() {
    $field  = $this->data['type'] = isset($_GET['type']) ? $_GET['type'] : 'melting_lot_id';
    $weight = isset($_GET['weight']) ? $_GET['weight'] : '';

    if($weight == 'fine') {
      $in_melting_purity  = '* lot_purity/100';
      $in_lot_purity_opening_weight = '* in_lot_purity/100';
      $in_process_weight = '(hook_in*hook_kdm_purity/100)+((copper_in+stone_vatav)*in_lot_purity/100)';
      $out_purity         = '((balance-micro_coating)*in_purity/100*in_lot_purity/100)
                            +((gpc_out+repair_out+hcl_loss)*out_lot_purity/100)
                            +(daily_drawer_in_weight*hook_kdm_purity/100)+tounch_loss_fine';
      $wastage_purity     = '* wastage_purity/100 * wastage_lot_purity/100';
    
    } elseif($weight == 'gross') {
      $in_melting_purity  = '';
      $in_lot_purity_opening_weight = '';
      $in_process_weight  = 'hook_in + copper_in + stone_vatav + solder_in + alloy_weight';
      $hcl_loss           = ' + hcl_loss';
      $out_purity         = '* in_purity/100';
      $wastage_purity     = '* wastage_purity/100';
    
    } else {
      $in_melting_purity  = '';
      $in_lot_purity_opening_weight = '';
      $in_process_weight  = 'hook_in + copper_in + stone_vatav + solder_in + alloy_weight + fe_in - fe_out - wastage_fe';
      $hcl_loss           = '';
      $out_purity         = '';
      $wastage_purity     = '';
    }
    
    $office_outside         = isset($_GET['office_outside']) ? 1 : 0;
    $parent_lot_chain_names = '"Hollow Choco Chain","Imp Italy Chain","Indo tally Chain","Machine Chain","Rope Chain", "Lotus Chain", "Roco Choco Chain"';
    $exclude_product_names  = '"Alloy Issue","Alloy Receipt","Daily Drawer","Daily Drawer Receipt","Daily Drawer Wastage","Fire Tounch Out", "Melting Loss Out",
                               "Finished Goods Receipt","Ghiss Out","HCL","HCL Ghiss Out","Loss Out","Pending Ghiss Out","Receipt","Tounch Out","Pending Ghiss Receipt"';  //,"Refresh"
    
    if($office_outside) 
      $field = 'melting_lot_id';
    
    if($field == 'melting_lot_id'){
      $processes_group_by   = array('group_by'=>'CONCAT(lot_no,melting_lot_id)');
      $melting_lot_group_by = array('group_by'=>'CONCAT(lot_no,id)');
    
    } else {
      $processes_group_by   = array('group_by'=>'parent_lot_id');
      $melting_lot_group_by = array('group_by'=>'parent_lot_id');
    }
    
    if($field == 'melting_lot_id') {
      if($office_outside) {
        $processes_where    = array('product_name' => 'Office Outside');
      } else {
        $processes_where    = array('(product_name NOT IN ('.$parent_lot_chain_names.','.$exclude_product_names.') or process_name = "Refresh Final Process")' => NULL,
                                    'product_name !='=> 'Office Outside',
                                    'parent_lot_id' => 0
                                    );
      }
    } else {
      $processes_where      = array('product_name IN ('.$parent_lot_chain_names.')' => NULL,
                                    'product_name NOT IN ('.$exclude_product_names.') ' => NULL,
                                    //'process_name NOT IN ("Refresh Final Process")' => NULL
                                    );
    }
    if($office_outside) {
      $melting_lot_where    = array('process_name LIKE "%Office Outside%"'=>NULL);
    } else {
      if($field == 'melting_lot_id') {
        $melting_lot_where  = array('process_name NOT LIKE "%Office Outside%"'=>NULL,'process_name NOT IN ('.$parent_lot_chain_names.')'=>NULL);
      } else {
        $melting_lot_where  = array('process_name NOT LIKE "%Office Outside%"'=>NULL,'process_name IN ('.$parent_lot_chain_names.')'=>NULL);
      }
    }
    $in_melting_weight      = $this->melting_lot_model->get('sum((gross_weight) '.$in_melting_purity.')as gross_weight,'.$melting_lot_group_by['group_by'].' as id',
                                                            $melting_lot_where,array(),$melting_lot_group_by);
    $opening_where  = '   parent_id > id 
                       or (product_name = "Internal" and department_name = "Final") 
                       or (product_name = "Solder Wastage" and process_name = "Melting" and department_name = "Cleaning")
                       or (product_name = "Refresh" and process_name = "Refresh Hold" and department_name="Refresh Hold")'; //and account like "%Software%"
    $in_opening_weight      = $this->process_model->get('sum(in_weight) '.$in_lot_purity_opening_weight.' as in_opening_weight,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                        array_merge($processes_where, array($opening_where => NULL)),array(), $processes_group_by);

    $in_process_weight      = $this->process_model->get('sum('.$in_process_weight.') as in_weights,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                        $processes_where,array(),$processes_group_by);    
    if($weight == 'fine') {
      $out_gpc_bounch_weights = $this->process_model->get('sum('.$out_purity.') as gpc_out_weight,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                          $processes_where,array(),$processes_group_by);
      $out_wastage            = $this->process_model->get('sum((melting_wastage + daily_drawer_wastage + ghiss + tounch_in 
                                                          + fire_tounch_in) * wastage_lot_purity/100)
                                                          + sum(in_melting_wastage*in_lot_purity/100)
                                                          + sum((hcl_wastage + loss + hcl_ghiss + solder_wastage + pending_ghiss + karigar_loss 
                                                          + pending_loss) '.$wastage_purity.' + hook_out*hook_kdm_purity/100 
                                                          + (copper_out+out_stone_vatav)*in_lot_purity/100) as wastage_loss,
                                                          '.$processes_group_by['group_by'].' as id,parent_lot_id,melting_lot_id',$processes_where,array(),$processes_group_by);
    } else {
      $out_gpc_bounch_weights = $this->process_model->get('sum((gpc_out + repair_out + balance + daily_drawer_in_weight 
                                                          - micro_coating) '.$out_purity.$hcl_loss.') as gpc_out_weight,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                          $processes_where,array(),$processes_group_by);
      $out_wastage            = $this->process_model->get('sum(melting_wastage + daily_drawer_wastage + ghiss + hook_out + tounch_in 
                                                          + fire_tounch_in + copper_out + out_stone_vatav + in_melting_wastage)
                                                          +sum((hcl_wastage + loss + hcl_ghiss + solder_wastage + pending_ghiss + karigar_loss + pending_loss) 
                                                          '.$wastage_purity.') 
                                                          as wastage_loss,'.$processes_group_by['group_by'].' as id, parent_lot_id,melting_lot_id',
                                                          $processes_where,array(),$processes_group_by);
    }
    
    if($field == 'parent_lot_id') {
      $process_group_balance = $this->process_model->get('out_weight as balance_group,'.$processes_group_by['group_by'].' as id',
                                                          array('out_weight!='=>0,
                                                                'where_in'=>array('product_name'=>"'Indo Tally Chain','Rope Chain','Imp Italy Chain','Hollow Choco Chain','Lotus Chain', 'Roco Choco Chain'"),
                                                                'department_name'=>'Melting',
                                                                'where_not_in'=>array('id' => "(select process_id from process_groups)")),array(),$processes_group_by);
      
      if($weight == 'gross') {
        $strip_cutting_weight = $this->process_model->get('sum(expected_out_weight - out_weight) as strip_cutting_weight,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                          array('strip_cutting_process_id !='=>0),array(),$processes_group_by);
      } elseif($weight == 'fine') {
        $strip_cutting_weight = $this->process_model->get('sum((expected_out_weight - out_weight)*in_lot_purity/100) as strip_cutting_weight,'.$processes_group_by['group_by'].' as id, id as process_id',
                                                          array('strip_cutting_process_id !='=>0),array(),$processes_group_by);
      }
      $this->data['strip_cutting_weights']   = (isset($strip_cutting_weight)) ? get_records_array_by_id($strip_cutting_weight,'id') : '';
      $strip_cutting_weight_keys             = (!empty($this->data['strip_cutting_weights'])) ? array_keys($this->data['strip_cutting_weights']) : array();
      $this->data['process_group_balance'] = get_records_array_by_id($process_group_balance,'id');
    } else 
      $strip_cutting_weight_keys            = array();
    $this->data['in_melting_weights']       = get_records_array_by_id($in_melting_weight,'id');
    $this->data['in_opening_weights']       = get_records_array_by_id($in_opening_weight,'id');
    $this->data['in_process_weights']       = get_records_array_by_id($in_process_weight,'id');
    $this->data['out_gpc_bounch_weights']   = get_records_array_by_id($out_gpc_bounch_weights,'id');
    $this->data['out_wastages']             = get_records_array_by_id($out_wastage,'id');
    $in_melting_weight_keys     = array_keys($this->data['in_melting_weights']);
    $in_process_weight_keys     = array_keys($this->data['in_process_weights']);
    $out_gpc_bounch_weight_keys = array_keys($this->data['out_gpc_bounch_weights']);
    $out_wastage_keys           = array_keys($this->data['out_wastages']);
    $process_group_balance_keys           = isset($this->data['process_group_balance']) ? array_keys($this->data['process_group_balance']) : array();
    $this->data['ids']          = array_unique(array_merge($in_melting_weight_keys,$in_process_weight_keys,$out_gpc_bounch_weight_keys,$out_wastage_keys,$strip_cutting_weight_keys,$process_group_balance_keys));
    $this->load->render('reports/stock_checks/index', $this->data);
  }
}
