<?php 
class Process_hook_model extends BaseModel{
	protected $table_name= 'process_details';
	public $router_class= 'process_hooks';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_hooks[daily_drawer_type]', 'label' => 'Daily Drawer Type',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
}