<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Delay_report_karigar_model extends Core_dashboard_model{
	protected $table_name= 'delay_report_karigars';
	public function __construct($data = array()){
		parent::__construct($data);
	}
}