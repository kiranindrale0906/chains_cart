<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Rope_chain_melting_process_model extends Process_model{
	protected $next_process_model = 'rope_chains/Rope_chain_machine_process_model';

	public $router_class = 'melting_processes';
	public $departments = array('Melting Start','Melting','Tounch Hold Department','Tounch Department','Flatting Hold','Flatting','Stripping Hold','Stripping','Tube Forming Hold','Tube Forming','Bull Block Hold','Bull Block','Wire Making Hold','Wire Making');
  	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Rope Chain';
    $this->attributes['process_name'] = 'Melting Process';
    $this->attributes['chain_name'] = 'Rope Chain';
    $this->department_not_deleted=array('Melting Start','Melting');
    $this->split_out_weight_departments = array('Wire Making');
   }

	
}
		