<?php
class Forgot_password_trigger_model extends CI_model {
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('triggers/communication_model'));
  }

  public function execute_event($action, $attributes, $changed_attributes, $previous_attributes){ 
    $template_code ='forgot_password';
    $forgot_password = array();
    //$forgot_password = $this->communication_model->array_append($forgot_password,$this->communication_model->getSiteDetails());
    $forgot_password['name']= $attributes['name'];
    $forgot_password['subject']= 'Forgot Password';
    $forgot_password['emailto']= $attributes['email'];
    $forgot_password['reset_token']= $attributes['reset_token'];
    $forgot_password['url'] = ADMIN_PATH.'users/reset_password/edit/'.$attributes['reset_token'];
    $this->communication_model->send_communication_email($forgot_password,$template_code);
  }
}