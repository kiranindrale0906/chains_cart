<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Filing_ii_processes extends Processes {
  public function __construct(){
    $this->_model='arc_para_filing_ii_process_model';
    parent::__construct();
    $this->data['layout'] = 'table';
  } 
}