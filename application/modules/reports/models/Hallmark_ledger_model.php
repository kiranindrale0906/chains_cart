<?php 
class Hallmark_ledger_model extends BaseModel{
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='', $index=0){
		$validation_rules='';
		return $validation_rules;	
	}
}