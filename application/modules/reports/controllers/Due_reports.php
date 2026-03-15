<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Due_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
  }

  public function update($id){
  	$this->due_report_model->update(false,array());
  }
}
?>