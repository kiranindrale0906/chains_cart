<?php
class Domestic_category_masters extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='index';
  }
}