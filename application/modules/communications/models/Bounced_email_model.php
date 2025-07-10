<?php

class Bounced_email_model extends BaseModel {
  protected $table_name = 'library_bounced_emails';
  protected $id = 'id';
  public $router_class ='bounced_emails';
  	
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'email_address',
                    'label' => 'Email',
                    'rules' => array('trim', 'required', 'valid_email'))
            );
    return $rules;
  }
}