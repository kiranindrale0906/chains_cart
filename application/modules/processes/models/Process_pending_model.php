<?php 
class Process_pending_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_pendings';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_pendings[id]', 'label' => 'id',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
}