<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Pipe_model extends Process_model{
  protected $next_process_model = 'office_outside/final_process_model';
	public $router_class = 'pipes';
	public $departments = array('Melting Start', 'Melting', 'Flatting', 'Pipe Making');
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Office Outside';
		$this->attributes['process_name'] = 'Pipe';
		$this->attributes['chain_name'] = 'Office Outside';
		$this->department_not_deleted=array('Melting Start','Melting');
		$this->load->model(array('processes/Process_field_model', 'office_outside/Pipe_cutting_model'));
		//$this->set_hook_kdm_purity_department=array('Stamping');

	}

	public function after_save($action) {
    if($this->attributes['department_name']=='Pipe Making' && $this->attributes['out_weight']!=0){
      $this->create_pipe_cutting_process();
    }else{
      parent::after_save($action);
    }
  }
  public function create_pipe_cutting_process() {
    $process_fields = $this->Process_field_model->get('',array('process_id' => $this->attributes['id'],
																															 'out_weight >' => 0));
		foreach ($process_fields as $index => $process_field) {
			$start_process=array(
      'department_name' => 'CNC Department',
      'lot_no' => $this->attributes['lot_no'],
      'parent_id' => $this->attributes['id'],
      'parent_lot_id' => $this->attributes['parent_lot_id'],
      'parent_lot_name' => $this->attributes['parent_lot_name'],
      'melting_lot_id' => $this->attributes['melting_lot_id'],
      'row_id' => $this->attributes['melting_lot_id'].'-'.$index.'-'.$this->attributes['parent_id'],
      'in_lot_purity' => $this->attributes['in_lot_purity'],
      'out_lot_purity' => $this->attributes['out_lot_purity'],
      'in_weight' => $process_field['out_weight'],
      'out_weight' => 0,
      'in_purity' => $this->attributes['out_purity'],
      'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
      'out_weight' => $process_field['out_weight'],
      'no_of_bunch' => $this->attributes['no_of_bunch'],
      'design_code' => $this->attributes['design_code'],
    	'machine_size' => $this->attributes['machine_size'],
      'karigar' => $this->attributes['karigar'],
      'length' => $this->attributes['length'],
      'remark' => $this->attributes['remark'], 
      'tone'=>$this->attributes['tone'],
      'status'=>'Pending',
      'chain_name' => $this->attributes['chain_name']);
			$process_obj = new Pipe_cutting_model($start_process);
      $process_obj->before_validate();
			$process_obj->store();
		}
		// parent::set_current_process_status_completed();
	}
}