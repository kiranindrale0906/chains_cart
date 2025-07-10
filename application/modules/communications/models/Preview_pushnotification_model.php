<?php

class Preview_pushnotification_model extends BaseModel {
  protected $table_name = 'library_pushnotification_logs';
  protected $id = 'id';	
  public $router_class = 'preview_pushnotifications';
  
  public function __construct($data =array()) {
    parent::__construct($data);
  }
}