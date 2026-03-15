<?php 
class Process_json_code_model extends BaseModel{
	public $router_class = 'process_json_codes';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model'));
	}
	public function validation_rules($klass='') {
	    $rules= array(array('field' => 'process_json_codes[id]', 'label' => 'Id',
	                        'rules' => 'trim|required'),
	                );
	    return $rules;
	  }

  	public function save($after_save = false){
	    $process = $this->Process_model->find('', array('id' => $this->attributes['id']));
	    $melting_wastage='';
	    if(!empty($process['melting_wastage'])){
	    	$melting_wastage=$process['melting_wastage']+$process['balance'];
	    }else{
	    	$melting_wastage=$process['balance'];
	    }
    	$model_name = get_model_name($process['product_name'], $process['process_name']);
	    $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
	    $process_obj = new $model_name['model_name']($process);
	   	$process_obj->attributes['melting_wastage'] = $melting_wastage;
	   	$process_obj->attributes['status'] = 'Complete';

	    $process_obj->before_validate();
	    $process_obj->save(false);
	    
  	}
}