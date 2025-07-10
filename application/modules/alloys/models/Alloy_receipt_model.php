<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Alloy_receipt_model extends Process_model {
	protected $next_process_model = '';
	
	public $router_class = 'alloy_receipts';
	public $departments = array('Start');
	
	public function __construct($data = array()) {
		parent::__construct($data);
		$this->attributes['product_name'] = 'Alloy Receipt';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Start');
	}

	public function before_validate() {
		$this->attributes['process_sequence'] = 0;
		$this->attributes['department_name'] = 'Start';
		$this->attributes['process_name'] = $this->attributes['type'];
		$this->attributes['out_weight'] = $this->attributes['alloy_weight'];
		$this->attributes['row_id'] = rand();
		parent::before_validate();
	}
}