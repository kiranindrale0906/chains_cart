<?php
class Machine_masters extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='index';
    $this->load->model(array('processes/process_model'));
  }

  public function _get_form_data(){
    $this->data['blank'] = !empty($_GET['blank'])?$_GET['blank']:'';
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if (isset($_GET['product_name'])) $this->data['record']['product_name'] = $_GET['product_name'];
    if (isset($_GET['process_name'])) $this->data['record']['process_name'] = $_GET['process_name'];
    if (isset($_GET['department_name'])) $this->data['record']['department_name'] = $_GET['department_name'];
    
    $this->data['product_names'] = $this->get_distinct_values_for_dropdown('product_name');
    
    $this->data['process_names'] = $this->get_distinct_values_for_dropdown('process_name');
    $this->data['machine_sizes'] = $this->get_distinct_values_for_dropdown('machine_size');
    $this->data['design_codes'] = $this->get_distinct_values_for_dropdown('design_code');
    $this->data['department_names'] = $this->get_distinct_values_for_dropdown('department_name');
    $this->data['category_one_names'] = $this->get_distinct_values_for_dropdown('melting_lot_category_one');
    $this->data['category_two_names'] = $this->get_distinct_values_for_dropdown('melting_lot_category_two');
    $this->data['category_three_names'] = $this->get_distinct_values_for_dropdown('melting_lot_category_three');
    $this->data['category_four_names'] = $this->get_distinct_values_for_dropdown('melting_lot_category_four');
  }

  private function get_distinct_values_for_dropdown($field) {
    $where = array($field.' !=' => '');
    if (empty($this->data['record']['product_name']) && $field!='product_name') return array();
    
    if ($field != 'product_name') {
      $where['product_name = '] = $this->data['record']['product_name'];
      if ($field!='process_name') {
        if (!empty($this->data['record']['process_name'])) 
          $where['process_name = '] = $this->data['record']['process_name'];
        if (!empty($this->data['record']['department_name'] 
            && $field!='department_name')) 
          $where['department_name = '] = $this->data['record']['department_name'];
      }
    }

    $values = $this->process_model->get('distinct('.$field.') as name, '.$field.' as id', 
                                      $where, array(), 
                                      array('order_by' => $field));
    if (in_array($field, array('product_name', 'process_name', 'department_name')))
      return $values;
    else
      return array_merge(array(array('name' => 'All', 'id' => 'All')), $values);
  }
}