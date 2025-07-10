<?php 
class Process_status_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_statuses';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'process_statuses[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }

  public function save($after_save = false){
    if(!empty($this->attributes['id'])){
     if($this->attributes['status']=='Pending'){
          $status='Complete';
        }else{
          $status='Pending';
        }
      $current_process_obj = new process_model(array('id' =>$this->attributes['id']));
      $current_process_obj->attributes['status'] = $status;
      $current_process_obj->update(false);
      }
    }
}