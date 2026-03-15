<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Arc_order_dashboard_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('arc_orders/order_model','arc_orders/order_detail_model','arc_orders/generate_lot_model','arc_orders/generate_lot_detail_model','settings/chain_purity_model','masters/customer_abbreviation_model','masters/colour_abbreviation_model','masters/stock_abbreviation_model'));
  }

  public function index() {
   $arc_order_pendings=$this->order_model->get('',array('order_status'=>''));
   $arc_orders=$this->order_model->get('',array('order_status'=>'Approved'));
   $where_generate_lot_pending=$where_order_nos=array();
   // $where_investment_pending=array('generate_lots.status!='=>'In Investment','generate_lots.status!='=>'Dispatch');
   $where_investment_pending=array('generate_lots.status'=>'On Hold');
   $where_generate_lots=array('generate_lots.status!='=>'');
   $where_investment_details=array('generate_lots.status'=>'In Investment');
   $where_dispatch_details=array('generate_lots.status'=>'Dispatch');
   $where_arc_order_pending=array('arc_orders.order_status'=>'');
   $where_arc_order=array('arc_orders.order_status'=>'Approved');

   if(!empty($_GET) && !empty($_GET['process_name'])){
    $where_arc_order_pending['arc_orders.process_name']=$_GET['process_name'];
    $where_arc_order['arc_orders.process_name']=$_GET['process_name'];
    $where_generate_lot_pending['generate_lots.process_name']=$_GET['process_name'];
    $where_investment_pending['generate_lots.process_name']=$_GET['process_name'];
    $where_generate_lots['generate_lots.process_name']=$_GET['process_name'];
    $where_investment_details['generate_lots.process_name']=$_GET['process_name'];
    $where_dispatch_details['generate_lots.process_name']=$_GET['process_name'];
    $where_order_nos['arc_orders.process_name']=$_GET['process_name'];
   }
   if(!empty($_GET) && !empty($_GET['customer_name'])){
    $where_arc_order_pending['arc_orders.customer_name']=$_GET['customer_name'];
    $where_arc_order['arc_orders.customer_name']=$_GET['customer_name'];
    $where_generate_lot_pending['generate_lots.customer_name']=$_GET['customer_name'];
    $where_investment_pending['generate_lots.customer_name']=$_GET['customer_name'];
    $where_generate_lots['generate_lots.customer_name']=$_GET['customer_name'];
    $where_investment_details['generate_lots.customer_name']=$_GET['customer_name'];
    $where_dispatch_details['generate_lots.customer_name']=$_GET['customer_name'];
    $where_order_nos['arc_orders.customer_name']=$_GET['customer_name'];
   }
   if(!empty($_GET) && !empty($_GET['purity'])){
    $where_arc_order_pending['arc_orders.purity']=$_GET['purity'];
    $where_arc_order['arc_orders.purity']=$_GET['purity'];
    $where_generate_lot_pending['generate_lots.purity']=$_GET['purity'];
    $where_investment_pending['generate_lots.purity']=$_GET['purity'];
    $where_generate_lots['generate_lots.purity']=$_GET['purity'];
    $where_investment_details['generate_lots.purity']=$_GET['purity'];
    $where_dispatch_details['generate_lots.purity']=$_GET['purity'];
    $where_order_nos['arc_orders.purity']=$_GET['purity'];
   }
   if(!empty($_GET) && !empty($_GET['colour'])){
    $where_arc_order_pending['arc_orders.colour']=$_GET['colour'];
    $where_arc_order['arc_orders.colour']=$_GET['colour'];
    $where_generate_lot_pending['generate_lots.colour']=$_GET['colour'];
    $where_investment_pending['generate_lots.colour']=$_GET['colour'];
    $where_generate_lots['generate_lots.colour']=$_GET['colour'];
    $where_investment_details['generate_lots.colour']=$_GET['colour'];
    $where_dispatch_details['generate_lots.colour']=$_GET['colour'];
    $where_order_nos['arc_orders.colour']=$_GET['colour'];
   }
   if(!empty($_GET) && !empty($_GET['order_no'])){
    $where_arc_order_pending['arc_orders.id']=$_GET['order_no'];
    $where_arc_order['arc_orders.id']=$_GET['order_no'];
    $where_generate_lot_pending['generate_lot_details.order_id']=$_GET['order_no'];
    $where_investment_pending['generate_lot_details.order_id']=$_GET['order_no'];
    $where_generate_lots['generate_lot_details.order_id']=$_GET['order_no'];
    $where_investment_details['generate_lot_details.order_id']=$_GET['order_no'];
    $where_dispatch_details['generate_lot_details.order_id']=$_GET['order_no'];
    
   }
   if(!empty($_GET) && !empty($_GET['status'])){
    // $where_generate_lot_pending['status']=$_GET['status'];
    $where_investment_pending['generate_lots.status']=$_GET['status'];
    $where_generate_lots['generate_lots.status']=$_GET['status'];
    $where_investment_details['generate_lots.status']=$_GET['status'];
    $where_dispatch_details['generate_lots.status']=$_GET['status'];
//    $where_order_nos['arc_orders.status']=$_GET['status'];
   }

      
   
   $where_generate_lot_pending['where']['arc_orders.order_status ="Approved"']=NULL;
   $where_generate_lot_pending['where']['arc_order_details.accept_order']=1;
    $generate_lot_ids=$this->generate_lot_detail_model->get('order_detail_id');
    $generate_lot_ids=array_column($generate_lot_ids,'order_detail_id');
    // pd($generate_lot_ids);
    // $where_generate_lot_pending['where']=array('order_id'=>$this->data['record']['order_id']);
    if(!empty($generate_lot_ids)){
      $where_generate_lot_pending['where']['arc_order_details.id not in ('.implode(',',$generate_lot_ids).')']=NULL;
    }
      
   //$generate_lot_pendings=$this->generate_lot_model->get('',$where_generate_lot_pending);
   if(!empty($_GET) && $_GET['type']=="generate_lot"){
    $generate_lots=$this->generate_lot_detail_model->get('generate_lots.created_at,generate_lots.process_name,generate_lots.lot_weight,generate_lots.lot_qty,generate_lots.colour,generate_lots.lot_no,generate_lots.purity,generate_lots.remark,generate_lot_details.order_id,generate_lots.status',$where_generate_lots,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   
    $this->data['generate_lot_details']=$generate_lots;
   }if(!empty($_GET) && $_GET['type']=="investment_pending"){
    $investment_pending=$this->generate_lot_detail_model->get('generate_lots.created_at,generate_lots.process_name,generate_lots.lot_weight,generate_lots.lot_qty,generate_lots.colour,generate_lots.lot_no,generate_lots.purity,generate_lots.remark,generate_lot_details.order_id,generate_lots.status',$where_investment_pending,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   
    $this->data['generate_lot_details']=$investment_pending;
   }if(!empty($_GET) && $_GET['type']=="investment_detail"){
    $investment_details=$this->generate_lot_detail_model->get('generate_lots.created_at,generate_lots.lot_weight,generate_lots.process_name,generate_lots.lot_qty,generate_lots.colour,generate_lots.lot_no,generate_lots.purity,generate_lots.remark,generate_lot_details.order_id,generate_lots.status',$where_investment_details,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   
    $this->data['generate_lot_details']=$investment_details;
   }
   if(!empty($_GET) && $_GET['type']=="dispatch_detail"){
    $dispatch_details=$this->generate_lot_detail_model->get('generate_lots.created_at,generate_lots.lot_weight,generate_lots.process_name,generate_lots.lot_qty,generate_lots.colour,generate_lots.lot_no,generate_lots.purity,generate_lots.remark,generate_lot_details.order_id,generate_lots.status',$where_dispatch_details,array(array('generate_lots','generate_lots.id=generate_lot_details.generate_lot_id','left')),array('group_by'=>'generate_lots.lot_no'));
   
    $this->data['generate_lot_details']=$dispatch_details;
   }
   if(!empty($_GET) && $_GET['type']=="generate_lot_pendings"){
    $generate_lot_pendings = $this->order_detail_model->get('arc_orders.created_at,arc_orders.process_name,arc_order_details.*,arc_order_details.weight as lot_weight,arc_order_details.quantity as lot_qty,arc_orders.order_no as order_no,arc_orders.order_comment as order_comment,arc_orders.hu_id as hu_id,arc_orders.parent_order_no as parent_order_no,arc_orders.colour as colour,arc_orders.customer_name as customer_name,arc_orders.purity as purity,arc_orders.order_type as order_type,arc_orders.due_date as due_date, arc_orders.create_flag', $where_generate_lot_pending,array(array('arc_orders','arc_order_details.order_id=arc_orders.id')));
   
    $this->data['generate_lot_details']=$generate_lot_pendings;
    $where_order_nos=$where_generate_lot_pending;

   }if(!empty($_GET) && $_GET['type']=="order_pending"){
    $arc_order_pendings = $this->order_model->get('', $where_arc_order_pending);
   
    $this->data['generate_lot_details']=$arc_order_pendings;
   $where_order_nos['where']['order_status']='';
   }if(!empty($_GET) && $_GET['type']=="approval_order"){
   $arc_orders = $this->order_model->get('', $where_arc_order);
    $this->data['generate_lot_details']=$arc_orders;
   $where_order_nos['where']['order_status']='Approved';
    // $where_order_nos=$where_arc_order;
   }if(!empty($_GET)){
    $this->data['record']['type']=$_GET['type'];
    $this->data['record']['colour']=!empty($_GET['colour'])?$_GET['colour']:"";
    $this->data['record']['customer_name']=!empty($_GET['customer_name'])?$_GET['customer_name']:"";
    $this->data['record']['purity']=!empty($_GET['purity'])?$_GET['purity']:"";
    $this->data['record']['process_name']=!empty($_GET['process_name'])?$_GET['process_name']:"";
    $this->data['record']['order_no']=!empty($_GET['order_no'])?$_GET['order_no']:"";
   }
   $this->data['colours'] =$this->colour_abbreviation_model->get('distinct(colour_name) as name,colour_name as id');
    $this->data['customer_names'] =$this->customer_abbreviation_model->get('distinct(customer_name) as name,customer_name as id');
    $this->data['order_nos'] =$this->order_model->get('distinct(order_no) as name,id as id',$where_order_nos);
    $this->data['statuses'] =$this->generate_lot_model->get('distinct(status) as name,status as id');
    $this->data['purities'] =$this->chain_purity_model->get('distinct(lot_purity) as name,lot_purity as id');
    $this->data['process_names'] = get_arc_order_process();
    
    parent::view(1);
    
  }
}
