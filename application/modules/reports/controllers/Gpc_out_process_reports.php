<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpc_out_process_reports extends BaseController {  
  public function __construct(){
    parent::__construct();
  }  

  // public function index() {

  //   $processes = get_chain_order_processes_dropdown();
  //   $meltings  = get_meltings_dropdown();
  //   $this->data['from_date'] = date('Y-m-d', strtotime('-1 Days'));
  //   $this->data['to_date']   = date('Y-m-d');

  //   if(!empty($_GET['from_date'])) {
  //     $this->data['from_date'] = date('Y-m-d', strtotime($_GET['from_date']));
  //   }

  //   if(!empty($_GET['to_date'])) {
  //     $this->data['to_date'] = date('Y-m-d', strtotime($_GET['to_date']));
  //   }

  //   if(!empty($_GET['process'])) {
  //     foreach ($processes as $i => $process) {
  //       if($process['id'] == $_GET['process']) {
  //         $processes[$i]['selected'] = 'selected';
  //       }
  //     }
  //   }

  //   if(!empty($_GET['melting'])) {
  //     foreach ($meltings as $i => $melting) {
  //       if($melting['id'] == $_GET['melting']) {
  //         $meltings[$i]['selected'] = 'selected';
  //       }
  //     }
  //   }

  //   if(!empty($_GET['process']) && !empty($_GET['melting'])) {
  //     $this->data['report_data'] = $this->model->get_report_data($this->data);
  //   }

  //   $this->data['processes'] = $processes;
  //   $this->data['meltings']  = $meltings;

  //   $this->load->render('reports/bom_reports/index',$this->data);    
  // }
}