<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger_balance extends BaseController {
  public function __construct(){
    parent::__construct();
    //$this->load->model(array('issue_and_receipts/ledger_model'));
  }

  public function index(){
    //$data['record']['arf']=$this->ledger_model->get_total_balance_from_ledger('ARF');
    //$data['record']['arc']=$this->ledger_model->get_total_balance_from_ledger('ARC');
    $data['record']['argold']=$this->model->get_total_balance_from_argold_ledger();
    echo json_encode(array('data'    => $data,
                           'status'      => 'success',
                           'open_modal'  => FALSE));
    die;
  }
}