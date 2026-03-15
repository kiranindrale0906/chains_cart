<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Export_internal_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'export_internal_receipts';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Export Internal';
    $this->attributes['process_name'] = 'Export Internal Receipt';
    $this->attributes['chain_name'] = 'Export Internal';
    $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'Start';
    $this->attributes['melting_lot_id'] = rand();
    $this->attributes['row_id'] = rand();
    $this->attributes['hook_kdm_purity']=$this->attributes['in_lot_purity'];
    $this->attributes['out_weight'] = $this->attributes['in_weight'];
    parent::before_validate();
  }

  public function after_save($action = true) {
    $this->attributes['lot_no'] = 'EIR-'.$this->attributes['id'];
    $this->update(false);

    parent::after_save($action);
  }
}