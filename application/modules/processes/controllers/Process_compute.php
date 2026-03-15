<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_compute extends BaseController {
  public function __construct(){
    $this->load_helper = false;
    parent::__construct();
    $this->load->model(array('processes/process_model','daily_drawers/daily_drawer_receipt_model'));
  }
  
  public function update($id) {
    // $processes = $this->process_model->get('id', array('process_name' => 'Fire Tounch Daily Drawer Wastage'));
    // foreach ($processes as $process)
    //   $result = $this->process_model->compute_process($process['id']);
   ini_set('max_input_vars', '3000');
    ini_set('max_execution_time',0);
    $this->process_model->compute_process($id);
    redirect(ADMIN_PATH.'processes/processes/view/'.$id);
  }

  public function create() {  
    $processes = $this->process_model->get('id', array('balance_tounch_loss_fine !=' => 0,
                                                       '(parent_lot_id = 0 or out_purity  = 100)' => NULL));
    foreach ($processes as $process) {
      $result = $this->process_model->compute_process($process['id']);
    }
    echo 'Tounch Loss Fine transferred'; die();
  }
}
