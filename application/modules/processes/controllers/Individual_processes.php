<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Individual_processes extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';

  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']='processes/individual_processes' ;
    return $formdata;
  }
  public function _get_form_data(){
    $jsoncode=!empty($_GET['jsoncode'])?json_decode($_GET['jsoncode'], true):'';
    if(!empty($jsoncode)){
    $this->data['record']=$jsoncode['process_detail'];
    }
  }
  
}