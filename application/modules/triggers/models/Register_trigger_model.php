<?php
class Register_trigger_model extends CI_model {
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('triggers/communication_model'));
  }

  public function execute_event($action, $attributes, $changed_attributes, $previous_attributes){ 

    if(EMAIL_VERIFICATION){
      $template_code ='email_verification';
      $email_verification = array();
      $email_verification = $this->communication_model->array_append($email_verification,$this->communication_model->getSiteDetails()); 
      $email_verification['name']= $attributes['name'];
      $email_verification['email_id']= $attributes['email_id'];
      $email_verification['mobile_no']= $attributes['mobile_no'];
      $email_verification['id']= $attributes['id'];
      $email_verification['url'] = ADMIN_PATH.'core_users/email_verification/update/'.$attributes['id'];
      $this->communication_model->send_communication_email($email_verification,$template_code);
    }

    if(MOBILE_VERIFICATION){
      $template_code ='SC001';
      $sms_verification['mobile_no']= $attributes['mobile_no'];
      $sms_verification['security_code']= $attributes['mobile_verify_otp'];
      $this->communication_model->send_communication_sms($sms_verification,$template_code);
    }
    
  }
}