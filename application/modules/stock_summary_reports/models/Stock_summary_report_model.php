<?php 
class Stock_summary_report_model extends BaseModel{
	public $router_class = 'ags';
	public $departments = array('Start', 'AG Melting');
	// protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='', $index=0) {
		return $validation_rules;	
	}
}