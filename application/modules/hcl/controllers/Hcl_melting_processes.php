<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/processes/controllers/Processes.php";

class Hcl_melting_processes extends Processes {
	public function __construct(){
    $this->_model='Hcl_melting_process_model';
    parent::__construct();
  }

  /*public function index() { 
    $processes=$this->model->get();
    $this->data['page_title']=get_product_value($this->router->module).' - '.get_process_value($this->router->class);

    foreach ($processes as $process) {
      if (!isset($this->data['records'][$process['row_id']]))
      $this->data['records'][$process['row_id']] = array();
      $this->data['records'][$process['row_id']][$process['department_name']] = $process;   
    }
    $this->load->view('layouts/table/index.php', $this->data);    
  }*/

}
