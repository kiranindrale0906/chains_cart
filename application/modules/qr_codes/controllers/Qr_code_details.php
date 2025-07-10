<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_code_details extends BaseController { 
  public function __construct(){
    $this->_model='qr_code_detail_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/qr_code_detail_model','qr_codes/qr_code_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'qr_code_details'));
  } 
   
  public function view($id) { 
    $this->data['qr_code_details']=$this->qr_code_detail_model->get('',array('id'=>$id));  
    $this->data['record']=$this->qr_code_model->find('',array('id'=>$_GET['qr_code_id']));  
    $this->load->view('qr_codes/qr_codes/qr_code', $this->data);
  }
  public function _after_delete($id){
    redirect(ADMIN_PATH.'qr_codes/qr_codes');
  }
}
