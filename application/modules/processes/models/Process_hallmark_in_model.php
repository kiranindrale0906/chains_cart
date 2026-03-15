<?php 
class Process_hallmark_in_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_hallmark_in';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_hallmark_in[hallmark_in]', 'label' => 'hallmark_in',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }
  public function before_validate() {
    $this->attributes['hallmark_in']=$_GET['in_weight'];
    $this->attributes['out_weight']=$this->attributes['hallmark_in'];
  }
}