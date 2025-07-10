<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_lot_tagging_details extends BaseController { 
  public function __construct(){
    $this->_model='generate_lot_tagging_detail_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('taggings/generate_lot_tagging_detail_model','taggings/generate_lot_tagging_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'generate_lot_tagging_details'));
  } 
   
  public function view($id) { 
    $this->data['generate_lot_tagging_details']=$this->generate_lot_tagging_detail_model->get('',array('id'=>$id));  
    $this->load->view('taggings/generate_lot_taggings/tagging', $this->data);
  }
  public function _after_delete($id){
    redirect(ADMIN_PATH.'taggings/generate_lot_taggings');
  }
}
