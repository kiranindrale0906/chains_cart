<?php
class Tounch_model extends BaseModel{
	protected $table_name = 'wastages';
	protected $id = 'id';
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('../core/process_model'));
	}
}