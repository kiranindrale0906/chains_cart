<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Fire_tounch_tounch_out_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'fire_tounch_tounch_outs';
  public $departments = array('Fire Tounch Tounch Out');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name']    = 'Fire Tounch Out';
    $this->attributes['process_name']    = 'Fire Tounch Tounch Out';
    $this->attributes['department_name'] = 'Fire Tounch Tounch Out';
    $this->department_not_deleted=array('Fire Tounch Tounch Out');
  }
}