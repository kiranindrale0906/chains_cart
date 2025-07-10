<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Office_days extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'index';
  }

}
?>