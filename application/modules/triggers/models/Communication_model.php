<?php
class Communication_model extends BaseModel {
  public function __construct($data=array()) {
    parent::__construct($data);
    $this->load->model(array('communications/template_model',
                             'communications/libraries/library_email',
                             'communications/libraries/library_sms',
                             'communications/libraries/library_web_push_notification',
                             'communications/libraries/library_web_push_notification'));
  }

  public function send_communication_email($variables,$template_code,$cron=false,$is_attachment =false){
    $template_id= $this->template_model->get('id',array('template_code='=>$template_code),'',array('row_array' => true))['id'];
    $template =  $this->template_model->find('id,name,fromemail,fromname, emailsubject,emailbody,emailto,cc,bcc',array('id='=>$template_id));
    if(empty($template))
      return;

    $data = 
    array (
      'variables' => $variables,
    );  
    $params  =  array();
    $params['data'] = $data;
    
    $email = $this->library_email->send($template,$params,'api','',$cron,$is_attachment);
  }

  public function send_communication_sms($variables,$template_code){
    $template_id= $this->template_model->get('id',array('template_code='=>$template_code),'',array('row_array' => true))['id'];
    $template =  $this->template_model->find('id,smstext,smsto',array('id='=>$template_id));
    if(empty($template))
      return;

    $data = 
    array (
        'variables' => $variables,
    );  
    $params  =  array();
    $params['data'] = $data;
    $sms = $this->library_sms->send($template,$params);
  }

  public function send_communication_notification($variables,$template_code){
    $template_id= $this->library_communication_templates_model->get_template_id($template_code);
    $template_data = 
    array (
        'variables' => $variables,
    );  
      $params  =  array();
      $params['template']['id']   =$template_id;
      $params['template']['data'] = $template_data;
      $push_notification = $this->library_push_notification->send($params);
  }

  public function getSiteDetails() {
    $data['site_url'] = 'http://ascratech.com/';
    $data['site_logo'] = $data['site_url']."images/logo.png";
    return $data;
  }

  public function array_append($source, $data) {
    foreach($data as $key => $value) {
      $source[$key] = $value;
    }
    return $source;
  }

}