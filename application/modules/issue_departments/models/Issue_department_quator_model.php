<?php 
class Issue_department_quator_model extends BaseModel{
	protected $table_name= 'issue_departments';
	public $router_class= 'issue_department_quators';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','issue_departments/issue_department_detail_model'));
	}
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'issue_department_quators[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }

  public function after_save($action){
    $issue_department_details=$this->issue_department_detail_model->get('',array('issue_department_id'=>$this->attributes['id']));
    foreach ($issue_department_details as $index => $value) {
        $current_process_obj = new issue_department_detail_model($value);
        $current_process_obj->attributes['quator'] = $this->attributes['quator'];
        $current_process_obj->update(false);
    }
    foreach ($issue_department_details as $index => $value) {
      if(!empty($value['process_id'])){
        $current_process_obj = new process_model(array('id' =>$value['process_id']));
        $current_process_obj->attributes['quator'] = $this->attributes['quator'];
        $current_process_obj->update(false);
      }
    }
  }
}