<?php
class User_mobile_verify_trigger_model extends CI_model {
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('triggers/communication_model'));
  }

  public function execute_event($action, $attributes, $changed_attributes, $previous_attributes) { 
    if(MOBILE_VERIFICATION){
      $datetime_diff_minute=get_no_of_period_from_datetime($attributes['sms_sent_at'],'','i');
      if($datetime_diff_minute>0 || empty($attributes['sms_sent_at'])) {
        $template_code ='mobile_verify';
        $sms_verification['to']= $attributes['mobile_no'];
        $sms_verification['verify_code']= $attributes['mobile_verify_code'];
        $this->communication_model->send_communication_sms($sms_verification,$template_code);
      }
    }
  }
}