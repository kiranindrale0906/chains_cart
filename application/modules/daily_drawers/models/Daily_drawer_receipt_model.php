<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'daily_drawer_receipts';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Daily Drawer Receipt';
    $this->attributes['chain_name'] = 'Office Outside';
    $this->attributes['karigar'] = 'Factory';
    $this->load->model(array('processes/Process_field_model'));
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'Start';
    $this->attributes['process_name'] = $this->attributes['type'];
    $this->attributes['daily_drawer_in_weight'] = $this->attributes['in_weight'];
    $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  }

  public function after_save($action) {
    $this->attributes['lot_no'] = 'DDR-'.$this->attributes['id'];
    $this->update(false);

    $process_detail_record = array('daily_drawer_type' => $this->attributes['type'],
                                   'process_id' => $this->attributes['id'],
                                   'karigar' => $this->attributes['karigar'],
                                   'daily_drawer_in_weight' => $this->attributes['daily_drawer_in_weight'],
                                   'hook_kdm_purity' => $this->attributes['hook_kdm_purity']);
    $process_detail_obj = new Process_field_model($process_detail_record);
    $process_detail_obj->save(false);
  }

  public function after_delete($id, $conditions = array()) {
    $process_detail_record = $this->Process_field_model->find('', array('process_id' => $id));
    $process_detail_obj = new Process_field_model($process_detail_record);
    $process_detail_obj->delete($process_detail_record['id'], array(), TRUE, FALSE);
  }
}