<?php 
class Process_hook_kdm_purity_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_hook_kdm_purities';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_hook_kdm_purities[hook_kdm_purity]', 'label' => 'Hook Kdm Purity',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function save($after_save = false){
    $process = $this->Process_model->find('row_id,melting_lot_id', array('id' => $this->attributes['id']));
    $processes = $this->Process_model->get('', array('melting_lot_id' => $process['melting_lot_id']));
    if(!empty($processes)) {
      foreach ($processes as $process) {
        $process['hook_kdm_purity'] = $this->attributes['hook_kdm_purity'];
        $process_obj = new Process_model($process);
        $process_obj->update(false);
      }
    }
  }
}