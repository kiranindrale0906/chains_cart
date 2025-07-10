<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "modules/processes/controllers/Processes.php";
class Melting_processes extends Processes {
	
	public function __construct(){
    $this->_model="daily_drawer_melting_process_model";
    parent::__construct();
 	}
}