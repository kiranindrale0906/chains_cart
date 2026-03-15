<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Ags extends Processes {
  public function __construct(){
    $this->_model='Choco_chain_ag_model';
    parent::__construct();
    $this->data['layout'] = 'table';
  } 
}