<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Packing_slip_details extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','export_internals/packing_slip_model'));
  }
  public function index() {
  	$packing_slip_id=!empty($_GET['packing_slip_id'])?$_GET['packing_slip_id']:0;
    $this->where = 'packing_slip_id ='.$packing_slip_id;
    parent::index();
  }
  public function delete($id) {
    $process_id=!empty($_GET['process_id'])?$_GET['process_id']:0;
    $packing_details=$this->packing_slip_detail_model->find('',array('id'=>$id));
    if(!empty($process_id) && $process_id!=0){
      $process_details=$this->process_model->get('',array('packing_slip_id'=>$packing_details['packing_slip_id'],'id'=>$process_id));
      $this->packing_slip_detail_model->update_packing_slip_ids($process_details,$packing_details);
      parent::delete($id);
    }else{
      $process_details=$this->process_model->get('',array('packing_slip_id'=>$id));
      if(!empty($process_details)){
        $this->packing_slip_detail_model->update_packing_slip_ids($process_details,$packing_details);
      }
      parent::delete($id);
    }
  }
  public function _after_delete($formdata){
    $date=!empty($_GET['date'])?$_GET['date']:'';
    $packing_slip_id=!empty($_GET['packing_slip_id'])?$_GET['packing_slip_id']:0;
    $this->packing_slip_model->update_packing_slips($packing_slip_id,$date);
    $this->data['redirect_url']= ADMIN_PATH.'export_internals/packing_slips';
    return $formdata;
  }
}