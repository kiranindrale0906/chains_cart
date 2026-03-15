<?php 
class View_daily_drawer_summary_model extends BaseModel{
	protected $table_name= 'view_daily_drawer_summary';
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='', $index=0){
		$validation_rules='';
		return $validation_rules;	
	}
}