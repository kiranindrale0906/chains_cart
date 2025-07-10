<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Delay_report_karigars extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
  }
}
?>