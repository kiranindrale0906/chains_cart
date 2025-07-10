<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Refresh_internal_gpc_process_model extends Process_model{
	protected $next_process_model = '';
	
	public $router_class = 'internal_gpc_processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Refresh';
		$this->departments = array('Cleaning',"Buffing","Steel Vibrator","GPC");
		$this->attributes['process_name'] = 'Internal GPC Process';
		$this->attributes['chain_name'] = 'Refresh';
		$this->department_not_deleted = array('Start', 'Cleaning');
	}
}
