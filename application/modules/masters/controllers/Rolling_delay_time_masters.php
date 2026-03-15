<?php
class Rolling_delay_time_masters extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save ='index';
    $this->load->model(array('processes/process_model'));
  }

  public function _get_form_data(){
    $this->data['blank'] = !empty($_GET['blank'])?$_GET['blank']:'';
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if (isset($_GET['product_name'])) $this->data['record']['product_name'] = $_GET['product_name'];
    $this->data['product_names'] = $this->get_distinct_values_for_dropdown('product_name');
  }

  private function get_distinct_values_for_dropdown($field) {
    $where = array($field.' !=' => '');
    $values = $this->process_model->get('distinct('.$field.') as name, '.$field.' as id', 
                                      array(), array(), 
                                      array('order_by' => $field));
    
      return $values;
  }
}