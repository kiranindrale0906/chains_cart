<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_max_min_hcl_losses extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_field_model'));
    $this->redirect_after_save = 'view';
  }
  public function _after_save($formdata, $action){
     $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_max_min_hcl_losses']['id'];
     return $formdata;
  }
  public function _after_delete($id){
    $process_id = !empty($_GET['process_id']) ? $_GET['process_id'] : '';
    redirect(base_url().'processes/processes/view/'.$process_id);
  }

}

?>