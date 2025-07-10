<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_wastage_refine_out_processes extends BaseController {  
  public function __construct(){
    $this->_model='melting_wastage_refine_out_process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('melting_wastage_refine_outs/melting_wastage_refine_out_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model'));
  } 
  public function index() { 
    redirect(base_url().'melting_wastage_refine_outs/melting_wastage_refine_out_processes/create');
  } 
  public function _get_form_data() {
      $where['where'] = array('balance_melting_wastage >' => 0,
                              'wastage_purity >' => 0,
                              'wastage_lot_purity >' => 0,
                              'product_name not in ("Rhodium Receipt", "Chain Receipt", "Rodium Receipt")' => NULL);

      $this->data['processes'] = $this->process_model->get('', $where);
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'melting_wastage_refine_outs/melting_wastage_refine_out_melting_processes';
    return $formdata;
  }


}
