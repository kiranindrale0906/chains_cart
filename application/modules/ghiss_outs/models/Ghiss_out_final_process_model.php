<?php 
require_once APPPATH . "modules/processes/models/Process_model.php";
class Ghiss_out_final_process_model extends Process_model{
  public $router_class = 'ghiss_out_final_processes';
  public $departments = array('Ghiss Melting');
  public $next_process_model ='';
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Ghiss Out';
    $this->attributes['process_name'] = 'Final Process';
    $this->attributes['chain_name'] = 'Wastage Melting';

    $this->department_not_deleted = array('Ghiss Melting');
    $this->set_out_lot_purity_from_tounch_purity = array('Ghiss Melting');
  }
}