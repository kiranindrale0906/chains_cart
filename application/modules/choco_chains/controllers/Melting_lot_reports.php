<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Melting_lot_reports extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model', 'settings/category_model','settings/category_four_model'));
    $this->redirect_after_save = 'view';
  }

  public function index() {
    redirect(base_url().'choco_chains/melting_lot_reports/create');
  }

  public function _get_form_data() {
    $this->data['category_one']   = isset($_GET['category_one'])   ? $_GET['category_one'] : '';
    // $this->data['category_two']   = isset($_GET['category_two'])   ? $_GET['category_two'] : '';
    $this->data['category_three'] = isset($_GET['category_three']) ? $_GET['category_three'] : '';
    $this->data['design_code']    = isset($_GET['design_code']) ? $_GET['design_code'] : '';
    $this->data['balance_status'] = isset($_GET['balance_status']) ? $_GET['balance_status'] : 'Completed';
    $this->data['purity']         = isset($_GET['purity']) ? $_GET['purity'] : '';

    $this->data['category_ones']    = array_column($this->process_model->get('distinct(melting_lot_category_one) as name', array('product_name' => 'Choco Chain'), array(), array('order_by' => 'melting_lot_category_one')), 'name');
    // $this->data['category_twos']    = array('Laser', 'Powder');
    $this->data['category_threes']  = array_column($this->process_model->get('distinct(machine_size) as name', array('product_name' => 'Choco Chain'), array(), array('order_by' => 'machine_size')), 'name');
    $this->data['category_fours']   = array_column($this->process_model->get('distinct(design_code) as name', array('product_name' => 'Choco Chain'), array(), array('order_by' => 'design_code')), 'name');
    $this->data['purities']         = array_column($this->melting_lot_model->get('distinct(lot_purity) as name', array('process_name' => 'Choco Chain'), array(), array('order_by' => 'lot_purity')), 'name');
    $this->data['balance_statuses'] = array('Pending', 'Completed');

    $this->data['process_departments'] = $this->get_process_departments();
    $this->data['processes']           = $this->get_processes();
    $this->get_fields();
  }

  // public function _get_view_data() {
  //   $this->data['melting_lot'] = $this->melting_lot_model->find('id, lot_no, gross_weight, created_at', array('id' => $this->data['record']['id']));
  //   $group_by = 'melting_lot_category_one, machine_size, design_code, department_name';
  //   $in_select = $this->get_select('1')['in_select'];
  //   $this->data['ins'] = $this->process_model->get('department_name, '.$in_select, 
  //                                                  array('melting_lot_id' => $this->data['record']['id'],
  //                                                        '(hook_in-hook_out+copper_in-copper_out+solder_in+micro_coating+alloy_weight) >' => 0), array(),
  //                                                  array('group_by' => $group_by, 'order_by' => $group_by));
  //   $total_in_weight = $this->process_model->find($in_select, array('melting_lot_id' => $this->data['record']['id']));
  //   $this->data['total_in_weight'] = $total_in_weight['hook_in'] + $total_in_weight['copper_in'] 
  //                                    + $total_in_weight['solder_in']+ $total_in_weight['micro_coating'] 
  //                                    + $total_in_weight['alloy_weight'];
   
  //   $out_select = $this->get_select('1')['out_select'];
  //   $this->data['outs'] = $this->process_model->get('department_name, created_at, '.$out_select, 
  //                                                   array('melting_lot_id' => $this->data['record']['id'],
  //                                                         '(repair_out+gpc_out+bounch_out+factory_out) >' => 0), array(),
  //                                                   array('group_by' => $group_by.', created_at', 'order_by' => $group_by.', created_at'));

  //   $wastage_select = $this->get_select('1')['wastage_select'];
  //   $this->data['wastages'] = $this->process_model->get('department_name, '.$wastage_select, 
  //                                                       array('melting_lot_id' => $this->data['record']['id'],
  //                                                             '(melting_wastage+daily_drawer_wastage+tounch_in+ghiss+loss+pending_ghiss+solder_wastage+fire_tounch_in+karigar_loss+pending_loss) >' => 0 ), array(),
  //                                                  array('group_by' => $group_by, 'order_by' => $group_by));
  // }  

  // public function _get_form_data() {
  //   $in_select = $this->get_select()['in_select'];
  //   $out_select = $this->get_select()['out_select'];
  //   $wastage_select = $this->get_select()['wastage_select'];
  //   $processes = $this->process_model->get($in_select.', '.$out_select.', '.$wastage_select, 
  //                                            array('product_name' => 'Choco Chain'), array(),
  //                                            array('group_by' => 'melting_lot_id', 'having'=> 'balance = 0'));
  //   $this->data['processes'] = get_records_by_id($processes, 'melting_lot_id');

  //   $melting_lot_ids = array_column($processes, 'melting_lot_id');
  //   $melting_lots = $this->melting_lot_model->get('id, lot_no, gross_weight, created_at', array('id' => $melting_lot_ids));
  //   $this->data['melting_lots'] = get_records_by_id($melting_lots, 'id');
  // }

  private function get_raw_processes() {
    $group_by = 'melting_lot_id, melting_lot_category_one, melting_lot_category_two, machine_size, design_code, process_name, department_name'; 
    $in_select =  'sum(in_weight) as in_weight,
                   sum(fe_in - fe_out - wastage_fe) as fe_in,
                   sum(hook_in-hook_out) as hook_in, 
                   sum(copper_in-copper_out) as copper_in, 
                   sum(solder_in) as solder_in, 
                   sum(micro_coating) as micro_coating, 
                   sum(alloy_weight) as alloy_weight';
    $out_select = 'sum(out_weight) as out_weight,
                   sum(repair_out) as repair_out, 
                   sum(gpc_out) as gpc_out,
                   sum(recutting_out) as recutting_out,
                   sum(factory_out) as factory_out,
                   sum(bounch_out) as bounch_out,
                   sum(balance) as balance';
    $wastage_select = 'sum(melting_wastage + in_melting_wastage) as melting_wastage, 
                       sum(daily_drawer_wastage) as daily_drawer_wastage, 
                       sum(hcl_wastage) as hcl_wastage, 
                       sum(tounch_in + fire_tounch_in) as tounch_in, 
                       sum(ghiss + pending_ghiss) as ghiss, 
                       sum(loss + karigar_loss + pending_loss) as loss, 
                       sum(solder_wastage) as solder_wastage';

    $where =  array('product_name' => 'Choco Chain');
    if (!empty($this->data['category_one']))   $where['melting_lot_category_one'] = $this->data['category_one'];
    // if (!empty($this->data['category_two']))   $where['melting_lot_category_two'] = $this->data['category_two'];
    if (!empty($this->data['category_three'])) $where['machine_size']             = $this->data['category_three'];
    if (!empty($this->data['design_code']))    $where['design_code']              = $this->data['design_code'];
    
    if (!empty($this->data['balance_status']) && $this->data['balance_status']=='Pending')
      $having = array('group_by' => 'melting_lot_id', 'having' => 'balance != 0');
    elseif(!empty($this->data['balance_status']) && $this->data['balance_status']=='Completed')
      $having = array('group_by' => 'melting_lot_id', 'having' => 'balance = 0');
    else 
      $having = array('group_by' => 'melting_lot_id');
    
    if (empty($this->data['purity']))
      $melting_lots = $this->melting_lot_model->get('id, lot_no, lot_purity', array('process_name' => 'Choco Chain'));
    else 
      $melting_lots = $this->melting_lot_model->get('id, lot_no, lot_purity', array('process_name' => 'Choco Chain', 'lot_purity' => $this->data['purity']));
    $where['melting_lot_id'] = array_column($melting_lots, 'id');

    $zero_balance_melting_lot_ids = $this->process_model->get('sum(balance) as balance,  melting_lot_id', 
                                                                $where, array(),$having);
    $zero_balance_melting_lot_ids = array_column($zero_balance_melting_lot_ids, 'melting_lot_id');
    //$zero_balance_melting_lot_ids = array_slice($zero_balance_melting_lot_ids, 0, 5, true);
    
    $this->data['melting_lots'] = get_records_by_id($melting_lots);

    $where = array('product_name' => 'Choco Chain',
                   'department_name not in ("Start", "ReSolder Selection") ' => NULL);
    if (!empty($zero_balance_melting_lot_ids)) 
      $where['melting_lot_id'] = $zero_balance_melting_lot_ids;
    else
      $where['melting_lot_id'] = array(-1);

    $processes = $this->process_model->get($group_by.', '.$in_select.', '.$wastage_select.', '.$out_select, $where, array(), array('group_by' => $group_by, 'order_by' => $group_by));
    return $processes;
  }

  private function get_processes() {
    $processes = $this->get_raw_processes();
    $final_array = array();
    foreach($processes as $process) {
      $melting_lot_id = $process['melting_lot_id'];
      $melting_lot_category_one = !empty($process['melting_lot_category_one']) ? $process['melting_lot_category_one'] : ' ';
      $melting_lot_category_two = ' '; //$process['melting_lot_category_two'];
      $machine_size = $process['machine_size'];
      $design_code = $process['design_code'];

      $process_name = $process['process_name'];
      $department_name = $process['department_name'];
      
      // if (!isset($final_array[$melting_lot_id])) $final_array[$melting_lot_id] = array();
      // if (!isset($final_array[$melting_lot_id][$melting_lot_category_one])) $final_array[$melting_lot_id][$melting_lot_category_one] = array();
      // if (!isset($final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two])) $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two] = array();
      // if (!isset($final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size])) $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size] = array();
      // if (!isset($final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code])) $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code] = array();
      // if (!isset($final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code][$process_name])) $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code] = array();
      //if (!isset($final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code][$process_name][$department_name])) $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code][$process_name][$department_name] = array();

      $final_array[$melting_lot_id][$melting_lot_category_one][$melting_lot_category_two][$machine_size][$design_code][$process_name][$department_name] = $process;
    }
    return $final_array;
  }

  private function get_process_departments() {
    $process_departments = array(
      //'Combine Process' => array('Combine'),
      'AG' => array('Melting','Flatting','Dye'),
      'Machine Process' => array('Chain Making'),

      'Final Process' => array('Filing','Hook','Pasta','Shampoo Walnut','Castic Process','Lobster Out',
                              'Shampoo And Steel','Hand Cutting','Hand Dull','Buffing','GPC Or Rodium'),
      'Imp Final Process' => array('Filing','Hook','Pasta','Tounch Department','Lobster','Shampoo', 'Buffing','Hand Cutting','Hand Dull','Buffing II','GPC Or Rodium'),
      'RND Process' => array('Hand Cutting','Hand Dull','Buffing','GPC'),
      'Casting Final Process' => array('Filing','Pasta','Castic Process','Lobster Out',
                              'Shampoo And Steel', 'Buffing','Hand Cutting','Hand Dull','Buffing II','GPC Or Rodium'),
      );
    return $process_departments;
  }

  private function get_fields($department_name = '') {
    //'melting_lot_id', 'melting_lot_category_one', 'machine_size', 'design_code', 
                                  
    // $this->data['fields']['test'] = array('in_weight','hook_in', 'copper_in', 'solder_in', 'micro_coating', 'alloy_weight',
    //                               'out_weight','repair_out', 'gpc_out', 'factory_out',
    //                               'daily_drawer_wastage', 'tounch_in', 'ghiss', 'loss', 'solder_wastage');
    $this->data['fields'] = array();
    $this->data['fields']['Combine'] = array('in_weight','out_weight', 'daily_drawer_wastage', 'loss','tounch_in', 'balance');
    $this->data['fields']['Melting'] = $this->data['fields']['Combine'];
    $this->data['fields']['Flatting'] = array('in_weight',
                                              'out_weight',
                                              'melting_wastage', 'loss', 'ghiss', 'balance');
    $this->data['fields']['Dye'] = array('in_weight',
                                         'out_weight',
                                         'melting_wastage', 'loss', 'balance');
    $this->data['fields']['Chain Making'] = array('in_weight', 
                                                  'hook_in',
                                                  'out_weight',
                                                  'daily_drawer_wastage', 'loss','ghiss', 'balance');

    $this->data['fields']['Filing'] = array('in_weight',
                                            'out_weight',
                                            'daily_drawer_wastage', 'loss','ghiss', 'balance');
    $this->data['fields']['Hook'] = array('in_weight', 'hook_in',
                                          'out_weight', 
                                          'daily_drawer_wastage', 'loss' , 'tounch_in', 'balance');
    $this->data['fields']['Pasta'] = array('in_weight',
                                          'out_weight','loss','balance');
    $this->data['fields']['Shampoo Walnut'] = array('in_weight',
                                                    'out_weight','loss','balance');
    $this->data['fields']['Castic Process'] = $this->data['fields']['Shampoo Walnut']; 
    $this->data['fields']['Lobster Out'] = array('in_weight', 'hook_in',
                                                 'out_weight', 
                                                 'daily_drawer_wastage', 'loss' , 'tounch_in', 'balance');
    $this->data['fields']['Shampoo And Steel'] = array('in_weight',
                                                       'out_weight','loss','balance');
    $this->data['fields']['Hand Cutting'] = array('in_weight',
                                                  'out_weight','melting_wastage','daily_drawer_wastage','loss','ghiss','balance');
    $this->data['fields']['Hand Dull'] = array('in_weight',
                                                  'out_weight','daily_drawer_wastage','loss','ghiss','balance');
    $this->data['fields']['Buffing'] = array('in_weight','hook_in',
                                              'out_weight','loss','balance');
    $this->data['fields']['GPC Or Rodium'] = array('in_weight', 'micro_coating',
                                          'gpc_out', 'repair_out',
                                          'daily_drawer_wastage', 'loss', 'balance');
    $this->data['fields']['GPC'] = $this->data['fields']['GPC Or Rodium'];
    $this->data['fields']['Tounch Department'] = array('in_weight','fe_in',
                                                       'out_weight', 'balance');
    $this->data['fields']['Lobster'] = $this->data['fields']['Lobster Out'];
    $this->data['fields']['Shampoo'] = array('in_weight',
                                             'out_weight','loss', 'balance');
    $this->data['fields']['Buffing II'] =$this->data['fields']['Buffing'];
    
  }
}  