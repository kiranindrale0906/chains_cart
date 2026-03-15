<?php
class Gpc_powder_issues extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('users/account_model',
                             'processes/process_model',
                             'processes/process_out_wastage_detail_model',
                             'settings/issue_purity_model',
                             //'refresh/refresh_model',
                             'issue_department_detail_model'));
  }

}