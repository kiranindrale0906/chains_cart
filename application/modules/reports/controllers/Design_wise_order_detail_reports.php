<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design_wise_order_detail_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('arc_orders/order_detail_model','arc_orders/order_model','arc_orders/generate_lot_detail_model'));
  }

  public function index(){
    $where_condition = array('item_code'=>$_GET['item_code']);  
    $this->data['record']['item_code'] = $_GET['item_code'];
    $this->data['from_date'] = date('Y-m-d', strtotime('-1 Days'));
    $this->data['to_date']   = date('Y-m-d');

    if(!empty($_GET['from_date'])) {
      $this->data['record']['from_date'] = date('Y-m-d', strtotime($_GET['from_date']));
      $where_condition['date(arc_orders.order_date) >='] = date('Y-m-d',strtotime($_GET['from_date']));
    }

    if(!empty($_GET['to_date'])) {
      $this->data['record']['to_date'] = date('Y-m-d', strtotime($_GET['to_date']));
      $where_condition['date(arc_orders.order_date) <'] = date('Y-m-d',strtotime($_GET['to_date']));    

    }

    if(!empty($_GET['customer_name'])) {
            $this->data['record']['customer_name'] = $_GET['customer_name'];

      $where_condition['arc_orders.customer_name'] = $_GET['customer_name'];
    }

    if(!empty($_GET['purity'])) {
            $this->data['record']['purity'] = $_GET['purity'];

      $where_condition['arc_orders.purity'] = $_GET['purity'];

    }

	$this->data['customer_name']=$this->order_model->get('customer_name name,customer_name id',array(),array(),array('group_by'=>'customer_name'));
	$this->data['purities']=$this->order_model->get('purity name,purity id',array('purity!='=>0),array(),array('group_by'=>'purity'));
  	$this->data['record']['design_wise_order_reports'] = $this->order_detail_model->get('arc_order_details.*,arc_orders.colour,arc_orders.customer_name,arc_orders.order_no order_no,arc_orders.order_date order_date,arc_orders.purity order_purity',$where_condition,array(array('arc_orders','arc_orders.id=arc_order_details.order_id')));
//    pd($this->data['record']['design_wise_order_reports']);
	foreach($this->data['record']['design_wise_order_reports'] as $index=>$value){
	 $lot_numbers = $this->generate_lot_detail_model->get('GROUP_CONCAT(DISTINCT lot_no) as lot_no,generate_lots.status as status',
                                                                array('generate_lot_details.order_id'=>$value['order_id']),
                                                                array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id')),
                                                                array('row_array' => true));
   	 $this->data['record']['design_wise_order_reports'][$index]['status']= $lot_numbers['status'];
   	 $this->data['record']['design_wise_order_reports'][$index]['lot_no']= $lot_numbers['lot_no'];
	}
//	pd($this->data['record']['design_wise_order_reports']);
  	parent::view(1);
  } 
}
