<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Mesh_gope_chain_model extends Process_model{
	protected $next_process_model = 'office_outside/final_process_model';
	public $router_class = 'mesh_gope_chains';
	public $departments = array('Melting Start', 'Melting', 'Tar Making','Mesh Gope Chain Making');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Office Outside';
		$this->attributes['process_name'] = 'Mesh Gope Chain';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Melting Start','Melting');
		//$this->set_hook_kdm_purity_department=array('Cutting');
		$this->split_out_weight_departments = array('Mesh Gope Chain Making');
	
	}
}
