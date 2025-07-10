<?php 
class Finish_good_model extends BaseModel{
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
    
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'finish_goods[id]', 'label' => 'ID',
									      'rules' => 'trim',));
    return $rules;
  }
  public function save($after_save=true){
  	$finish_goods=array();
  	foreach ($this->attributes['finish_good_details'] as $index => $value) {
  		$finish_goods['id']=$value['process_id'];
  		$finish_goods['finish_good']=1;
  		$finish_goods_obj = new process_model($finish_goods);
	    $finish_goods_obj->update(false); 
  	}
  }
}
