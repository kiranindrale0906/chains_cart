<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Refresh_hand_dull_processes extends Processes {

  public function __construct(){
    $this->_model='Refresh_hand_dull_process_model';
    parent::__construct();
  }
}
