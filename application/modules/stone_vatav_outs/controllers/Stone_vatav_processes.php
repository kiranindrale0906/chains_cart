<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stone_vatav_processes extends BaseController {  
  public function __construct(){
    $this->_model='stone_vatav_process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('stone_vatav_outs/stone_vatav_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model'));
  } 

  public function index() { 
    redirect(base_url().'stone_vatav_outs/stone_vatav_processes/create');
  } 

  public function create() {
    $this->data['record']['in_lot_purity'] = (isset($_GET['in_lot_purity']) ? $_GET['in_lot_purity'] : '');
    parent::create();
  }
  
  public function _get_form_data() {
    $where = array('stone_vatav >' => 0,
                   'department_name != ' => 'Casting',
                   'id not in (select process_id from process_out_wastage_details where field_name = "Stone Melting")' => NULL);

    $this->data['in_lot_purity'] = $this->process_model->get('distinct(in_lot_purity) as id, in_lot_purity as name', $where);

    //$where['where'] = array('balance_stone_vatav >' => 0);
    //$this->data['in_lot_purity'] = $this->process_model->get('distinct(in_lot_purity) as id,in_lot_purity name', $where);
    if(!empty($this->data['record']['in_lot_purity'])){
      $where['in_lot_purity'] = $this->data['record']['in_lot_purity'];
      //$where['where'] = array('balance_stone_vatav >' => 0 ,'in_lot_purity'=>$this->data['record']['in_lot_purity']);
  
      $this->data['processes'] = $this->process_model->get('', $where);
    }    
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'stone_vatav_outs/stone_vatav_melting_processes';
    return $formdata;
  }


}
