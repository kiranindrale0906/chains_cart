<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Cutting_wires extends Processes {
	public function __construct(){
    parent::__construct();
  }
}