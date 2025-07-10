<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_lot_qr_code_details extends BaseController { 
  public function __construct(){
    $this->_model='generate_lot_qr_code_detail_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/generate_lot_qr_code_detail_model','qr_codes/generate_lot_qr_code_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'generate_lot_qr_code_details'));
  } 
   
  public function view($id) { 
    $this->data['generate_lot_qr_code_details']=$this->generate_lot_qr_code_detail_model->get('',array('id'=>$id));  
    $this->load->view('qr_codes/generate_lot_qr_codes/qr_code', $this->data);
  }
  public function _after_delete($id){
    redirect(ADMIN_PATH.'qr_codes/generate_lot_qr_codes');
  }
}
