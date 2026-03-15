<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Melting_processes extends Processes {
	
	public function __construct(){
    $this->_model="Rope_chain_melting_process_model";
    parent::__construct();
 	}
}