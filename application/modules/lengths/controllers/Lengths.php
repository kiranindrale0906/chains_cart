<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lengths extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'index';
    $this->load->model(array('lengths/length_cart_model', 'lengths/length_cart_detail_model'));
  }
  
  public function index() {
    $this->data['lengths'] = $this->length_model->get('id,design_code,range,weight,length',array(),array(),array('order_by'=>'design_code'));
    $this->data['length_carts'] = $this->length_cart_model->find('id',array(),array(),array('order_by'=>'id desc','limit'=>array('0','1')));
    $this->data['length_cart_details'] = $this->length_cart_detail_model->get('length_cart_id,design_code,range,weight,selected_value,quantity',
                                                                              array('length_cart_id'=>$this->data['length_carts']['id']));//pd($this->data['length_cart_details']);
    $this->load->render('lengths/lengths/index', $this->data);
  }
  public function _after_save($formdata,$method) {
    $this->data['redirect_url'] = ADMIN_PATH.'lengths/lengths';
  }
  
  public function view($id) {
    
    $html = $this->load->view('lengths/lengths/view','',TRUE);
    echo json_encode(array('status'=>'success','js_function'=>'get_json()','data'=>$html,'open_modal'=>TRUE));
  }
}