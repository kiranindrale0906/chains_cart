<?php

class Unsubscribe_model extends BaseModel {
  protected $table_name = 'unsubscribes';
  protected $id = 'id';
  public $router_class = 'email_logs';
  	
  public function __construct($data=array()) {
    parent::__construct($data);
  }
}