<?php
class Metal_issues extends BaseController {
  public function __construct() {
    $this->_model='metal_issue_model';
    parent::__construct();
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
}