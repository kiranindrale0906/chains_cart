<?php 
class Gpc_out_hold_process_model extends BaseModel{
	public $router_class = 'gpc_out_hold_processes';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'gpc_out_hold_processes[in_weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'
                        ));
    return $rules;
  }

 
  function save($after_save = true) {
    if(!empty($this->formdata['process_out_wastage_details'])){
      foreach ($this->formdata['process_out_wastage_details'] as $index => $process) {
        $process_data['id']=$process['process_id'];
        $process_obj = new gpc_out_hold_process_model($process_data);
        $process_obj->attributes['gpc_out_required_status'] = 1;
        $process_obj->update(false);
      }
    }
  }

}
