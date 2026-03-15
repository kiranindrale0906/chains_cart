<?php

class Pushnotification_log_model extends BaseModel {
  protected $table_name = 'library_pushnotification_logs';
  protected $id = 'id';	
  
  public function __construct() {
    parent::__construct();
  }
  public function save($data=''){
  	$Pushnotification_log_obj = new Pushnotification_log_model($data);
  	$Pushnotification_log_obj->attributes = $data;
  	$Pushnotification_log_obj->store($Pushnotification_log_obj->attributes);
  }
}