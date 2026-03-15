<?php

require_once APPPATH . "modules/processes/controllers/Processes.php";
class Ghiss_out_final_processes extends Processes {
  
  public function __construct(){
    $this->_model = 'Ghiss_out_final_process_model';
    parent::__construct();
  }
}