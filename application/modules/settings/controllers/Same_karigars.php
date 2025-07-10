<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Same_karigars extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model','settings/karigar_model','processes/process_model'));
    $this->date_fields = array(array('same_karigars','due_date','settings/same_karigar_model'));
  }

  public function index() {
    if(!empty($_POST['dropdown_department']) && !empty($_POST['process'])) {
      $product_name=$_POST['product'];
      $process=$_POST['process'];
      $departments =get_department_dropdown($_POST['product'], $_POST['process']);
          
      echo json_encode(array('departments'=>$departments,'status'=>'success',
                             'js_function'=>'populate_department_option(response)')); die; 
    }
    parent::index();
  }

  public function _get_form_data(){
    $this->data['blank']=!empty($_GET['blank'])?$_GET['blank']:'';
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    $record =& $this->data['record'];
    $this->data['products']      = get_product_dropdown();
    $this->data['processes']     = array();
    $this->data['departments']   = array();
    $this->data['karigar_name']  =array();

    if (!empty($record['product_name'])) {
      $this->data['processes'] = get_process_dropdown($record['product_name']);
    }
      $this->data['karigar_name'] = $this->karigar_model->get('distinct(karigar_name) as name ,karigar_name as id');

    if (!empty($record['product_name']) && !empty($record['process_name'])) {
      $this->data['departments'] = get_department_dropdown($record['product_name'], $record['process_name']);
    }
    
  }

  function _after_save($formdata, $action){
    $page_no='';
    if(!empty($formdata['page_no'])){
      $page_no='?1=1&page_no='.$formdata['page_no'];
    }
    $this->data['redirect_url']= ADMIN_PATH.'settings/same_karigars'.$page_no;
    return $formdata;
  }
 
}