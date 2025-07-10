<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_loss_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'settings/karigar_model'));
  }
  public function index() { 
    $this->get_loss();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/karigar_loss_reports/index', $this->data);    
  } 


  private function get_loss(){
    //$this->data['karigar']=get_karigars();
    $this->data['karigar'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));
    $this->data['department_names'] = (isset($_GET['department_names']) ? $_GET['department_names'] : '');
    $this->data['start_date']  = (!empty($_GET['start_date'])) ? date('Y-m-d',strtotime($_GET['start_date'])) : '';
    $this->data['end_date'] = (!empty($_GET['end_date'])) ? date('Y-m-d',strtotime($_GET['end_date'])) :'';
    $where['where']['karigar!=']="";
    $where['where']['loss!=']="";
    if (!empty($this->data['start_date'])) {
        $where['where']=array('date(completed_at) >='=>$this->data['start_date'],'date(completed_at) <='=>$this->data['end_date']);
      }
    $karigar_names=array();
    if(!empty($_GET['karigar_name'])){
      $this->data['record']['karigar_name']=!empty($_GET['karigar_name'])?$_GET['karigar_name']:'';
      $where['where']['karigar']=$this->data['record']['karigar_name'];
    }
    $this->data['loss_records'] = $this->process_model->get('lot_no,loss,out_weight,karigar,created_at as date',$where,array());
  }
}