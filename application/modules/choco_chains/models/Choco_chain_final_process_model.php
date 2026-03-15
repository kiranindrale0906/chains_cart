<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_final_process_model extends Process_model{
	public $next_process_model = '';

	public $router_class = 'final_processes';
	public $departments = array('GPC');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Final Process';
		$this->department_not_deleted=array('GPC');
		$this->load->model(array('refresh/refresh_hold_model'));
	}
}