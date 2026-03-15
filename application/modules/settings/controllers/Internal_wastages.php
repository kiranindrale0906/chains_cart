<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Internal_wastages extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/internal_wastage_model','processes/process_model','settings/same_karigar_model'));
    //$this->date_fields = array(array('same_karigars','due_date','settings/same_karigar_model'));
  }

  public function _get_form_data(){
    $this->data['blank']=!empty($_GET['blank'])?$_GET['blank']:'';
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    $record =& $this->data['record'];
    $this->data['Internal_wastages'] = array();
    $this->data['product_names']=$this->same_karigar_model->get('distinct(product_name) as name,product_name as id');
    
  }

  function _after_save($formdata, $action){
    $page_no='';
    if(!empty($formdata['page_no'])){
      $page_no='?1=1&page_no='.$formdata['page_no'];
    }
    $this->data['redirect_url']= ADMIN_PATH.'settings/internal_wastages'.$page_no;
    return $formdata;
  }
 
}