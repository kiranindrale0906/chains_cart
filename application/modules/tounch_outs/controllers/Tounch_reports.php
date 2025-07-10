<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tounch_reports extends BaseController {
  
  public function __construct(){
    parent::__construct();
  }
  public function _get_form_data() {
    $this->data['page_no']=!empty($_GET['page_no'])?$_GET['page_no']:'';
  }

  function _after_save($formdata, $action){
  	$page_no='';
  	if(!empty($formdata['page_no'])){
  		$page_no='?1=1&page_no='.$formdata['page_no'];
  	}
    $this->data['redirect_url']= ADMIN_PATH.'tounch_outs/tounch_reports'.$page_no;
    return $formdata;
  }
}
  