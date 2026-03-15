<?php
class Templates extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->xss_clean_form_data = false;
  }
}