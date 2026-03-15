<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpc_out_city_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','processes/process_field_model','settings/city_model','reports/gpc_out_city_report_model'));
  }

  public function index() { 
		$this->get_city_details();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/gpc_out_city_reports/index', $this->data);    
  } 

  private function get_city_details(){
    
     $this->data['city']=$this->city_model->get('DISTINCT(name) as name,name as id');
     $this->data['product_name']=$this->process_model->get('DISTINCT(product_name) as name,product_name as id');
    $this->data['in_lot_purity']=$this->process_model->get('distinct(in_lot_purity) as name ,in_lot_purity as id');
    $this->data['record']['in_lot_purity']=!empty($_GET['in_lot_purity'])?$_GET['in_lot_purity']:'';
    $this->data['record']['from_date']=!empty($_GET['from_date'])?$_GET['from_date']:'';
    $this->data['record']['to_date']=!empty($_GET['to_date'])?$_GET['to_date']:'';
    $this->data['record']['city']=!empty($_GET['city'])?$_GET['city']:'';
    $this->data['record']['product_name']=!empty($_GET['product_name'])?$_GET['product_name']:'';
    $where=array('processes.product_name!='=>'','process_details.gpc_out!='=>0);
    
    if(!empty($this->data['record']['in_lot_purity'])){
       $where['processes.in_lot_purity']=$this->data['record']['in_lot_purity'];
    }
    if(!empty($this->data['record']['city'])){
       $where['process_details.city']=$this->data['record']['city'];
    }
    if(!empty($this->data['record']['product_name'])){
       $where['processes.product_name']=$this->data['record']['product_name'];
    }
    if(!empty($this->data['record']['from_date'])) {
      $where['date(processes.updated_at) >=']  = date('Y-m-d', strtotime($this->data['record']['from_date']));
    }
    if(!empty($this->data['record']['to_date'])) {
     $where['date(processes.updated_at )<='] = date('Y-m-d', strtotime($this->data['record']['to_date']));
    }
    
    $this->data['gpc_out_city_records'] =$this->process_field_model->get('(process_details.gpc_out) as gpc_out,processes.product_name,processes.melting_lot_category_one as category_name,process_details.city as city,processes.updated_at as created_at,processes.in_lot_purity as in_lot_purity',$where,array(array('processes','processes.id=process_details.process_id')));
  
  }

}
