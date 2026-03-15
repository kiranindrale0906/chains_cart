<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Department_dashboard_model extends Core_dashboard_model{
	protected $table_name= 'users';
	public function __construct($data = array()){
		parent::__construct($data);
	}
}