<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Refresh extends Processes {

	public function __construct(){
    $this->_model='Refresh_model';
    parent::__construct();
 	}
}
