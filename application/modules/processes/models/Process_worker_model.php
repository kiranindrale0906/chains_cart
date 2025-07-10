<?php 
class Process_worker_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_workers';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_workers[worker]', 'label' => 'worker',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function after_save($action){
  	$processes = $this->Process_field_model->get('', array('process_id' => $this->attributes['id']));
    if(!empty($processes)){
     foreach ($processes as $process) { 
      $process_obj = new Process_field_model($process);
      $process_obj->attributes['worker'] = $this->attributes['worker'];
      $process_obj->update(false);
    	}
    }
  }
}