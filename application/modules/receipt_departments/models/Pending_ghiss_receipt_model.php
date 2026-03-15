<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Pending_ghiss_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'pending_ghiss_receipts';
  public $departments = array();
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Pending Ghiss Receipt';
    $this->attributes['process_name'] = 'Pending Ghiss Receipt';
    $this->attributes['chain_name'] =  'Receipt';
    // $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    //$this->attributes['department_name'] = $this->attributes['department_name'];
    $this->attributes['process_sequence'] = 0;
    $this->attributes['pending_ghiss'] = $this->attributes['in_weight'];
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  } 

  public function after_save($action) {
    $this->attributes['lot_no'] = 'PGR-'.$this->attributes['id'];
    $this->update(false);

    parent::save($action);
  }
}