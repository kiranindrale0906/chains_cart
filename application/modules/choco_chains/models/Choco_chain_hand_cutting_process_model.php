<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_hand_cutting_process_model extends Process_model{
	protected $next_process_model = '';
	public $router_class = 'hand_cutting_processes';
	public $departments = array('Hand Cutting');
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Hand Cutting Process';
		$this->attributes['chain_name'] = 'Choco Chain';
		
		$this->department_not_deleted = array('Hand Cutting');

	}
	public function after_save($action){
		parent::after_save($action);
		$this->create_chain_making_process_record($this->attributes);
	}
	private function create_chain_making_process_record($process) {
	$this->load->model(array('choco_chains/choco_chain_machine_process_model'));
     $pending_chain_making_department   = $this->choco_chain_machine_process_model->find('', array('in_lot_purity' =>$process['in_lot_purity'],'department_name' => 'Chain Making','id'=>$process['parent_id']));
     // pd($pending_chain_making_department);

      $gross_weight=$pending_chain_making_department['factory_out']-$process['out_weight'];
      $choco_chain_obj = new choco_chain_machine_process_model($pending_chain_making_department);
      $choco_chain_obj->attributes['factory_out'] = 0;
      $choco_chain_obj->attributes['next_department_wastage'] = $gross_weight;
      $choco_chain_obj->attributes['status'] = 'Pending';
      $choco_chain_obj->before_validate();
      $choco_chain_obj->update(false); 
  } 
}