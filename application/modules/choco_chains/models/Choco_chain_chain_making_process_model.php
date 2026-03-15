<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_chain_making_process_model extends Process_model{
	protected $next_process_model = 'choco_chains/Choco_chain_final_process_model';

	public $router_class = 'chain_making_processes';
	public $departments = array('Chain Making');
  	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
    $this->attributes['process_name'] = 'Chain Making Process';
    $this->attributes['chain_name'] = 'Choco Chain';

    $this->department_not_deleted=array('Chain Making');
    $this->split_out_weight_departments = array('Chain Making');
	}
}
		