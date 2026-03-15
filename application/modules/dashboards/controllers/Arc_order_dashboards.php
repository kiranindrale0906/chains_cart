<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Arc_order_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','arc_orders/order_model','arc_orders/order_detail_model','arc_orders/generate_lot_detail_model','arc_orders/generate_lot_model'));
  }

  public function index() {
    $order_where=array();
    if(!empty($_GET) && !empty($_GET['customer_name'])){
    $order_where['customer_name']=$_GET['customer_name'];
    }
   $this->data['order_no'] = $this->order_model->get('id as id,order_no as name',$order_where,array(),array('order_by'=>'order_no','group_by'=>'order_no'));
   $this->data['customer_name'] = $this->order_model->get('customer_name as id,customer_name as name',array(),array(),array('order_by'=>'customer_name','group_by'=>'customer_name'));

   // $where_generate_lot_pending=array('status'=>'');
   // $where_investment_pending=array('status!='=>'In Investment','status!='=>'Dispatch');
   $where_investment_pending=array('status'=>'On Hold');
   $where_generate_lots=array('status!='=>'');
   $where_investment_details=array('status'=>'In Investment');
   $where_dispatch_details=array('status'=>'Dispatch');
   $where_arc_order_pending=array('order_status'=>'');
   $where_arc_order=array('order_status'=>'Approved');
   if(!empty($_GET) && !empty($_GET['order_no'])){
    $where_generate_lot_pending['arc_orders.id']=$_GET['order_no'];
    $where_investment_pending['generate_lot_details.order_id']=$_GET['order_no'];
    $where_generate_lots['generate_lot_details.order_id']=$_GET['order_no'];
    $where_investment_details['generate_lot_details.order_id']=$_GET['order_no'];
    $where_dispatch_details['generate_lot_details.order_id']=$_GET['order_no'];
    $where_arc_order_pending['arc_orders.id']=$_GET['order_no'];
    $where_arc_order['arc_orders.id']=$_GET['order_no'];
    $this->data['record']['order_no']=$_GET['order_no'];
   }
   if(!empty($_GET) && !empty($_GET['customer_name'])){
    $where_generate_lot_pending['arc_orders.customer_name']=$_GET['customer_name'];
    $where_investment_pending['generate_lots.customer_name']=$_GET['customer_name'];
    $where_generate_lots['generate_lots.customer_name']=$_GET['customer_name'];
    $where_investment_details['generate_lots.customer_name']=$_GET['customer_name'];
    $where_dispatch_details['generate_lots.customer_name']=$_GET['customer_name'];
    $where_arc_order_pending['arc_orders.id']=$_GET['customer_name'];
    $where_arc_order['arc_orders.id']=$_GET['customer_name'];
    
    $this->data['record']['customer_name']=$_GET['customer_name'];
   }

    
   $users = $this->user_model->get('*');
   $arc_order_pendings=$this->order_model->find('sum(weight) as weight,count(id) as quantity',$where_arc_order_pending);
   $where_generate_lot_pending['where']['arc_orders.order_status ="Approved"']=NULL;
   $where_generate_lot_pending['where']['arc_order_details.accept_order']=1;
    $generate_lot_ids=$this->generate_lot_detail_model->get('order_detail_id');
    $generate_lot_ids=array_column($generate_lot_ids,'order_detail_id');
    // pd($generate_lot_ids);
    // $where_generate_lot_pending['where']=array('order_id'=>$this->data['record']['order_id']);
    if(!empty($generate_lot_ids)){
      $where_generate_lot_pending['where']['arc_order_details.id not in ('.implode(',',$generate_lot_ids).')']=NULL;
    }
   $generate_lot_pendings = $this->order_detail_model->find('sum(arc_order_details.weight) weight ,count(arc_order_details.id) as quantity', $where_generate_lot_pending,array(array('arc_orders','arc_order_details.order_id=arc_orders.id')));
    
   $generate_lots=$this->generate_lot_detail_model->get('generate_lots.lot_weight',$where_generate_lots,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   $sum_generate_lots=0;
   foreach ($generate_lots as $index => $value) {
      $sum_generate_lots+=$value['lot_weight'];
   }

   $investment_pending=$this->generate_lot_detail_model->get('',$where_investment_pending,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   $sum_investment_pending=0;
   foreach ($investment_pending as $index => $investment_pending_value) {
      $sum_investment_pending+=$investment_pending_value['lot_weight'];
   }
   $investment_details=$this->generate_lot_detail_model->get('',$where_investment_details,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   $sum_investment_details=0;
   foreach ($investment_details as $index => $investment_details_value) {
      $sum_investment_details+=$investment_details_value['lot_weight'];
   }
   $dispatch_details=$this->generate_lot_detail_model->get('',$where_dispatch_details,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   $sum_dispatch_details=0;
   foreach ($dispatch_details as $index => $dispatch_details_value) {
      $sum_dispatch_details+=$dispatch_details_value['lot_weight'];
   }
   $arc_orders=$this->order_model->find('sum(weight) as weight,count(id) as quantity',$where_arc_order);
   
    $this->data['order_pending']['weight']=!empty($arc_order_pendings)?$arc_order_pendings['weight']:0;
    $this->data['order_pending']['quantity']=!empty($arc_order_pendings)?$arc_order_pendings['quantity']:0;
    $this->data['generate_lot_pending']['weight']=!empty($generate_lot_pendings)?$generate_lot_pendings['weight']:0;
    $this->data['generate_lot_pending']['quantity']=!empty($generate_lot_pendings)?$generate_lot_pendings['quantity']:0;
    
    $this->data['generate_lot']['weight']=!empty($sum_generate_lots)?$sum_generate_lots:0;
    $this->data['generate_lot']['quantity']=!empty($sum_generate_lots)?count($generate_lots):0;
    
    $this->data['investment_pending']['weight']=!empty($sum_investment_pending)?$sum_investment_pending:0;
    $this->data['investment_pending']['quantity']=!empty($sum_investment_pending)?count($investment_pending):0;
    
    $this->data['investment_detail']['weight']=!empty($sum_investment_details)?$sum_investment_details:0;
    $this->data['investment_detail']['quantity']=!empty($sum_investment_details)?count($investment_details):0;

    $this->data['dispatch_detail']['weight']=!empty($sum_dispatch_details)?$sum_dispatch_details:0;
    $this->data['dispatch_detail']['quantity']=!empty($sum_dispatch_details)?count($dispatch_details):0;
    
    $this->data['arc_order']['weight']=!empty($arc_orders)?$arc_orders['weight']:0;
    $this->data['arc_order']['quantity']=!empty($arc_orders)?$arc_orders['quantity']:0;
    
    parent::view($users[0]['id']);
  }
}
