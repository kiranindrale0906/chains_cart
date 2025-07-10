<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Refresh_hold extends Processes {

	public function __construct(){
    $this->_model='Refresh_hold_model';
    parent::__construct();
 	}
}
