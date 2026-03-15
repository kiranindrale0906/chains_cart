<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Hollow_pipe_model extends Process_model{
	protected $next_process_model = 'office_outside/final_process_model';
	public $router_class = 'hollow_pipes';
	public $departments = array('Melting Start', 'Melting', 'Flatting','Pipe Making', 'AU+FE','AU+FE Final','KitKat','Hand Cutting','HCL');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Office Outside';
		$this->attributes['process_name'] = 'Hollow Pipe';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Melting Start','Melting');
		//$this->set_hook_kdm_purity_department=array('HCL');
		$this->split_out_weight_departments = array('HCL');
	}
	// public function after_save($action) {
 //    if($this->attributes['department_name']=='HCL' && $this->attributes['daily_drawer_in_weight']!=0){
 //      $this->attributes['status'] = 'Complete';
 //      $this->attributes['completed_at'] = date('Y-m-d H:i:s');
 //      $this->update(FALSE);
 //    }else{
 //      parent::after_save($action);
 //    }
 //  }
}
