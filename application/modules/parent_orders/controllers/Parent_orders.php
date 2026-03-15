<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_orders extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->data['ajax_success_function']  = 'location.reload()';
  }

  public function index() {
    if (!empty($_GET['person_name']) && !empty($_GET['chain_name']) && !empty($_GET['melting'])) {
      $id = null;
      if(isset($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id'];
      }
      $name = $this->model->get_name($_GET['person_name'], $_GET['chain_name'], $_GET['melting'], $id);
      echo json_encode(array('name'        => $name,
                             'status'      => 'success',
                             'open_modal'  => FALSE,
                             'js_function' => 'set_parent_order_name(response.name)'));die;
    }
    parent::index();
  }
  public function _get_form_data() {
    $this->data['chain_names'] = get_parent_order_chain_name();
    $this->data['meltings'] = get_parent_order_meltings();
  }
}
