<?php

class Web_pushnotification_log_model extends BaseModel {
  protected $table_name = 'library_web_pushnotification_logs';
  protected $id = 'id';	
  
  public function __construct() {
    parent::__construct();
  }
  public function save($data=''){
  	$Web_pushnotification_log_obj = new Web_pushnotification_log_model($data);
  	$Web_pushnotification_log_obj->attributes = $data;
  	$Web_pushnotification_log_obj->store($Web_pushnotification_log_obj->attributes);
  }
}