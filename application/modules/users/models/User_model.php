<?php
require_once APPPATH . "modules/core_users/models/Core_user_model.php";
class User_model extends Core_user_model {
	//protected $load_trigger = true;
  public function __construct($data=array()) {
    parent::__construct($data);
  }
}