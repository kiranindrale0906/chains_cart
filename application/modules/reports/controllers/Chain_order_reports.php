<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chain_order_reports extends BaseController {
  public function __construct(){
    parent::__construct();
  }

  public function index() {

    $processes = get_chain_order_processes_dropdown();
    $this->data['from_date'] = date('Y-m-d', strtotime('-1 Days'));
    $this->data['to_date']   = date('Y-m-d');

    if(!empty($_GET['from_date'])) {
      $this->data['from_date'] = date('Y-m-d', strtotime($_GET['from_date']));
    }

    if(!empty($_GET['to_date'])) {
      $this->data['to_date'] = date('Y-m-d', strtotime($_GET['to_date']));
    }

    if(!empty($_GET['process'])) {
      foreach ($processes as $i => $process) {
        if($process['id'] == $_GET['process']) {
          $processes[$i]['selected'] = 'selected';
        }
      }
      $this->data['report_data'] = $this->model->get_report_data($this->data);
    }
    $this->data['processes'] = $processes;

    $this->load->render('reports/chain_order_reports/index',$this->data);
  }
}