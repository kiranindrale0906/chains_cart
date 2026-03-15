<?php
class Alloy_element_details extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='index';
  }
}