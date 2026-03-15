<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_lot_taggings extends BaseController { 
  public function __construct(){
    $this->_model='generate_lot_tagging_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/generate_lot_tagging_detail_model','qr_codes/qr_code_detail_model','arc_orders/order_model','arc_orders/investment_detail_model','settings/chain_purity_model','masters/customer_abbreviation_model','masters/colour_abbreviation_model','masters/stock_abbreviation_model','arc_orders/order_detail_model','arc_orders/generate_lot_detail_model','arc_orders/generate_lot_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'qr_code_details'));
  } 
  
  public function store()
  {
    if(!empty($_POST['print']) && $_POST['print']==1){

      $generate_lot_tagging_lot_no=array_column($_POST['generate_lot_tagging_details'],'generate_lot_tagging_detail_id');
      $generate_lot_taggings =$this->generate_lot_tagging_model->get('', array('lot_no' => $generate_lot_tagging_lot_no));
      $generate_lot_tagging_id=array_column($generate_lot_taggings,'id');
      $this->data['generate_lot_tagging_details'] = 
      $this->generate_lot_tagging_detail_model->get('', array('generate_lot_tagging_id' => $generate_lot_tagging_id));
      foreach ($this->data['generate_lot_tagging_details'] as $index => $value) {
        $order_details=$this->order_detail_model->find('arc_order_details.*,arc_orders.due_date as due_date,arc_orders.created_at as order_date,arc_orders.type_of_order,arc_orders.customer_name as customer_name,arc_orders.order_no as order_no',array('arc_order_details.id'=>$value['order_detail_id']),array(array('arc_orders','arc_order_details.order_id=arc_orders.id')));
        $qr_codes=$this->generate_lot_tagging_model->find('*',array('id'=>$generate_lot_tagging_detail_id));
        $generate_lot_tagging_detail=$this->generate_lot_tagging_detail_model->find('sum(quantity) pending_qty',array('order_detail_id'=>$order_details['id']));
        $rem_balance_quantity=$order_details['quantity']-$generate_lot_tagging_detail['pending_qty'];
        

        $this->data['generate_lot_tagging_details'][$index]['type_of_order']=$order_details['type_of_order'];
        $this->data['generate_lot_tagging_details'][$index]['customer_name']=$order_details['customer_name'];
        $this->data['generate_lot_tagging_details'][$index]['order_no']=$order_details['order_no'];
        $this->data['generate_lot_tagging_details'][$index]['bom_factory_code']=$order_details['bom_factory_code'];
        $this->data['generate_lot_tagging_details'][$index]['order_date']=date('d-m-Y',strtotime($order_details['created_at']));
        $this->data['generate_lot_tagging_details'][$index]['due_date']=date('d-m-Y',strtotime($value['created_at']));
        $this->data['generate_lot_tagging_details'][$index]['lot_no']=$qr_codes['lot_no'];
        $this->data['generate_lot_tagging_details'][$index]['order_qty']=$value['order_qty'];
        $this->data['generate_lot_tagging_details'][$index]['pending_qty']=$value['pending_qty'];
        $this->data['generate_lot_tagging_details'][$index]['dispatch_qty']=$value['dispatch_qty'];
        $this->data['generate_lot_tagging_details'][$index]['rem_qty']=$rem_balance_quantity;
      }
//pd($this->data['generate_lot_tagging_details']);

  //    $this->data['qr_code_detail_datas']=array();
  //    foreach ($qr_code_detail_datas as $index => $value) {
  //      $this->data['qr_code_detail_datas'][$value['qr_code_detail_id']][]=$value['lot_no'];
  //    }
//      $this->qr_code_detail_model->update_print_status($this->data['qr_code_details'],1);
      $this->load->render('qr_codes/generate_lot_taggings/print_view',$this->data);   
    }else{
    parent::store();
    }
  }

  public function _get_form_data() {  
  $this->data['generate_lot_id']=!empty($_GET['generate_lot_id'])?$_GET['generate_lot_id']:0;                            
    if($this->router->method == 'edit' || $this->router->method == 'update' || $this->router->method == 'store'){
      if(!empty($this->data['record']['id'])){
        $this->data['generate_lot_tagging_details']=$this->generate_lot_tagging_detail_model->get(
                                    'FORMAT(net_weight,2) net_weight,
                                      percentage,FORMAT(weight,2) weight,less,
                                      FORMAT(length,2) length,
                                      total_stone,
                                      stone_count,',
                                    array('generate_lot_tagging_id'=>$this->data['record']['id']));

        $this->data['generate_lot_tagging_details']=!empty($this->data['generate_lot_tagging_details'])?$this->data['generate_lot_tagging_details']:array(array());
        $this->data['generate_lot_id']=!empty($_GET['generate_lot_id'])?$_GET['generate_lot_id']:$this->data['record']['generate_lot_id'];      
      }
      if($this->router->method == 'update' || $this->router->method == 'store')
        $this->data['generate_lot_tagging_details'] = (isset($_POST['generate_lot_tagging_details'])?
                                                $_POST['generate_lot_tagging_details']:array(array()));

    }else{
      $this->data['generate_lot_tagging_details'] = array(array());
    }
    
    if(!empty($this->data['generate_lot_id']) && $this->data['generate_lot_id']!=0){
      $generate_lots=$this->generate_lot_model->find('lot_no,lot_weight,lot_qty as lot_quantity,purity,process_name,colour,created_at,due_date',array('id'=>$this->data['generate_lot_id']));
    $qr_code_order_detail_ids=$this->generate_lot_tagging_detail_model->get('order_detail_id',array('generate_lot_id'=>$this->data['generate_lot_id'],'pending_qty'=>0));
    $where_generate_lot_details=array('generate_lot_id'=>$this->data['generate_lot_id']);
    if(!empty($qr_code_order_detail_ids)){
    $qr_code_order_detail_ids=array_column($qr_code_order_detail_ids,'order_detail_id');
    $where_generate_lot_details=array('generate_lot_id'=>$this->data['generate_lot_id'],'order_detail_id not in ('.implode(',',$qr_code_order_detail_ids).')'=>NULL);
  }
    $generate_lot_details=$this->generate_lot_detail_model->get('id,order_detail_id',$where_generate_lot_details);


    $this->data['item_codes']=array();
    $generate_lot_ids=array_column($generate_lot_details,'order_detail_id');
    if(!empty($generate_lot_ids)){
        $order_details=$this->order_detail_model->get('arc_order_details.*,arc_orders.order_no as order_no,arc_orders.parent_order_no as parent_order_no,arc_orders.order_type as order_type,arc_orders.colour as colour,arc_orders.customer_name as customer_name,arc_orders.purity as purity, arc_orders.create_flag,arc_orders.type_of_order as type_of_order,arc_orders.order_comment as order_comment,`hu_id`',array('arc_order_details.id in ('.implode(',',$generate_lot_ids).')'=>NULL),array(array('arc_orders','arc_order_details.order_id=arc_orders.id')));
       foreach ($order_details as $index => $order_detail) {
        $generate_lot_tagging_detail=$this->generate_lot_tagging_detail_model->find('sum(quantity) pending_qty',array('order_detail_id'=>$order_detail['id']));
        $rem_balance_quantity=$order_detail['quantity']-$generate_lot_tagging_detail['pending_qty'];
        if($rem_balance_quantity>0){
        $this->data['order_details'][$order_detail['order_no'].'-'.$order_detail['customer_name'].'-'.$order_detail['order_id']][$index]=$order_detail;
        $this->data['order_details'][$order_detail['order_no'].'-'.$order_detail['customer_name'].'-'.$order_detail['order_id']][$index]['rem_balance_quantity']=$rem_balance_quantity;

        }
      }
    }
      $this->data['record']['lot_no']=$generate_lots['lot_no'];
      $this->data['record']['lot_weight']=$generate_lots['lot_weight'];
      $this->data['record']['lot_quantity']=$generate_lots['lot_quantity'];
      $this->data['record']['order_date']=$generate_lots['created_at'];
      $this->data['record']['due_date']=$generate_lots['due_date'];
      $this->data['record']['color']=$generate_lots['colour'];
      $this->data['record']['process_name']=$generate_lots['process_name'];
      $this->data['record']['purity']=$generate_lots['purity'];
    }
  }
  private function get_gpc_records() {
    $gpc_records=$this->process_model->get('',array('where_in'=>array('department_name'=>array("'GPC'","'GPC Or Rodium'")),'where'=>array('gpc_out!='=>0)));
    $weight=0;
    foreach ($gpc_records as $index => $value) {
      $this->data['gpc_records'][$index]=$value;
      $weight=$this->qr_code_detail_model->find('sum(weight) as total_weight',array('process_id'=>$value['id']))['total_weight'];
      $this->data['gpc_records'][$index]['total_weight']=!empty($weight)?$weight:0;
    }                                
  }

  public function _get_view_data() {
    $this->data['type'] = 'multiple';
    $this->data['generate_lot_tagging_details'] = 
      $this->generate_lot_tagging_detail_model->get('', array('generate_lot_tagging_id' => $this->data['record']['id']));

    foreach ($this->data['generate_lot_tagging_details'] as $index => $value) {
      $order_details=$this->order_detail_model->find('arc_order_details.*,arc_orders.type_of_order,arc_orders.customer_name as customer_name,arc_orders.order_no as order_no',array('arc_order_details.id'=>$value['order_detail_id']),array(array('arc_orders','arc_order_details.order_id=arc_orders.id')));

      $this->data['generate_lot_tagging_details'][$index]['type_of_order']=$order_details['type_of_order'];
      $this->data['generate_lot_tagging_details'][$index]['customer_name']=$order_details['customer_name'];
      $this->data['generate_lot_tagging_details'][$index]['order_no']=$order_details['order_no'];
      $this->data['generate_lot_tagging_details'][$index]['bom_factory_code']=$order_details['bom_factory_code'];
    }

  }

  public function view($id) {
  /*if(!empty($_GET['print']) && $_GET['print']==2){
      // $this->data['generate_lots']=$this->investment_model->get('',array('print_status='=>1));
      $this->data['generate_lots']=$this->investment_model->get('investments.id, tree_no, GROUP_CONCAT(DISTINCT(generate_lots.lot_no)) as lot_no, investments.created_at',
                                            array('print_status='=>1),
                                            array(array('investment_details', 'generate_lot_id=investments.id', 'LEFT'),
                                              array('generate_lots', 'generate_lots.id=generate_lot_id', 'LEFT')
                                            ),
                                            array("group_by"=>"tree_no")
                                          );
      $this->load->render('arc_orders/investments/print_form',$this->data);   
    }*/
    if (isset($_GET['type']) && $_GET['type'] == 'single') {
      parent::view($id);
    }elseif(!empty($_GET['print']) && $_GET['print']==1){
      $this->data['tagging_details']=$this->generate_lot_tagging_model->get('GROUP_CONCAT(DISTINCT(generate_lot_taggings.id)) as id,GROUP_CONCAT(DISTINCT(generate_lot_taggings.lot_no)) as lot_no, generate_lot_taggings.created_at',
                                      array('print_status!='=>1,'lot_no!='=>""),array(),
                                      array("group_by"=>"lot_no")
                                    );
      $this->load->render('qr_codes/generate_lot_taggings/print_form',$this->data);   
    } else {
      $this->data['record'] = $this->model->find('', array('id' => $id));
      $this->_get_view_data();
      $this->load->view('qr_codes/generate_lot_taggings/qr_code', $this->data);
    }
    
  }
  public function delete($id) {
    $details = $this->generate_lot_tagging_detail_model->get('',array('generate_lot_tagging_id' => $id));
    if (!empty($details)) {
      foreach ($details as $index => $value) {
       $this->generate_lot_tagging_detail_model->delete($value['id']);
      }
    }
    parent::delete($id);
    redirect('/qr_codes/generate_lot_taggings');
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'qr_codes/generate_lot_taggings';
    return $formdata;
  }
}
