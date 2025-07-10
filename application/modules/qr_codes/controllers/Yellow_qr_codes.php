<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yellow_qr_codes extends BaseController { 
  public function __construct(){
    $this->_model='yellow_qr_code_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/yellow_qr_code_detail_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'yellow_qr_code_details'));
  } 

  public function _get_form_data() {                              
    if($this->router->method == 'edit' || $this->router->method == 'update' || $this->router->method == 'store'){
      if(!empty($this->data['record']['id'])){
        $this->data['yellow_qr_code_details']=$this->yellow_qr_code_detail_model->get(
                                    'FORMAT(net_weight,2) net_weight,
                                     FORMAT(dispatch_weight,2) dispatch_weight,
                                     FORMAT(other_stone,2) other_stone,
                                     FORMAT(stone_weight,2) stone_weight,
                                      percentage,FORMAT(weight,2) weight,less,
                                      FORMAT(length,2) length,item_code,km,
                                      total_stone,
                                      stone_count,',
                                    array('yellow_qr_code_id'=>$this->data['record']['id']));
        $this->data['yellow_qr_code_details']=!empty($this->data['yellow_qr_code_details'])?$this->data['yellow_qr_code_details']:array(array());
      }
      if($this->router->method == 'update' || $this->router->method == 'store')
        $this->data['yellow_qr_code_details'] = (isset($_POST['yellow_qr_code_details'])?
                                                $_POST['yellow_qr_code_details']:array(array()));
    }else{
      $this->data['yellow_qr_code_details'] = array(array());
    }
  }
  private function get_gpc_records() {
    $gpc_records=$this->process_model->get('',array('where_in'=>array('department_name'=>array("'GPC'","'GPC Or Rodium'")),'where'=>array('gpc_out!='=>0)));
    $weight=0;
    foreach ($gpc_records as $index => $value) {
      $this->data['gpc_records'][$index]=$value;
      $weight=$this->yellow_qr_code_detail_model->find('sum(weight) as total_weight',array('process_id'=>$value['id']))['total_weight'];
      $this->data['gpc_records'][$index]['total_weight']=!empty($weight)?$weight:0;
    }                                
  }

  public function _get_view_data() {
    $this->data['type'] = 'multiple';
    $this->data['yellow_qr_code_details'] = 
      $this->yellow_qr_code_detail_model->get('', array('yellow_qr_code_id' => $this->data['record']['id']));
  }

  public function view($id) {
    if (isset($_GET['type']) && $_GET['type'] == 'single') {
      parent::view($id);
    } else {
      $this->data['record'] = $this->model->find('', array('id' => $id));
      $this->_get_view_data();
      $this->load->view('qr_codes/yellow_qr_codes/qr_code', $this->data);
    }
    
  }
  public function delete($id) {
    $details = $this->yellow_qr_code_detail_model->get('',array('yellow_qr_code_id' => $id));
    if (!empty($details)) {
      foreach ($details as $index => $value) {
       $this->yellow_qr_code_detail_model->delete($value['id']);
      }
    }
    parent::delete($id);
    redirect('/qr_codes/yellow_qr_codes');
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'qr_codes/yellow_qr_codes';
    return $formdata;
  }
}
