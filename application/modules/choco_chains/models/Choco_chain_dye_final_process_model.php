<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_dye_final_process_model extends Process_model{
	protected $next_process_model = '';
	public $router_class = 'choco_chain_dye_final_processes';
	public $departments = array('Office Outside Final');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Office Outside';
		$this->attributes['process_name'] = 'Choco Chain Dye Final Process';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Office Outside Final');
		//$this->set_hook_kdm_purity_department=array('Ball Making');
	}
	public function before_validate() {
	  // $this->attributes['process_name'] = $this->attributes['type'];
      $this->attributes['daily_drawer_in_weight'] = $this->attributes['in_weight'];
      $this->attributes['wastage_lot_purity'] = $this->attributes['in_lot_purity'];
      $this->attributes['wastage_purity'] = $this->attributes['in_purity'];
      $this->attributes['daily_drawer_in_weight'] = $this->attributes['in_weight'];
  	}
  	public function after_save($action) {
  		parent::after_save($action);
	   	$record = array('process_id' => $this->attributes['id'],
	                   'daily_drawer_in_weight' => $this->attributes['daily_drawer_in_weight'],
	                   'daily_drawer_type' => $this->attributes['type'],
	                   'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
	                   'karigar' => $this->attributes['karigar'],
	                   'chain_name' => $this->attributes['chain_name']); 
	    $process_obj = new Process_field_model($record);
	    $process_obj->save(false);
	}
	
}
