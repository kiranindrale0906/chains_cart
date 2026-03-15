<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lock_dispatched_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','processes/process_field_model','settings/loss_category_model'));
  }

  public function index() { 
		$this->get_details();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/lock_dispatched_reports/index', $this->data);    
  } 

  private function get_details(){
    $this->data['lock_nos']=array(array('id'=>'','name'=>'Select'),
                                      array('id'=>'0','name'=>'0'),
                                      array('id'=>'1','name'=>'1'),
                                      array('id'=>'2','name'=>'2'),
                                      array('id'=>'3','name'=>'3'),
                                      array('id'=>'4','name'=>'4'),
                                      array('id'=>'5','name'=>'5'),
                                      array('id'=>'6','name'=>'6'),
                                      array('id'=>'7','name'=>'7'),
                                      array('id'=>'8','name'=>'8'),
                                      array('id'=>'9','name'=>'9'),
                                      array('id'=>'10','name'=>'10'));
    $this->data['in_lot_purity']=$this->process_model->get('distinct(in_lot_purity) as name ,in_lot_purity as id');
    $this->data['city']=$this->process_field_model->get('distinct(city) as name ,city as id',array("city!="=>""
    ));
    $this->data['record']['city']=!empty($_GET['city'])?$_GET['city']:'';
    $this->data['record']['in_lot_purity']=!empty($_GET['in_lot_purity'])?$_GET['in_lot_purity']:'';
    $this->data['record']['from_date']=!empty($_GET['from_date'])?$_GET['from_date']:'';
    $this->data['from_date']=!empty($_GET['from_date'])?$_GET['from_date']:'';
    $this->data['to_date']=!empty($_GET['to_date'])?$_GET['to_date']:'';
    $this->data['record']['to_date']=!empty($_GET['to_date'])?$_GET['to_date']:'';
    $this->data['record']['lock_no']=isset($_GET['lock_no'])?$_GET['lock_no']:'';
    $where=array("process_details.city in  ('LOCK ARG','LOCK ARF')"=>NULL);
    if(!empty($this->data['record']['city'])){
       $where['process_details.city']=$this->data['record']['city'];
    }
    if(!empty($this->data['record']['in_lot_purity'])){
       $where['processes.in_lot_purity']=$this->data['record']['in_lot_purity'];
    }
    if(isset($this->data['record']['lock_no'])){
       $where['process_details.lock_no']=$this->data['record']['lock_no'];
    }
    if(!empty($this->data['record']['from_date'])) {
      $where['date(processes.completed_at) >=']  = date('Y-m-d', strtotime($this->data['record']['from_date']));
    }
    if(!empty($this->data['record']['to_date'])) {
     $where['date(processes.completed_at )<='] = date('Y-m-d', strtotime($this->data['record']['to_date']));
    }
    $this->data['lock_dispactched_records'] = $this->process_field_model->get('processes.in_lot_purity as in_lot_purity,processes.completed_at,processes.lot_no,processes.tone as tone,processes.out_weight as out_weight,process_details.city as city,process_details.quantity as no_of_pc,process_details.lock_no as lock_no',$where,array(array('processes',"process_details.process_id=processes.id")),array('order_by'=>'completed_at desc'));
//    pd($this->data['lock_dispactched_records']);
  }

}
