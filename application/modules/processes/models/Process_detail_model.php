<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Process_detail_model extends BaseModel{
  protected $table_name= 'process_details';
  public $router_class = '';
	public $departments = '';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = '';
		$this->attributes['process_name'] = '';
    $this->department_not_deleted='';
	}


  public function before_validate(){
    $this->attributes['department_name'] = explode(",",$this->attributes['department_name']);
  }
}