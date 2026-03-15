<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_departments extends BaseController {
  
  public function __construct(){
    parent::__construct();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_departments']['id'];
  }

}