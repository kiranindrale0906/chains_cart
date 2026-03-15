<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ghiss_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() { 
		$this->get_ghiss();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('ghiss_outs/ghiss_reports/index', $this->data);    
  } 

  private function get_ghiss(){
    $this->data['type'] = (isset($_GET['type'])) ? $_GET['type'] : 'ghiss';
    if ($this->data['type'] == 'ghiss')
      $this->data['ghiss_records'] = $this->process_model->get('product_name, department_name, 
                                                              sum(balance_ghiss)  as ghiss,
                                                              sum((balance_ghiss) * wastage_purity / 100) as ghiss_gross,
                                                              sum((balance_ghiss) * wastage_purity / 100 * wastage_lot_purity / 100) as ghiss_fine',
                                                            array('(balance_ghiss) > '=>0),
                                                            array(),
                                                            array('group_by' => 'product_name, department_name'));
    elseif ($this->data['type'] == 'hcl ghiss') 
      $this->data['ghiss_records'] = $this->process_model->get('product_name, department_name, 
                                                              sum(balance_hcl_ghiss)  as ghiss,
                                                              sum((balance_hcl_ghiss) * wastage_purity / 100) as ghiss_gross,
                                                              sum((balance_hcl_ghiss) * wastage_purity / 100 * wastage_lot_purity / 100) as ghiss_fine',
                                                            array('(balance_hcl_ghiss) > '=>0),
                                                            array(),
                                                            array('group_by' => 'product_name, department_name'));
    elseif ($this->data['type'] == 'pending ghiss') 
      $this->data['ghiss_records'] = $this->process_model->get('product_name, department_name, 
                                                              sum(balance_pending_ghiss)  as ghiss,
                                                              sum((balance_pending_ghiss) * wastage_purity / 100) as ghiss_gross,
                                                              sum((balance_pending_ghiss) * wastage_purity / 100 * wastage_lot_purity / 100) as ghiss_fine',
                                                            array('(balance_pending_ghiss) > '=>0),
                                                            array(),
                                                            array('group_by' => 'product_name, department_name'));
    elseif ($this->data['type'] == 'all ghiss') 
      $this->data['ghiss_records'] = $this->process_model->get('product_name, department_name, 
                                                              sum(balance_ghiss + balance_hcl_ghiss + balance_pending_ghiss)  as ghiss,
                                                              sum((balance_ghiss + balance_hcl_ghiss + balance_pending_ghiss) * wastage_purity / 100) as ghiss_gross,
                                                              sum((balance_ghiss + balance_hcl_ghiss + balance_pending_ghiss) * wastage_purity / 100 * wastage_lot_purity / 100) as ghiss_fine',
                                                            array('(balance_ghiss + balance_hcl_ghiss + balance_pending_ghiss) > '=>0),
                                                            array(),
                                                            array('group_by' => 'product_name, department_name'));
  }

}
