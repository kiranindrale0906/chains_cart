<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Packing_slips extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->date_fields = array(array('chittis', 'date'));
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','export_internals/packing_slip_detail_model','issue_departments/issue_department_model','issue_departments/issue_department_detail_model'));
  }
  
  public function view($id) {
    // $this->data['layout'] = 'plain';
    parent::view($id);
  }
  public function update($id) {
    if(isset($_GET['from']) && $_GET['from']=='view') {
      $packing_slip = $this->packing_slip_model->find('', array('id' => $id));
	if (!empty($packing_slip)&&$packing_slip['status'] == 0) {
	        $packing_slip['status'] = 1;
      	}
      $packing_slip_obj = new $this->model($packing_slip);
      $packing_slip_obj->save(FALSE);
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      parent::update($id);
    }
  }

  public function _get_view_data() {
    $this->data['detail'] = isset($_GET['detail']) ? 1 : 0;
    // $this->data['account_id']='';
    $this->data['packing_slip_details'] = $this->packing_slip_detail_model->get('',array('packing_slip_id'=>$this->data['record']['id']),array(),array('order_by'=>'sr_no asc'));
    $this->data['issue_department_detail']=$this->issue_department_detail_model->get('process_id',array('field_name'=>"Packing Slip",'process_id'=>$this->data['record']['id']));
    $this->data['packing_slip'] = $this->packing_slip_model->find('date',
                                                               array('id'=>$this->data['record']['id']));
  }

  public function _get_form_data() {
    $this->data['purity'] = $this->process_model->get('in_lot_purity as name, in_lot_purity as id', 
                                                       array('where'=>array(
                                                               'product_name' => 'Internal',
                                                               'packing_slip_id' => 0
                                                             )) ,
                                                       array(), array('group_by' => 'in_lot_purity'));
    $where=array('product_name' => 'Internal','packing_slip_balance >' => 0,'accept_packing_list!=' => 0);
    $this->data['processes'] = $this->process_model->get('',$where);
    $account_names = $this->issue_department_model->get_account_names_from_accounts('Export');
    foreach ($account_names as $index => $value) {
      $this->data['account_name'][$index]['name']=$value;
      $this->data['account_name'][$index]['id']=$value;
    }
    
  //   if (!empty($_GET['account_name']))
  //     $this->data['record']['account_name'] = $_GET['account_name'];
    
  //   if(!empty($this->data['record']['account_name'])) { 
  //     $where['account_name']=$this->data['record']['account_name'];
  //   if (!empty($_GET['process_id'])){
  //     unset($where['packing_slip_id']);
  //     $where['id']=$_GET['process_id'];
  //     $this->data['processes'] = $this->process_model->get('',$where);
  //   }else{
  //     $where['date(voucher_date) > '] = '2021-07-27';
  //     $this->data['processes'] = $this->process_model->get('', $where);
      
  // }
    

  //   } else{
  //     $this->data['processes'] = array();
      
  //     if ($this->router->method == 'store' || $this->router->method == 'update') {
  //       $this->data['record']['packing_slips'] = $_POST['packing_slips'];
  //       $this->data['packing_slip_details'] = @$_POST['packing_slip_details'];
  //     }
  //   }
  }

  public function store() {
    $this->data['redirect_url'] = '/export_internals/packing_slips';
    parent::store();
  }
  public function _after_save($formdata, $action){
     $this->data['redirect_url']= ADMIN_PATH.'export_internals/packing_slips';
    return $formdata;
  }
}
