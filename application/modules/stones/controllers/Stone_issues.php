<?php
class Stone_issues extends BaseController {
  public function __construct() {
    $this->_model='stone_issue_model';
    parent::__construct();
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
}