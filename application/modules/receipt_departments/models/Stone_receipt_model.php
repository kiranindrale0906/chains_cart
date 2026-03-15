<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Stone_receipt_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'stone_receipts';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Stone Receipt';
    $this->attributes['process_name'] =  'Stone Receipt';
    $this->attributes['chain_name'] =  'Receipt';
    $this->attributes['karigar'] = 'Factory';
    // $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'Start';
    $this->attributes['type'] = 'Stone';
    // $this->attributes['out_stone_vatav'] = $this->attributes['in_weight'];
    $this->attributes['stone_out'] = $this->attributes['in_weight'];
    $this->attributes['row_id'] = rand();
    // parent::before_validate();
  }
  
}