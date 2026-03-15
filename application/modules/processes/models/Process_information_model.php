<?php 
class Process_information_model extends BaseModel{
	public $router_class = 'process_informations';
	protected $table_name= 'process_informations';
	public function __construct($data = array()){
		parent::__construct($data);
	}
	public function before_validate(){
	$this->attributes['balance']=($this->attributes['in_weight']+$this->attributes['stone_vatav'])-$this->attributes['out_weight']-$this->attributes['loss']-$this->attributes['wastage'];
	}

	public function validation_rules($klass='') {
    $rules = array(array('field' => 'process_informations[process_id]', 'label' => 'process_id','rules' => 'required'),
      array('field' => 'process_informations[in_weight]', 'label' => 'In Weight','rules' => 'required|greater_than[0]|numeric'));
    return $rules;
  }

}