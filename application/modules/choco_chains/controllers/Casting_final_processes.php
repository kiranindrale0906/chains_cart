<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Casting_final_processes extends Processes {
  public function __construct(){
    $this->_model='Choco_chain_casting_final_process_model';
    parent::__construct();
    $this->data['layout'] = 'table';
  } 
}