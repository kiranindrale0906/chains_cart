<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stone_vatav_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() { 
		$this->get_stone_vatav();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('stone_vatav_outs/stone_vatav_reports/index', $this->data);    
  } 

  private function get_stone_vatav(){
    $this->data['stone_vatav_records'] = $this->process_model->get('product_name, department_name, 
                                                            sum(balance_stone_vatav)  as stone_vatav,
                                                            sum((balance_stone_vatav) * out_purity / 100) as stone_vatav_gross,
                                                            sum((balance_stone_vatav) * out_purity / 100 * out_lot_purity / 100) as stone_vatav_fine',
                                                          array('(balance_stone_vatav)> '=>0),
                                                          array(),
                                                          array('group_by' => 'product_name, department_name'));
  }

}
