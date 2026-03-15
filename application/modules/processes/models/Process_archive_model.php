<?php 
class Process_archive_model extends BaseModel{
	public $router_class = 'process_archives';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

  public function before_validate(){
    if ($this->attributes['archive'] == 0) $this->attributes['archive'] = 1;
  }

	public function validation_rules($klass='') {
    $rules = array(array('field' => 'process_archives[id]', 'label' => 'id',
                         'rules' => 'required'));
    return $rules;
  }

  public function after_save($action) {
  	$processes = $this->get('id,archive', array('id !=' => $this->attributes['id'],
                                        'row_id' => $this->attributes['row_id']));
  	foreach ($processes as $index => $process) {
  		$process_archive_obj = new Process_archive_model($process);
      if($process['archive']==0) {
        $process_archive_obj->attributes['archive'] = 1;
  		  $process_archive_obj->save(false);
      }
  	}
  }
}