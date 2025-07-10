<?php 
class Process_category_two_model extends BaseModel{
	protected $table_name= 'processes';
	public $router_class= 'process_category_two';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('processes/Process_model','processes/Process_field_model'));
	}
	public function validation_rules($klass='') {
    $rules= array(array('field' => 'process_category_two[melting_lot_category_two]', 'label' => 'Category Two',
                        'rules' => 'trim|required'),
                );
    return $rules;
  }

  public function save($after_save = false){
    $process = $this->Process_model->find('row_id', array('id' => $this->attributes['id']));
    $processes = $this->Process_model->get('', array('row_id' => $process['row_id']));
    if(!empty($processes)) {
      foreach ($processes as $process) {
        $process['melting_lot_category_two'] = $this->attributes['melting_lot_category_two'];
        $process_obj = new Process_model($process);
        $process_obj->update(false);
      }
    }
  }
}