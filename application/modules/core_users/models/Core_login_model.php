<?php
class  Core_login_model extends BaseModel {
  protected $table_name = 'users'; 
  protected $id = 'id';
  public $router_class = 'login';
  public function __construct($data=array()) {
    parent::__construct($data);
  }
  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'login[email_id]',
                    'label' => 'Email',
                    'rules' => array('trim', 'required', 'valid_email')),
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

}
