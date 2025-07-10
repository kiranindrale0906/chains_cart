<?php
class Gpc_out_city_report_model extends BaseModel{
	protected $table_name = 'issue_departments';
	protected $id = 'id';

  public function __construct($data=array()) {
		parent::__construct($data);
	}
  
  public function validation_rules($klass='') {
    return $rules=array();
  }
}