<?php 
require_once(APPPATH.'modules/core_dashboards/models/Core_dashboard_model.php');
class Wastage_melting_dashboard_model extends Core_dashboard_model{
	protected $table_name= 'users';
	public function __construct($data = array()){
		parent::__construct($data);
		$this->include_cards = array('office_outside','daily_drawer_balance','melting_wastage_balance','daily_drawer_wastage','hcl_wastage_balance','hcl_process_balance','tounch','tounch_process','daily_drawer_process','pending_ghiss_balance','ghiss_process_balance','ghiss_balance','tounch_out_ghiss','rope_ghiss_process','loss_process_balance','loss_balance','refine_loss','tounch_fine_loss','hcl_loss','rope_ghiss_balance');
	}
}