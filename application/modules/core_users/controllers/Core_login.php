<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Core_login extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('users/User_model','users/users_user_role_model','users/user_role_permission_model'));
    if ($this->db->table_exists('ip_addresses'))
      $this->load->model('users/ip_address_model');
    $this->data['layout'] = 'login';
  }

  public function store(){
    parent::update(0);
  }

  public function _before_save($formdata, $action){
    $id = $this->User_model->get('id',array("email_id" => $formdata['login']['email_id']), '',array('row_array' => true))['id'];
    $formdata['login']['id'] = $id;
    $formdata['login']['last_sign_in_at'] = date('Y-m-d H:i:s');
    $formdata['login']['last_sign_in_ip'] = $_SERVER['REMOTE_ADDR'];
    return $formdata;
  } 

  public function _after_save($formdata, $action){
    $user_data = $this->User_model->set_user_data_in_session(array("email_id" => $formdata['login']['email_id']));
    
    if ($this->db->table_exists('ip_addresses'))
      $check_ip_address = $this->ip_address_model->find('',array('ip_address'=>$_SERVER['REMOTE_ADDR']));
    else
      $check_ip_address = '';

    $user_role_ids=!empty($user_data['user_role_ids'])?$user_data['user_role_ids']:0;
    $controller_list = $this->user_role_permission_model->get('controller_name 
                                                              as controller_name',
                                                          array('where_in' => 
                                                              array('user_role_id' => $user_role_ids)));
    
    $user_data['controller_list'] = array_column($controller_list, 'controller_name');
    $this->session->set_userdata($user_data);
    if(empty($check_ip_address) && $user_data['do_not_check_ip']==0){
      redirect('users/logout');
    }

    if(isset($_SESSION['http_referer']) && !(empty($_SESSION['http_referer']))){
      $redirect_url =  $_SESSION['http_referer'];
    }
    else{
      $redirect_url = base_url();
    }
    redirect($redirect_url);
  }
}
