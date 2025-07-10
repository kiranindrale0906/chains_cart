<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hcl_processes extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'index';
    $this->load->model(array('hcl/hcl_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model','melting_lots/parent_lot_model','melting_lots/melting_lot_model'));
  }
  public function index() { 
    redirect(base_url().'hcl/hcl_processes/create');
  }

  public function create(){
    $this->data['record']['process_name'] = (isset($_GET['process_name']) ? $_GET['process_name'] : '');
    $this->data['record']['parent_lot_id'] = (isset($_GET['parent_lot_id']) ? $_GET['parent_lot_id'] : '');
    $this->data['record']['melting_lot_id'] = (isset($_GET['melting_lot_id']) ? $_GET['melting_lot_id'] : '');
    parent::create();  
  }

  public function _get_form_data(){
    $this->data['lot_nos'] = array();
    $this->data['parent_lot_nos'] = array();
    if(in_array($this->data['record']['process_name'], 
       array('Indo tally Chain','Rope Chain','Machine Chain','Lotus Chain','Hollow Choco Chain','Hollow Bangle Chain','Imp Italy Chain','Office Outside'))){
      $where = array('parent_lot_id' => $this->data['record']['parent_lot_id'],
                     'balance_hcl_wastage >' => 0,
                     );
    }else{
      $where = array('melting_lot_id' => $this->data['record']['melting_lot_id'],
                     'balance_hcl_wastage >' => 0);
    }

    if(isset($_GET['process_name']) && $_GET['process_name'] != ""){
      $lot_no_processes = $this->process_model->get('distinct(lot_no) as lot_no', 
                                                    array('product_name' => $_GET['process_name'],
                                                          'balance_hcl_wastage >' => 0,));
      $lot_nos = array_column($lot_no_processes, 'lot_no');
      $str_lot_nos = array();
      foreach ($lot_nos as $lot_no) {
        $str_lot_nos[] = '"'.$lot_no.'"';
      }
      if (empty($str_lot_nos))
        $this->data['lot_nos'] = array();
      else  
        $this->data['lot_nos'] = $this->process_model->get('min(melting_lot_id) as id, lot_no as name', 
                                                               array('product_name' => $_GET['process_name'],
                                                                     'balance_hcl_wastage >' => 0,
                                                                     'where_in' => array('lot_no' => $str_lot_nos)),
                                                               array(), array('group_by' => 'lot_no'));

      $parent_lot_name_processes = $this->process_model->get('distinct(parent_lot_name) as parent_lot_name', 
                                                             array('product_name' => $_GET['process_name'],
                                                                   'balance_hcl_wastage >' => 0));
      $parent_lot_names = array_column($parent_lot_name_processes, 'parent_lot_name');
      $str_parent_lot_names = array();
      foreach ($parent_lot_names as $parent_lot_name) {
        $str_parent_lot_names[] = '"'.$parent_lot_name.'"';
      }
      if (empty($str_parent_lot_names))
        $this->data['parent_lot_nos'] = array();
      else  
        $this->data['parent_lot_nos'] = $this->process_model->get('min(parent_lot_id) as id, parent_lot_name as name',
                                                                array('product_name'=>$_GET['process_name'],
                                                                      'balance_hcl_wastage >' => 0,
                                                                      'where_in' => array('parent_lot_name' => $str_parent_lot_names)),
                                                                array(), array('group_by' => 'parent_lot_name'));
      $where['product_name']=$_GET['process_name'];
    }
    $this->data['processes'] = $this->process_model->get('', $where);
//lq();
    // $this->data['parent_lot_nos'] = $this->parent_lot_model->get('id,name');

    /*if(!empty($_GET['process_name']) && !isset($_GET['lot_no'])){
      $this->data['ajax_success_function'] = 'set_lots_select_options(response)';
      echo json_encode(array('lot_nos' => $this->data['lot_nos'],'status'=>'success',
                             'js_function'=>$this->data['ajax_success_function']));exit;
    }*/

    /*if(isset($this->data['record']['melting_lot_id']) && !empty($this->data['record']['melting_lot_id'])){
      $where = array('product_name =' => $this->data['record']['process_name'],
                     'balance_hcl_wastage >' => 0,
                     'melting_lot_id' => $this->data['record']['melting_lot_id']);
      $this->data['processes'] = $this->process_model->get('', $where);
    }*/    
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'hcl/hcl_melting_processes';
    return $formdata;
  }
  public function view($id) {
    if(isset($_GET['type'])&&$_GET['type']==1){
      $res=$this->parent_lot_model->get('id,name',array('process_name'=>$_GET['process_name']));
      echo json_encode(array('result'=>$res));
    }else{
      $res=$this->melting_lot_model->get('id,lot_no as name',array('process_name'=>$_GET['process_name']));
      echo json_encode(array('result'=>$res));
    }
  }
 
  
}

