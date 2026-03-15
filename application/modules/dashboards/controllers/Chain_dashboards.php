<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chain_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model'));
  }

  public function index() {
  	$users = $this->user_model->get('*');
    $this->data['records'] = $this->process_model->get('design_code,balance,balance_gross,balance_fine',array('product_name'=>'Rope Chain',
                                                            'department_name'=>'Hook'), array(),
                                                      array('group_by'=>'design_code'));
  	parent::view($users[0]['id']);
  }

  // public function view($id) {
  //   if($_GET['type']==1){
  //     $res=$this->process_model->get('id,department_name',array('department_name!='=>'Start',
  //                                                               'product_name'=>$_GET['chain_name']),array(),
  //                                                               array('group_by'=>'department_name',
  //                                                                     'order_by'=>'id'));
  //   }else{
  //     $res=$this->process_model->find('product_name,process_name,department_name',array('id'=>$id,'department_name!='=>'Start'));
  //     $res['process_name']= get_process_name($res['process_name']);
  //     $res['product_name']=get_product_name($res['product_name']);
  //   }
  //   echo json_encode(array('result'=>$res));  
  // }
}