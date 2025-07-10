<?php 
class Process_department_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_departments';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_departments[department_name]', 'label' => 'Department Name',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function save($after_save = false){
    $process = $this->Process_model->find('row_id', array('id' => $this->attributes['id']));
    $processes = $this->Process_model->get('', array('row_id' => $process['row_id']));
    if(!empty($processes)) {
      foreach ($processes as $process) {
        $process['department_name'] = $this->attributes['department_name'];
        $process_obj = new Process_model($process);
        $process_obj->update(false);
      }
    }
  }
}