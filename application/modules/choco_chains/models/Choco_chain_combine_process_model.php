<?php

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_combine_process_model extends Process_model{
  protected $next_process_model = '';
  public $router_class = 'combine_processes';
  public $departments = array('Melting Start', 'Combine');
  protected $table_name= 'processes';

  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Choco Chain';
    $this->attributes['process_name'] = 'Combine Process';
    $this->attributes['chain_name'] = 'Choco Chain';
    $this->department_not_deleted=array('Melting Start');
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model', 'processes/Process_group_model'));
  }

  public function before_save($action) {
    if ($this->attributes['department_name'] == 'Combine') {
      $this->attributes['out_weight'] = $this->attributes['in_weight'];
      parent::calculate_balance();

    }
  }

  public function after_save($action) {
    if ($this->attributes['department_name'] == 'Combine') {
      $melting_lot = $this->melting_lot_model->find('order_id', array('id' => $this->attributes['melting_lot_id']));
      $process = $this->check_for_other_processes_with_same_order_id($melting_lot['order_id']);
      if(!empty($process)) {
        $this->create_ag_process_record_by_combination($process['id']);
        $this->update_status_of_process_to_complete($this->attributes['id']);
        $this->update_status_of_process_to_complete($process['id']);
      }
    } else {
      parent::after_save($action);
    }
  }

  private function check_for_other_processes_with_same_order_id($order_id) {
    $processes = $this->choco_chain_combine_process_model->get('',
                                                               array('department_name' => 'Combine',
                                                                     'id !=' => $this->attributes['id'],
                                                                     'status' => 'Pending'));
    foreach ($processes as $index => $process) {
      $melting_lot = $this->melting_lot_model->find('order_id',array('id' => $process['melting_lot_id']));
      if ($melting_lot['order_id'] == $order_id) {
        return $process;
      }
    }
  }

  private function create_ag_process_record_by_combination($process_id) {
    $process_ids[] = $this->attributes['id'];
    array_push($process_ids, $process_id);
    $process = $this->process_model->find('sum(out_weight) as in_weight,
                                           (sum(out_weight*out_purity) / sum(out_weight)) as in_purity,
                                           (sum(out_weight*out_lot_purity) / sum(out_weight)) as in_lot_purity,
                                           group_concat(lot_no) as lot_nos,
                                           max(melting_lot_id) as melting_lot_id',
                                           array('where_in' => array('id' => $process_ids)));

    $start = array('department_name' => 'Melting Start',                           
                   'parent_lot_id' => $this->attributes['parent_lot_id'],
                   'parent_lot_name' => $this->attributes['parent_lot_name'],

                   'melting_lot_id' => $process['melting_lot_id'],
                   'lot_no' => $process['lot_nos'],
                   'row_id' => $process['melting_lot_id'],

                   'melting_lot_category_one' => $this->attributes['melting_lot_category_one'],
                   'design_code' => $this->attributes['design_code'],
                   'machine_size' => $this->attributes['machine_size'],
                   'karigar' => $this->attributes['karigar'],
                               
                  'in_weight' => $process['in_weight'],
                  'in_purity' => $process['in_purity'],
                  'in_lot_purity' => $process['in_lot_purity'],
                               
                  'out_weight' => $process['in_weight']);

    $this->load->model('choco_chains/choco_chain_ag_model');
    $process_obj = new choco_chain_ag_model($start);
    $process_obj->store();
    $this->create_records_in_process_groups($process_obj->attributes['id'], $process_ids);
  }

  private function create_records_in_process_groups($parent_process_id, $process_ids){
    foreach ($process_ids as $index => $process_id) {
      $record = array('process_id' => $process_id,
                      'parent_id' => $parent_process_id);
      $process_group_obj = new Process_group_model($record);
      $process_group_obj->store(false);
    }
  }

  private function update_status_of_process_to_complete($process_id) {
    $process = $this->process_model->find('',array('id' => $process_id));
    $process_obj = new process_model($process);
    $process_obj->attributes['status'] = 'Complete';
    $process_obj->save(false);
  }
}