<?php 
class Hook_kdm_detail_model extends BaseModel{
	protected $table_name= 'process_details';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->load->model(array('Process_model'));
	}
}