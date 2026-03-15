<?php

class Template_model extends BaseModel {
  protected $table_name = 'library_communication_templates';
  protected $id = 'id';
  public $router_class = 'templates';

  public function __construct($data = array()) {
    parent::__construct($data); 
    // $this->load->library(array('libraries/mail_send'));
    $this->load->model(array('communications/libraries/template_rendering','communications/libraries/mail_send'));
  }

  public function validation_rules($klass='') {
    return array(
            array(
              'field' => 'templates[name]', 
              'label' => 'name',
              'rules' => array('trim','required'),
              'errors' => array('required' => 'Please enter name.')),
            array(
              'field' => 'templates[emailbody]', 
              'label' => 'email body.',
              'rules' => array('trim','required'),
              'errors' => array('required' => 'Please enter email body.')),
            array(
              'field' => 'templates[fromemail]', 
              'label' => 'email name.',
              'rules' => array('trim','valid_email'),
              'errors' => array('valid_email' => 'Please enter valid email id.')),
           /* array(
              'field' => 'templates[cc]', 
              'label' => 'email cc.',
              'rules' => array('trim','valid_email'),
              'errors' => array('valid_email' => 'Please enter valid email id.')),
            array(
              'field' => 'templates[bcc]', 
              'label' => 'email bcc.',
              'rules' => array('trim','valid_email'),
              'errors' => array('valid_email' => 'Please enter valid email id.')),
            array(
              'field' => 'templates[emailto]', 
              'label' => 'email emailto.',
              'rules' => array('trim','valid_email'),
              'errors' => array('valid_email' => 'Please enter valid email id.')),*/
            );
  }

  public function render_email($template,$email_data,$preview=true){
    $data = array();
    $data['emailbody'] = $this->template_rendering->get($template['emailbody'],$email_data);
    $data['fromemail'] = $this->template_rendering->get($template['fromemail'],$email_data);
    $data['fromname'] = $this->template_rendering->get($template['fromname'],$email_data);
    $data['emailto'] = $this->template_rendering->get($template['emailto'],$email_data);
    $data['cc'] = $this->template_rendering->get($template['cc'],$email_data);
    $data['bcc'] = $this->template_rendering->get($template['bcc'],$email_data);
    $data['emailsubject'] = $this->template_rendering->get($template['emailsubject'],$email_data);
    if($preview ==false){ 
     $data['email_hash'] = date('Ymdhis').rand(111,999);
     $email_data['variables']['unsubscribe_email'] =  $data['emailto'];
     $email_data['variables']['unsubscribe_email_base64_encode'] = base64_encode($data['emailto']);
     $html = $this->template_rendering->get($template['emailbody'],$email_data);
     $data['email_body'] = $this->mail_send->full_html($data['emailsubject'],$html);
    }
    return $data;
  }

  public function render_sms($template,$sms_data,$preview=true){
    $data = array();
    $data['smstext'] = $this->template_rendering->get($template['smstext'],$sms_data);
    if($preview ==false){
      $data['mobile_no'] =$this->template_rendering->get($template['smsto'],$sms_data);
    }
    return $data;
  }

  public function render_pushnotification($template,$push_notifications_data,$preview=true){
    $data = array();
    $data['webpushtext'] = $this->template_rendering->get($template['pushtext'],$push_notifications_data);
    if($preview ==false){
      $data['user_email']  = $this->template_rendering->get($template['pushto'],$push_notifications_data);
      $data['url']  = $this->template_rendering->get($template['pushurl'],$push_notifications_data);
      $data['image']  = $this->template_rendering->get($template['pushimage'],$push_notifications_data);
    }
    return $data;
  }
  public function render_web_pushnotification($template,$web_push_notifications_data,$preview=true){
    $data = array();
    $data['webpushtext'] = $this->template_rendering->get($template['webpushtext'],$web_push_notifications_data);
    if($preview ==false){
      $data['user_email']  = $this->template_rendering->get($template['webpushto'],$web_push_notifications_data);
      $data['url']  = $this->template_rendering->get($template['webpushurl'],$web_push_notifications_data);
      $data['image']  = $this->template_rendering->get($template['webpushimage'],$web_push_notifications_data);
    }
    return $data;
  }
  public function update_sentemails_status($data,$id){
    $data_value = $data+1;
    $template_model_obj = new Template_model();
    $template_model_obj->attributes['sentemails'] = $data_value;
    $template_model_obj->attributes['id'] = $id;
    $template_model_obj->update();
  }
}