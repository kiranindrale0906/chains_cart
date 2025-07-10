<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Process_details_model extends Process_model{
  protected $next_process_model = '';
	public $router_class = '';
	public $departments = '';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->table_name = 'process_details';
		$this->attributes['product_name'] = '';
		$this->attributes['process_name'] = '';
    $this->department_not_deleted='';
	}


  public function before_validate(){
    $this->attributes['department_name'] = explode(",",$this->attributes['department_name']);
  }
}