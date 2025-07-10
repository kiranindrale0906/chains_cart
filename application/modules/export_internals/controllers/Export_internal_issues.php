<?php
class Export_internal_issues extends BaseController {
  public function __construct() {
    $this->_model='export_internal_issue_model';
    parent::__construct();
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
}