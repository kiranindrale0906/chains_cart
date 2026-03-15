<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Loss_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'loss_receipts';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Loss Receipt';
    $this->attributes['process_name'] =  'Loss Receipt';
    $this->attributes['chain_name'] =  'Receipt';
    $this->attributes['karigar'] = 'Factory';
    // $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['in_weight'] = $this->attributes['out_weight']+$this->attributes['loss'];
    $this->attributes['balance_loss'] = $this->attributes['loss'];
    $this->attributes['row_id'] = rand();
    $this->departments=array($this->attributes['department_name']);
    parent::before_validate();
  }
}