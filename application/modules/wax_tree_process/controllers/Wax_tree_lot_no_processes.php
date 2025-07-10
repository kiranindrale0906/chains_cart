<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wax_tree_lot_no_processes extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save ='view';
    $this->load->model(array('wax_tree_process/wax_tree_process_model','wax_tree_process/wax_tree_lot_no_process_model'));
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'wax_tree_process/wax_tree_processes';
    return $formdata;
  }

  public function _get_form_data() {
      
    $this->data['wax_tree_processes']=$this->wax_tree_process_model->get('',array('status'=>'Pending',
                                                                                  'lot_no'=>''));
  }
  public function _get_view_data() {
      
    $this->data['wax_tree_details']=$this->wax_tree_process_model->get('',array('lot_no'=>$_GET['lot_no']));
  }
  public function delete($id) {
    $lot_no=!empty($_GET['lot_no'])?$_GET['lot_no']:'';
    if(!empty($lot_no) && $lot_no!=''){
      $wax_tree_details=$this->wax_tree_process_model->get('',array('lot_no'=>$lot_no,'id'=>$id));
      $this->wax_tree_process_model->update_lot_nos($wax_tree_details);
      redirect(base_url().'wax_tree_process/wax_tree_lot_no_processes/view/'.$id.'?lot_no='.$lot_no);
    }
  }
 }
