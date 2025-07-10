<?php
class Dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model'));
  }

  public function index() {
  	$get_dashboard_url = get_dashboard_url();
    redirect(base_url().$get_dashboard_url);
  }
}