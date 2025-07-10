<?php 
class Process_outside_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_outsides';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
  public function validation_rules($klass='') {
    $rules = array(array('field' => 'process_outsides[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }

  public function save($after_save = false){
    if(!empty($this->attributes['id'])){
     if($this->attributes['is_outside']=='Yes'){
          $is_outside='No';
        }else{
          $is_outside='Yes';
        }
      $current_process_obj = new process_model(array('id' =>$this->attributes['id']));
      $current_process_obj->attributes['is_outside'] = $is_outside;
      $current_process_obj->update(false);
      }
    }
}