<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Refresh_hand_dull_process_model extends Process_model{
	protected $next_process_model = 'refresh/Refresh_model';
	
	public $router_class = 'refresh_hand_dull_processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Refresh';
		$this->departments = array('Hand Dull');
		$this->attributes['process_name'] = 'Hand Dull Process';
		$this->attributes['chain_name'] = 'Refresh';

		$this->department_not_deleted = array('Start', 'Hand Dull');
	}
}
