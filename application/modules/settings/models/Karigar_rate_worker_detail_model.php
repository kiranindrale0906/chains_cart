<?php 
class Karigar_rate_worker_detail_model extends BaseModel{
	public $router_class = 'karigar_rate_worker_details';
	protected $table_name= 'karigar_rate_worker_details';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'karigar_rate_worker_details[id]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric'));
    return $rules;
  }
}