<?php
class Wastage_masters extends BaseController {
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
    $this->data['machine_sizes'] = $this->get_distinct_values_for_dropdown('machine_size');
    $this->data['design_names'] = $this->get_distinct_values_for_dropdown('design_code');
    $this->data['category_one_names'] = $this->get_distinct_values_for_dropdown('melting_lot_category_one');
    $this->data['tones'] = $this->get_distinct_values_for_dropdown('tone');
    $this->data['out_lot_purities'] = $this->get_distinct_values_for_dropdown('out_lot_purity');
  }

  private function get_distinct_values_for_dropdown($field) {
    $where = array($field.' !=' => '');
    $values = $this->process_model->get('distinct('.$field.') as name, '.$field.' as id', 
                                      array(), array(), 
                                      array('order_by' => $field));
    
      return $values;
  }
}