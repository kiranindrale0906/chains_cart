<?php
class Category_4 extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function _get_form_data(){
  	$this->data['chains'] = $this->model->get('name as name, name as id', array(), array(), array('table' => 'chains'));
  }
}