<?php
class Processes_name extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='view';
  }
}