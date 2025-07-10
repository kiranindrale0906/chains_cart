<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_issue_purities extends BaseController {
  public function __construct(){
    parent::__construct();
  }

  public function create() {
    if (!isset($_GET['process_id'])) redirect(ADMIN_PATH.'issue_departments/issue_departments');

    $process_issue_purity = $this->model->find('id', array('process_id' => $_GET['process_id']));
    if (!empty($process_issue_purity)) redirect(ADMIN_PATH.'settings/process_issue_purities/edit/'.$process_issue_purity['id']);

    $this->data['record']['process_id'] = $_GET['process_id'];
    $this->data['record']['wastage'] = $_GET['weight'];
    parent::create();
  }
}
