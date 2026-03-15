<?php 
class Process_tounch_loss_fine_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_tounch_loss_fine';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_tounch_loss_fine[id]', 'label' => 'Tounch Purity',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
}