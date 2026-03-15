<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Chain_making_processes extends Processes {
	
	public function __construct(){
    $this->_model="Choco_chain_chain_making_process_model";
    parent::__construct();
 	}
}