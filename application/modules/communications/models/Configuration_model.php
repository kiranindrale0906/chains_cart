<?php

class Configuration_model extends BaseModel {
  protected $table_name = 'library_communication_configurations';
  protected $id = 'id';   
  public $router_class = 'configurations';

  public function __construct($data=array()) {
    parent::__construct($data);   
  }

  public function validation_rules($klass='') { 
    $email_configuration_validation = array();
    $sms_configuration_validation = array();
    $web_push_configuration_validation = array();
    $email_sms_validition = array();
    $rules = array();
    if(!empty($_POST['configurations']['hostname']) || !empty($_POST['configurations']['username']) 
       || !empty($_POST['configurations']['password']) || !empty($_POST['configurations']['smtpsecure'])
       || !empty($_POST['configurations']['port']) || !empty($_POST['configurations']['fromemail'])
       || !empty($_POST['configurations']['fromname']) || !empty($_POST['configurations']['sengrid_api_key'])){

       $email_configuration_validation = array(
                                           array(
                                                  'field' => 'configurations[hostname]',
                                                  'label' => 'Host Name',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[username]',
                                                  'label' => 'User Name',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[password]',
                                                  'label' => 'Password',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[smtpsecure]',
                                                  'label' => 'Smpt Secure',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[port]',
                                                  'label' => 'Port',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[fromemail]',
                                                  'label' => 'From Email',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[fromname]',
                                                  'label' => 'From Name',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[sengrid_api_key]',
                                                  'label' => 'SendGrid Api Key',
                                                  'rules' => 'trim|required'),
                                         );
    }

    if (!empty($_POST['configurations']['smsusername']) || !empty($_POST['configurations']['smspassword']) 
       || !empty($_POST['configurations']['twilio_sid']) || !empty($_POST['configurations']['twilio_auth_token'])
       || !empty($_POST['configurations']['twilio_phone_number']) || !empty($_POST['configurations']['twilio_twiml_bin_url']) ){

         $sms_configuration_validation = array(
                                           array(
                                                  'field' => 'configurations[smsusername]',
                                                  'label' => 'Username',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[smspassword]',
                                                  'label' => 'Password',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[twilio_sid]',
                                                  'label' => 'Twilio SID',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[twilio_auth_token]',
                                                  'label' => 'Auth Token',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[twilio_phone_number]',
                                                  'label' => 'Phone Number',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[twilio_twiml_bin_url]',
                                                  'label' => 'TwiML Bin Url',
                                                  'rules' => 'trim|required'),
                                           
                                         );
    }

    if (!empty($_POST['configurations']['webpushtoken']) || !empty($_POST['configurations']['webauthdomain']) 
       || !empty($_POST['configurations']['webdatabaseurl']) || !empty($_POST['configurations']['webprojectid'])
       || !empty($_POST['configurations']['webstoragebucket']) || !empty($_POST['configurations']['webmessagingsenderid']) 
       || !empty($_POST['configurations']['webappid']) || !empty($_POST['configurations']['webmeasurementid'])){

         $web_push_configuration_validation = array(
                                           array(
                                                  'field' => 'configurations[webpushtoken]',
                                                  'label' => 'Web Acess Token',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webauthdomain]',
                                                  'label' => 'Auth Domain',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webdatabaseurl]',
                                                  'label' => 'DataBase URL',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webprojectid]',
                                                  'label' => 'ProjectId',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webstoragebucket]',
                                                  'label' => 'Storage Bucket',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webmessagingsenderid]',
                                                  'label' => 'Messaging SenderId',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webappid]',
                                                  'label' => 'AppId',
                                                  'rules' => 'trim|required'),
                                           array(
                                                  'field' => 'configurations[webmeasurementid]',
                                                  'label' => 'MeasurementId',
                                                  'rules' => 'trim|required'),
                                        
                                         );
    }
    $email_sms_validition = array_merge($email_configuration_validation, $sms_configuration_validation);
    $rules=  array_merge($email_sms_validition,$web_push_configuration_validation);
    return $rules;
  }
}