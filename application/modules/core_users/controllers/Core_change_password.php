<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_change_password extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->data['layout'] = 'login';
  }
  public function store(){
    parent::update(0);
  }
  public function _before_save($formdata, $action){
    $formdata['change_password']['id'] = $_SESSION['user_id'];
    $formdata['change_password']['encrypted_password'] = md5($formdata['change_password']['new_password']);
    unset($formdata['change_password']['old_password']);
    unset($formdata['change_password']['new_password']);
    return $formdata;
  }
  public function _after_save($formdata, $action){
    redirect(base_url().'users/logout');
  }
}
