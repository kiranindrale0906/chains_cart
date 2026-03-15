<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_dye_process_model extends Process_model{
	protected $next_process_model = 'choco_chains/choco_chain_dye_final_process_model';
	public $router_class = 'choco_chain_dye_processes';
	public $departments = array('Melting Start', 'Melting', 'Flatting', 'Stamping','Ledger And Joining');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Office Outside';
		$this->attributes['process_name'] = 'Choco Chain Dye Process';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Melting Start','Melting');
		//$this->set_hook_kdm_purity_department=array('Stamping');

		$this->split_out_weight_departments = array('Ledger And Joining');
	}

	// public function after_save($action) {
 //  	if($this->attributes['department_name']=='Ledger And Joining' && $this->attributes['daily_drawer_in_weight']!=0){
 //  		$this->attributes['status'] = 'Complete';
 //  		$this->attributes['completed_at'] = date('Y-m-d H:i:s');
 //    	$this->update(FALSE);
 //    	$record = array('process_id' => $this->attributes['id'],
	//                    'daily_drawer_in_weight' => $this->attributes['daily_drawer_in_weight'],
	//                    'daily_drawer_type' => $this->attributes['product_name'],
	//                    'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
	//                    'karigar' => $this->attributes['karigar'],
	//                    'chain_name' => $this->attributes['chain_name']); 
	//     $process_obj = new Process_field_model($record);
	//     $process_obj->save(false);
 //  	}else{
 //  		parent::after_save($action);
 //  	}
 //  }
	
}
