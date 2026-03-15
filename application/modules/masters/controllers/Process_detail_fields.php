<?php
class Process_detail_fields extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='view';
  }
}