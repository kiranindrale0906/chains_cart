<?php 

include_once APPPATH . "modules/processes/models/Process_model.php";
class Choco_chain_casting_seventy_final_process_model extends Process_model{
	public $router_class = 'casting_seventy_final_processes';
	public $departments = array('Melting Start','Filing','Pasta','Lobster','Shampoo', 'Buffing','Hand Cutting','Hand Dull','Buffing II','GPC Or Rodium','QC Department');
  protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Choco Chain';
		$this->attributes['process_name'] = 'Casting 75 Final Process';
		$this->load->model(array('melting_lots/melting_lot_model','refresh/refresh_hold_model'));
		$this->department_not_deleted=array('Start','Filing');
		$this->set_wastage_purity_equal_to_in_purity = array('Lobster');
	}
}