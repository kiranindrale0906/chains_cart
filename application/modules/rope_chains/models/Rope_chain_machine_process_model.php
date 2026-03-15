<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Rope_chain_machine_process_model extends Process_model{
	protected $next_process_model = 'rope_chains/Rope_chain_final_process_model';

	public $router_class = 'machine_processes';
	public $departments = array('Machine Department','Hook','Drum','HCL','Hook I','Drum I');
  	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Rope Chain';
    $this->attributes['process_name'] = 'Machine Process';
    $this->attributes['chain_name'] = 'Rope Chain';

    $this->department_not_deleted=array('Machine Department');
    $this->split_out_weight_departments = array('Drum I');
	}
}
		