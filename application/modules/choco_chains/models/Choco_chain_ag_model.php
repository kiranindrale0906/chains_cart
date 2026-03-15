<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_ag_model extends Process_model{
	protected $next_process_model = 'choco_chains/Choco_chain_machine_process_model';
	public $router_class = 'ags';
	public $departments = array('Melting Start', 'Melting','Flatting','Dye');
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'AG';
		$this->attributes['chain_name'] = 'Choco Chain';
		
		$this->department_not_deleted = array('Melting Start','Melting');
		$this->split_out_weight_departments = array('Dye');    
	}
}