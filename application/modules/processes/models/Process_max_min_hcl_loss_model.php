<?php 
class Process_max_min_hcl_loss_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_max_min_hcl_losses';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_max_min_hcl_losses[max_hcl_loss]', 'label' => 'Max hcl loss',
                        'rules' => 'trim|required'),
                  array('field' => 'process_max_min_hcl_losses[min_hcl_loss]', 'label' => 'Min hcl loss',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
}