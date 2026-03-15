<?php 
class Process_verification_model extends BaseModel{
	protected $table_name= 'process_verifications';
	public $router_class= 'process_verifications';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_verifications[balance]', 'label' => 'balance',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
}