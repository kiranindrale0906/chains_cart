<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Length_carts extends BaseController {
  public function __construct(){
    //$this->load_helper = false;
    parent::__construct();
    //$this->redirect_after_save = 'settings/lengths';
    $this->redirect_after_save = 'view';
    $this->load->model(array('lengths/length_cart_detail_model','lengths/length_model'));
  }
  
  public function _after_save($formdata,$method) {
    $this->data['redirect_url'] = ADMIN_PATH.'lengths/lengths';
  }
  
  public function _get_view_data(){
     $this->data['record']['length_cart_details'] = $this->length_cart_detail_model->get('length_cart_id,design_code,range,weight,length,selected_value,quantity',
                                                                              array('length_cart_id'=>$this->data['record']['id']));
  }
}