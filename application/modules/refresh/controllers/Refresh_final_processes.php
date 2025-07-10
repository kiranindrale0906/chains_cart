<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Refresh_final_processes extends Processes {

  public function __construct(){
    $this->_model='Refresh_final_process_model';
    parent::__construct();
  }
}
