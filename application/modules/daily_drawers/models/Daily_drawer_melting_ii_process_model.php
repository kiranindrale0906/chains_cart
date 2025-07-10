<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_melting_ii_process_model extends Process_model{
  protected $next_process_model = '';
	public $router_class = 'melting_ii_processes';
  public $departments=array();
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Daily Drawer';
		$this->attributes['process_name'] = 'Melting II';
    $this->attributes['chain_name'] = 'Wastage Melting';
    
    $this->departments = array('Daily Drawer Melting II');
    //$this->compute_tounch_loss_fine_departments = array('Daily Drawer Melting II');
    $this->set_out_lot_purity_from_tounch_purity = array('Daily Drawer Melting II');
	}

  //$this->load->model('daily_drawers/daily_drawer_melting_process_model');
  //$this->daily_drawer_melting_process_model->update_all_daily_drawer_melting_process_start_records();
}