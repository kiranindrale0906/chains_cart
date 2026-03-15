<?php

class Sms_log_model extends BaseModel {
  protected $table_name = 'library_sms_logs';
  protected $id = 'id';
  public $router_class = 'sms_logs';

  public function __construct() {
    parent::__construct();
  }
  
  public function save($data='') {
    $Sms_log_obj = new Sms_log_model($data);
    $Sms_log_obj->attributes = $data;
    $Sms_log_obj->store($Sms_log_obj->attributes);
  }
}
