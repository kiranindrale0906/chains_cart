<?php
class User_email_verify_trigger_model extends CI_model {
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('triggers/communication_model'));
  }

  public function execute_event($action, $attributes, $changed_attributes, $previous_attributes) { 
    if(EMAIL_VERIFICATION){
      $datetime_diff_minute=get_no_of_period_from_datetime($attributes['email_sent_at'],'','i');
      if($datetime_diff_minute>0 || empty($attributes['email_sent_at'])){
        $template_code ='email_verify';
        $email_verify = array();
        $email_verify['name']= $attributes['name'];
        $email_verify['subject']= 'Email Verification Code';
        $email_verify['emailto']= $attributes['email_id'];
        $email_verify['verify_code'] =$attributes['email_verify_code'];
        $this->communication_model->send_communication_email($email_verify,$template_code);
      }    
    }
  }
}