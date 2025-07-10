<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "modules/processes/controllers/Processes.php";
class Pipe_cuttings extends Processes {
	public function __construct(){
    parent::__construct();
  }
}