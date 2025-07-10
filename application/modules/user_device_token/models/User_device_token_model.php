<?php

class User_device_token_model extends BaseModel
{
  protected $table_name = 'user_device_tokens';
  protected $id = 'id';	
  public $router_class = 'user_device_token';
  public function __construct($data=array()) {
    parent::__construct($data);
  
  }
  public function validation_rules($klass='') {
    return array(
              array('field'=>'user_device_token[device_token]',
                    'label'=>'Device Token',
                    'rules'=>'trim')
            );
  }
}