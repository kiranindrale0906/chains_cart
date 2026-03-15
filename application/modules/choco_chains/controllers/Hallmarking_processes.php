<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Hallmarking_processes extends Processes {

  public function __construct(){
    $this->_model='Choco_chain_hallmarking_process_model';
    parent::__construct();
  } 
}
