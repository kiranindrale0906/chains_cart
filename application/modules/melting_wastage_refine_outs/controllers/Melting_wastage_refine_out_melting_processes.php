<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "modules/processes/controllers/Processes.php";
class Melting_wastage_refine_out_melting_processes extends Processes {
	public function __construct(){
    $this->_model="Melting_wastage_refine_out_melting_process_model";
    parent::__construct();
 	}
}