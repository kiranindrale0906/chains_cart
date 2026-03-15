<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alloy_element_detail_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('masters/alloy_element_detail_model');
  }
  public function index(){

  	$this->data['record']['company_name']=(!empty($_GET['company_name']))?$_GET['company_name']:'';
  	$where=array();
  	$this->data['record']['alloy_name']=(!empty($_GET['alloy_name']))?$_GET['alloy_name']:'';
  	if(!empty($this->data['record']['company_name'])){
  		$where['company_name']=$this->data['record']['company_name'];
  	}
  	$where_alloy=array();
  	if(!empty($this->data['record']['company_name'])){
  		$where_alloy['company_name']=$this->data['record']['company_name'];
  	}if(!empty($this->data['record']['alloy_name'])){
  		$where_alloy['alloy_name']=$this->data['record']['alloy_name'];
  	}
  	$this->data['company_name'] = $this->alloy_element_detail_model->get('company_name as name,company_name as id');
  	$this->data['alloy_name'] = $this->alloy_element_detail_model->get('alloy_name as name,alloy_name as id');
  	$this->data['record']['alloy_element_details'] = $this->alloy_element_detail_model->get('',$where_alloy);
  	parent::view(1);
  } 
}
?>