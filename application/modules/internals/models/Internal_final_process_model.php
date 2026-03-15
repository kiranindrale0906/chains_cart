<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Internal_final_process_model extends Process_model{
  protected $next_process_model = '';
  
  public $router_class = 'internal_final_processes';
  public $departments = array('Final');
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Internal';
    $this->attributes['process_name'] = 'Internal Final Process';
    $this->attributes['chain_name'] = 'Internal';
    
    $this->department_not_deleted = array('Final');
    $this->set_out_lot_purity_from_tounch_purity = array('Final');
  }
}
