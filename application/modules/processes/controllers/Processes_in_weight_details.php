<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processes_in_weight_details extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_out_wastage_detail_model', 'processes/process_model'));
  }
  public function create($id='') {
    $this->data['process_id'] = $id;
    parent::create();
  }
  public function _get_form_data() {
    $this->data['process_out_wastage_details'] = $this->process_out_wastage_detail_model->get('', 
                                                            array('parent_id' => $this->data['process_id'])); 
    if (!empty($this->data['process_out_wastage_details'])) {
      foreach ($this->data['process_out_wastage_details'] as $index => $process_out_wastage_detail) {
        $this->data['processes'][$index] = $this->process_model->find('product_name, process_name,department_name,out_lot_purity', 
                                                                      array('id' => $process_out_wastage_detail['process_id']));
        $this->data['processes'][$index]['weight'] = $process_out_wastage_detail['out_weight'];
      }
    }
  }
}