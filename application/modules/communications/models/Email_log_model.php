<?php
class Email_log_model extends BaseModel{
  
  protected $table_name = 'library_email_logs';
  protected $id = 'id';
  public $router_class = 'email_logs';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function save($data='') {
    $Email_log_obj = new Email_log_model($data);
    $Email_log_obj->attributes = $data;
    $Email_log_obj->store($Email_log_obj->attributes);
  }
}