<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Hcl_dashboard_model extends Core_dashboard_model{
	protected $table_name= 'users';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->include_cards = array('rope_ghiss_balance','hcl_process_balance','hcl_wastage_balance','rope_ghiss_process','hcl_loss');
	}
}