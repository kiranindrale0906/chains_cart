<?php
class Account_model extends BaseModel {
  protected $table_name = 'accounts';
  protected $id = 'id';

  public function __construct($data = array()) {
    parent::__construct($data);
  }
  public function validation_rules($klass='') {
    return array(
            array('field' => 'accounts[name]', 
                  'label' => 'Name', 
                  'rules' => 'trim|required'),
            array('field' => 'accounts[email]', 
                  'label' => 'Email',
                  'rules' => array('trim', 'required', 
                              array('check_unique_email', array($this, 'check_unique_email'))),
                  'errors'=> array('check_unique_email' => 'Email already exist.')),
            array('field' => 'accounts[phone_number]', 
                  'label' => 'Mobile No',
                  'rules' => 'trim|required'));
  }
  public function before_validate() {
    $this->attributes['license_validity_date'] = date('Y-m-d h:m:s',strtotime($this->attributes['license_validity_date']));
    parent::before_validate();
  }

  public function check_unique_email($email) {
    if(!empty($email)) {
      return parent::check_unique('email');
    }
    else 
      return true;
    
  }
}