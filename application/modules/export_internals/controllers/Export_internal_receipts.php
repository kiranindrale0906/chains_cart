<?php
class Export_internal_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
}