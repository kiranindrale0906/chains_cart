<?php
require_once APPPATH . "modules/core_users/models/Core_login_model.php";
class  Login_model extends Core_login_model {
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'login[email_id]',
                    'label' => 'Email',
                    'rules' => array('trim', 'required', 'valid_email',array('check_user_host',
                                                                			array($this,'check_user_host'))),
                  	 'errors' => array('check_user_host' => 'You Cant login on another host.')),
              array('field' => 'password',
                    'label' => 'Password',
                    'rules' => array('trim', 'required', array('verify_password_message',
                                                                array($this,'verify_password'))),
                    'errors' => array('verify_password_message' => 'Please enter a valid email and password'))
            );
    return $rules;
  }

  public function verify_password($encrypted_password) {
    $hashed_password = $this->login_model->get('encrypted_password', array("email_id" => $this->attributes['email_id']), '', array('row_array' => true));
    if(!empty($hashed_password))
      return (md5($encrypted_password) == $hashed_password['encrypted_password']) ? true : false;
    else
      return false;
  }

  public function check_user_host($email_id){
    if((HOST != 'BACKUP ARF' && HOST != 'BACKUP ARG') && $email_id == 'backup_admin@argold.com'){
  
  		return false;
  	}else{
  		return true;
  	}
  }

}

