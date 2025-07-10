<?php 
class Processes_karigar_model extends BaseModel{
  protected $table_name= 'processes';
  public $router_class = 'processes_karigars';
  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('processes/process_field_model'));
  }

  public function validation_rules($klass=''){
    return array(array('field' => 'processes_karigars[karigar]', 'label' => 'Karigar',
                       'rules' => array('trim', 'required'))); 
  }

  public function after_save($action) {
  	if ($this->attributes['product_name'] == 'Issue') {
  		$process_field = $this->process_field_model->find('', array('process_id' => $this->attributes['id']));
  		$process_field_obj = new process_field_model($process_field);
  		$process_field_obj->attributes['karigar'] = $this->attributes['karigar'];
  		$process_field_obj->save(false);
  	}
  }
}