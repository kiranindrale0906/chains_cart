<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_drawer_wastage_categories extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model'));
  }

  public function _get_form_data(){
    $record =& $this->data['record'];
    $this->data['dropdown_data'] = $this->same_karigar_model->get_product_process_department_data();
    $this->data['products']      = $this->same_karigar_model->get_product_dropdown();
    $this->data['processes']     = array();
    $this->data['departments']   = array();

    if (!empty($record['product_name'])) {
      $this->data['processes'] = $this->same_karigar_model->get_process_dropdown($record['product_name']);
    }

    if (!empty($record['product_name']) && !empty($record['process_name'])) {
      $this->data['departments'] = $this->same_karigar_model->get_department_dropdown($record['product_name'], $record['process_name']);
    }
  }
}
