<?php
include_once APPPATH . "modules/refresh/models/Refresh_department_model.php";
class Api_refresh_department_model extends Refresh_department_model {
  public function __construct($data = array()) {
    parent::__construct($data);
  }
}