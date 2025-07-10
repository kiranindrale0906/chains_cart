<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Para_final_process_model extends Process_model{
  protected $next_process_model = '';

  public $router_class = 'para_final_processes';
  public $departments = array('Dull','Round and Ball Chain','Hand Cutting','Final');
  public function __construct($data = array()){
    parent::__construct($data);
    $this->attributes['product_name'] = 'Office Outside';
    $this->attributes['process_name'] = 'Para Final Process';
    $this->department_not_deleted=array('Melting Start', 'Dull');
  }
  
}