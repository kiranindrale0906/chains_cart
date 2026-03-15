<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_lists extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model('processes/process_model');
    $this->redirect_after_save = 'view';
  }

  public function index(){
  	$select_karigar_data = $this->process_model->get('id,IF(parent_lot_name IS NULL OR 
  																										parent_lot_name = "",lot_no,parent_lot_name) as lot_name,
  																										karigar,product_name,in_lot_purity,SUM(balance) as balance',
  																										array('karigar'=>$_GET['karigar'],'balance >'=>0),
  																										array(),
  																										array('group_by'=>'id,lot_name,in_lot_purity,product_name,karigar'));
  	//$balance_daily_drawer =$this->karigar_list_model->get_daily_drawer_balance();
  	$balance_daily_drawer = $this->process_model->get('"Daily Drawer" as product_name,sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance,karigar,in_lot_purity',array('karigar'=>$_GET['karigar'],'(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) !='=>0),array(),array('group_by'=>'in_lot_purity,karigar'));
  	
  	$merge_data = array_merge($select_karigar_data,$balance_daily_drawer);
  	$this->data['record'] = $merge_data;
    $this->data['karigar_list'] = $this->process_model->get('
                                                      SUM(balance) as balance,karigar,product_name,in_lot_purity',
                                                      array('karigar'=>$_GET['karigar'],'balance >'=>0),
                                                      array(),
                                                      array('group_by'=>'product_name,karigar,in_lot_purity'));


  	parent::view(1);
  }
}