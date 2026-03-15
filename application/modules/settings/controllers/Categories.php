<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model'));
  }

  public function create(){
    
    $this->data['record']['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name'] : '';
    $this->data['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name'] : '';
    parent::create();
  }

  public function _get_form_data(){
    $this->data['products'] = get_product_dropdown();
    $this->data['record']['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name'] : $this->data['record']['product_name'];
  }

  public function _after_save(){
    $this->data['redirect_url'] = base_url().'settings/categories';
  }
}
