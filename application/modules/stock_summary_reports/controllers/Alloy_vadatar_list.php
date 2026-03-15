<?php
class Alloy_vadatar_list extends BaseController {
  public function __construct() {
    parent::__construct();
  }
	public function index() {
    $this->where = "alloy_vodatar != 0 and alloy_vodatar IS NOT NULL";
    parent::index();
  }

}


