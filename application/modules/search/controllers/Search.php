<?php
class Search extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model','processes/process_model'));
  }
  public function _get_form_data() {
    $this->data['melting_lots'] = $this->melting_lot_model->get('id,CONCAT(lot_no,"-",lot_purity) as name');
  }
  public function view($id) {
    if($_GET['type']==1){
      $res=$this->process_model->get('id,department_name,balance,product_name,process_name',array('balance >'=>0,'melting_lot_id'=>$id,'department_name!='=>'Start'));
    }else{
      $res=$this->process_model->find('product_name,process_name,department_name',array('id'=>$id,'department_name!='=>'Start'));
     
      $res['process_name']= get_process_name($res['process_name']);
      $res['product_name']=get_product_name($res['product_name']);
    }
    echo json_encode(array('result'=>$res));  
    } 
  }