<?php 
class Process_quator_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_quators';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'process_quators[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }

  public function save($after_save = false){
    if(!empty($this->attributes['id'])){
      $current_process_obj = new process_model(array('id' =>$this->attributes['id']));
      $current_process_obj->attributes['quator'] = $this->attributes['quator'];
      $current_process_obj->update(false);
      }
    }
}