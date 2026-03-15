<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loss_categories extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'settings/same_karigar_model'));
  }
  public function _get_form_data(){
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
  	if($this->router->method=='edit'){
  	$department_name = $this->process_model->get('DISTINCT(department_name) as id,department_name as name',array('loss >'=>0),array(),array('order_by'=>'department_name asc'));
  	$this->data['department_name'] = $department_name;

  	}else{
  	$department_name = $this->process_model->get('DISTINCT(department_name) as id,department_name as name',array('loss >'=>0,'department_name not in (select department_name from loss_categories)'=>NULL),array(),array('order_by'=>'department_name asc'));
  	$this->data['department_name'] = $department_name;
  	}
 
  }
  function _after_save($formdata, $action){
    $page_no='';
    if(!empty($formdata['page_no'])){
      $page_no='?1=1&page_no='.$formdata['page_no'];
    }
    $this->data['redirect_url']= ADMIN_PATH.'settings/loss_categories'.$page_no;
    return $formdata;
  }
}