<?php
class  Core_register_model extends BaseModel {
  protected $table_name = 'users'; 
  protected $id = 'id';
  public $router_class = 'register';
  public function __construct($data=array()) {
    parent::__construct($data);
  }
  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'register[name]',
                    'label' => 'Name',
                    'rules' => array('trim', 'required', 'max_length[50]')),
              array('field' => 'register[email_id]',
                    'label' => 'Email',
                    'rules' => array('trim', 'required', 'max_length[20]', 'valid_email', 'is_unique[users.email_id]')),
              array('field' => 'register[mobile_no]',
                    'label' => 'Contact No',
                    'rules' => array('trim', 'required', 'regex_match[/^[0-9]{12}$/]')),
              array('field' => 'register[encrypted_password]',
                    'label' => 'Password',
                    'rules' => 'trim|required|max_length[50]|matches[confirm_password]'),
              array('field' => 'confirm_password',
                    'label' => 'Confirm Password',
                    'rules' => 'trim|required|max_length[50]')
            );
    return $rules;
  }
  public function before_save($action){
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $this->attributes['access_token'] = md5(substr(str_shuffle($string), 0, 15));
    $this->attributes['encrypted_password'] = md5($this->attributes['encrypted_password']);
    $this->attributes['mobile_verify_otp'] = mt_rand(100000, 999999);
  }
}
