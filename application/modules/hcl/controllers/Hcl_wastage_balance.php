<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hcl_wastage_balance extends BaseController {
  
  public function __construct(){

    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model'));
  
  }

  public function index(){
  	$this->data['record']['lot_wise_data'] = $this->process_model->get('lot_no,product_name,sum(balance_hcl_wastage) as balance_hcl_wastage,sum((balance_hcl_wastage) * wastage_purity / 100) as balance_hcl_wastage_gross, sum((balance_hcl_wastage) * wastage_purity / 100 * wastage_lot_purity / 100) as balance_hcl_wastage_fine',array('balance_hcl_wastage >'=>0,'lot_no !='=>'','parent_lot_name' =>'' ),array(),array('group_by'=>'lot_no,product_name','order_by'=>'product_name'));

  	$this->data['parent_lot_wise_data'] = $this->process_model->get('parent_lot_name,product_name,sum(balance_hcl_wastage) as balance_hcl_wastage,sum((balance_hcl_wastage) * wastage_purity / 100) as balance_hcl_wastage_gross, sum((balance_hcl_wastage) * wastage_purity / 100 * wastage_lot_purity / 100) as balance_hcl_wastage_fine',array('balance_hcl_wastage >'=>0,'parent_lot_name != '=> '' ),array(),array('group_by'=>'parent_lot_name,product_name','order_by'=>'product_name'));

  	parent::view(1);
  }
}