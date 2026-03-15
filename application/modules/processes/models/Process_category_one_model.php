<?php 
class Process_category_one_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_category_one';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_category_one[melting_lot_category_one]', 'label' => 'Category one',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function save($after_save = false){
    $process = $this->Process_model->find('row_id', array('id' => $this->attributes['id']));
    $processes = $this->Process_model->get('', array('row_id' => $process['row_id']));
    if(!empty($processes)) {
      foreach ($processes as $process) {
        $process['melting_lot_category_one'] = $this->attributes['melting_lot_category_one'];
        $process_obj = new Process_model($process);
        $process_obj->update(false);
      }
    }
  }
}