<?php
class Mysql_analytics extends BaseController {
  protected $load_helper = false;
  public function __construct() {
    parent::__construct();
  }

  public function _get_form_data() {
    $this->data['logs'] = $this->mysql_analytic_model->get_logs();
  }
}

?>