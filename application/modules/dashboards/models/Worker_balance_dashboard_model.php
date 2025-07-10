<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Worker_balance_dashboard_model extends Core_dashboard_model{
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
		
	}
}