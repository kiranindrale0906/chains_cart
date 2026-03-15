<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alloy_gpc_vodator_ledger extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('issue_and_receipts/alloy_gpc_vodator_ledger_model'));
  }

  public function index(){
    if (isset($_GET['group_by_date'])) {
//pd($_GET);
      $data['alloy_vodator_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_alloy_vodator_ledger(true);
      $data['alloy_issue_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_alloy_issue_ledger(true);
      $data['gpc_vodator_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_gpc_vodator_ledger(true);
      $data['stone_vatav_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_stone_vatav_ledger(true);
      $data['spring_vatav_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_spring_vatav_ledger(true);
      $data['meena_vatav_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_meena_vatav_ledger(true);
//pd($data['meena_vatav_group_by_date']);  
    $data['copper_vatav_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_copper_vatav_ledger(true);
      $data['rhodium_vatav_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_rhodium_vatav_ledger(true);
      $data['tounch_loss_fine_group_by_date']=$this->alloy_gpc_vodator_ledger_model->get_tounch_loss_fine_ledger(true);
    } else {
      $data['Alloy Vodator']= (array) $this->alloy_gpc_vodator_ledger_model->get_alloy_vodator_ledger();
      $data['Alloy Issue']=$this->alloy_gpc_vodator_ledger_model->get_alloy_issue_ledger(true);
      
      $data['GPC Vodator']=$this->alloy_gpc_vodator_ledger_model->get_gpc_vodator_ledger();
      $data['Stone Vatav']=$this->alloy_gpc_vodator_ledger_model->get_stone_vatav_ledger();
      $data['Spring Vatav']=$this->alloy_gpc_vodator_ledger_model->get_spring_vatav_ledger();
      $data['Meena Vatav']=$this->alloy_gpc_vodator_ledger_model->get_meena_vatav_ledger();
      $data['Copper Vatav']=$this->alloy_gpc_vodator_ledger_model->get_copper_vatav_ledger();
      $data['Rhodium Vatav']=$this->alloy_gpc_vodator_ledger_model->get_rhodium_vatav_ledger();
      $data['Auto Tounch Loss Fine']=$this->alloy_gpc_vodator_ledger_model->get_tounch_loss_fine_ledger();
    }
    echo json_encode(array('data'    => $data,
                           'status'      => 'success',
                           'open_modal'  => FALSE));
    die;
  }
}
