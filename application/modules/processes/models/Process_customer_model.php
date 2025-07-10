<?php 
class Process_customer_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_customers';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_customers[customer_name]', 'label' => 'Customer Name',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function after_save($action){
  	$processes = $this->Process_field_model->get('', array('process_id' => $this->attributes['parent_id']));
    if(!empty($processes)){
     foreach ($processes as $process) { 
      $process_obj = new Process_field_model($process);
      $process_obj->attributes['customer_name'] = $this->attributes['customer_name'];
      $process_obj->update(false);

    	}
    }
  }
}