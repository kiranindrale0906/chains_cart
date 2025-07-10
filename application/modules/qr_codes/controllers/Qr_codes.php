<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qr_codes extends BaseController { 
  public function __construct(){
    $this->_model='qr_code_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/qr_code_detail_model','arc_orders/order_model','arc_orders/investment_detail_model','settings/chain_purity_model','masters/customer_abbreviation_model','masters/colour_abbreviation_model','masters/stock_abbreviation_model','arc_orders/order_detail_model','arc_orders/generate_lot_detail_model','arc_orders/generate_lot_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'qr_code_details'));
  } 
 
  public function _get_form_data() {  
  $this->data['generate_lot_id']=!empty($_GET['generate_lot_id'])?$_GET['generate_lot_id']:0;                            
    if($this->router->method == 'edit' || $this->router->method == 'update' || $this->router->method == 'store'){
      if(!empty($this->data['record']['id'])){
        $this->data['qr_code_details']=$this->qr_code_detail_model->get(
                                    'FORMAT(net_weight,2) net_weight,
                                      percentage,FORMAT(weight,2) weight,less,km,
                                      FORMAT(length,2) length,
                                      total_stone,
                                      stone_count,item_code',
                                    array('qr_code_id'=>$this->data['record']['id']));
        $this->data['qr_code_details']=!empty($this->data['qr_code_details'])?$this->data['qr_code_details']:array(array());
       // $this->data['generate_lot_id']=!empty($_GET['generate_lot_id'])?$_GET['generate_lot_id']:$this->data['record']['generate_lot_id'];      
      }
      if($this->router->method == 'update' || $this->router->method == 'store')
        $this->data['qr_code_details'] = (isset($_POST['qr_code_details'])?
                                                $_POST['qr_code_details']:array(array()));

    }else{
      $this->data['qr_code_details'] = array(array());
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
    $this->data['qr_code_details'] = 
      $this->qr_code_detail_model->get('', array('qr_code_id' => $this->data['record']['id']));
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
    } else {
      $this->data['record'] = $this->model->find('', array('id' => $id));
      $this->_get_view_data();
      $this->load->view('qr_codes/qr_codes/qr_code', $this->data);
    }
    
  }
  public function delete($id) {
    $details = $this->qr_code_detail_model->get('',array('qr_code_id' => $id));
    if (!empty($details)) {
      foreach ($details as $index => $value) {
       $this->qr_code_detail_model->delete($value['id']);
      }
    }
    parent::delete($id);
    redirect('/qr_codes/qr_codes');
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'qr_codes/qr_codes';
    return $formdata;
  }
}
