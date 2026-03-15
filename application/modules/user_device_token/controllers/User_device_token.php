<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_device_token extends BaseController {
  protected $load_helper = false; 
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->router_class = 'user_device_token';
  }
  public function store(){
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
      $_POST['user_device_token']['user_id'] = $_SESSION['user_id'];
    }
    $userDeviceTokenData = $this->user_device_token_model->find('id,user_id', array('device_token' => $_POST['user_device_token']['device_token']));
    if(empty($userDeviceTokenData)){
      parent::store();
    }else if(!empty($userDeviceTokenData) && isset($_POST['user_device_token']['user_id']) && $userDeviceTokenData['user_id'] ==0){
      $_POST['user_device_token']['id']=$userDeviceTokenData['id'];
      parent::update(0);
    }
    $response = array('status'=>'success');
    echo json_encode($response);
  }
}
