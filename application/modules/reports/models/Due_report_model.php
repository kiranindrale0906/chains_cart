<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Due_report_model extends BaseModel{
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function update($after_save = false,$condition=array(),$action="update"){
  	$this->db->query("UPDATE processes SET expected_at = DATE_ADD(created_at, INTERVAL 24 HOUR)");

  }

}