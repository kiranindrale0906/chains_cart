<?php 
class Process_machine_no_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_machine_no';

	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_machine_no[machine_no]', 'label' => 'Machine No',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function save($after_save = false){
    $this->update(false);
  }
}