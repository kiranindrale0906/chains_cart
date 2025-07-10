<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chain_purities extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model'));
  }

  public function _get_form_data(){
  	
  	$this->data['blank']=!empty($_GET['blank'])?$_GET['blank']:'';
    $this->data['products'] = get_process();
  }
}
