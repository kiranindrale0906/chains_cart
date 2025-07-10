<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "modules/processes/controllers/Processes.php";
class Fire_tounch_daily_drawer_processes extends Processes {
	
	public function __construct(){
    $this->_model="fire_tounch_daily_drawer_process_model";
    parent::__construct();
 	}
}