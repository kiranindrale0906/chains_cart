<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_lot_qr_codes extends BaseController { 
  public function __construct(){
    $this->_model='generate_lot_qr_code_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('qr_codes/generate_lot_tagging_detail_model','qr_codes/generate_lot_tagging_model','qr_codes/generate_lot_qr_code_detail_model','qr_codes/qr_code_detail_model','arc_orders/order_model','arc_orders/investment_detail_model','settings/chain_purity_model','masters/customer_abbreviation_model','masters/colour_abbreviation_model','masters/stock_abbreviation_model','arc_orders/order_detail_model','arc_orders/generate_lot_detail_model','arc_orders/generate_lot_model'));
    $this->data['file_data'] = array(array('file_field_name'=>'image',
                                           'file_controller'=>'qr_code_details'));
  }
  public function _get_form_data() { 
   if($this->router->method == 'update' || $this->router->method == 'store'){
    $this->data['generate_lot_qr_codes'] = isset($_POST['generate_lot_qr_codes'])? $_POST['generate_lot_qr_codes']:array();
       
   }else{
    $this->data['generate_lot_qr_codes']['generate_lot_tagging_id']=$_GET['generate_lot_tagging_id'];
   }
    $generate_lot_tagging=$this->generate_lot_tagging_model->find('*',array('id'=>$this->data['generate_lot_qr_codes']['generate_lot_tagging_id']));
   $this->data['purity']=$generate_lot_tagging['purity'];
   $generate_lot_tagging_detail=$this->generate_lot_tagging_detail_model->get('*',array('generate_lot_tagging_id'=>$this->data['generate_lot_qr_codes']['generate_lot_tagging_id']));
    $i=$j=0;
    foreach($generate_lot_tagging_detail as $index => $tagging_detail){  
      for($i=0;$i<$tagging_detail['quantity'];$i++){
       $order_details=$this->order_detail_model->find('*',array('id'=>$tagging_detail['order_detail_id']));
	 $this->data['generate_lot_tagging_details'][$j]['item_code']=$tagging_detail['item_code'];
	 $this->data['generate_lot_tagging_details'][$j]['size']=$order_details['size'];
	 $this->data['generate_lot_tagging_details'][$j]['image']=$order_details['image'];
	 $this->data['generate_lot_tagging_details'][$j]['type_of_order']=$order_details['type_of_order'];
         $j++;

      }
   }

   if($this->router->method == 'edit' || $this->router->method == 'update' || $this->router->method == 'store'){
       $this->data['generate_lot_qr_code_details']=$this->generate_lot_qr_code_detail_model->get('', array('generate_lot_qr_code_id' => $this->data['record']['id']));
if($this->router->method == 'edit' || $this->router->method == 'update' ){
	 $this->data['generate_lot_tagging_details'] = (isset( $this->data['generate_lot_qr_code_details'])?
                                                 $this->data['generate_lot_qr_code_details']:array(array()));}
       $this->data['generate_lot_tagging_details']=!empty($this->data['generate_lot_tagging_details'])?$this->data['generate_lot_tagging_details']:array(array());
      if($this->router->method == 'update' || $this->router->method == 'store')
        $this->data['generate_lot_qr_code_details'] = (isset($_POST['generate_lot_qr_code_details'])?
                                                $_POST['generate_lot_qr_code_details']:array(array()));
  
	}else{
         $this->data['generate_lot_qr_code_details'] =array(array());
	}
 }
  public function view($id) {
    if (isset($_GET['type']) && $_GET['type'] == 'single') {
      parent::view($id);
    } else {
      $this->data['record'] = $this->model->find('', array('id' => $id));
      $this->_get_view_data();
      $this->load->view('qr_codes/generate_lot_qr_codes/qr_code', $this->data);
    }
    
  }
  public function _get_view_data() {
    $this->data['type'] = 'multiple';
    $this->data['generate_lot_qr_code_details'] = 
      $this->generate_lot_qr_code_detail_model->get('', array('generate_lot_qr_code_id' => $this->data['record']['id']));
  }

  public function delete($id) {
    $details = $this->generate_lot_qr_code_detail_model->get('',array('generate_lot_qr_code_id' => $id));
    if (!empty($details)) {
      foreach ($details as $index => $value) {
       $this->generate_lot_qr_code_detail_model->delete($value['id']);
      }
    }
    parent::delete($id);
    redirect('/qr_codes/generate_lot_qr_codes');
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'qr_codes/generate_lot_qr_codes';
    return $formdata;
  }
}
