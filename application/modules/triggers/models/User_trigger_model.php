<?php
class User_trigger_model extends CI_model {
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function execute_event($action, $attributes, $changed_attributes, $previous_attributes){
    pr($action);
  }
}