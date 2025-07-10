<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stone_vatav_ledgers extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/loss_category_model'));
  }

  public function index() { 
		$this->get_stone_vatav_details();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/stone_vatav_ledgers/index', $this->data);    
  } 

  private function get_stone_vatav_details(){
    $this->data['process_name']=array(array('id'=>'Stone Setting','name'=>'Stone Setting'),
                                      array('id'=>'Casting','name'=>'Casting'),
                                      array('id'=>'Stone Setting RND','name'=>'Stone Setting RND'));
    $this->data['karigar']=$this->process_model->get('distinct(karigar) as name ,karigar as id',array('department_name in ("Stone Setting","Stone Setting RND","Casting")'=>NULL));
    $this->data['in_lot_purity']=$this->process_model->get('distinct(in_lot_purity) as name ,in_lot_purity as id',array('department_name in ("Stone Setting","Stone Setting RND","Casting")'=>NULL));
    $this->data['record']['process_name']=!empty($_GET['process_name'])?$_GET['process_name']:'';
    $this->data['record']['in_lot_purity']=!empty($_GET['in_lot_purity'])?$_GET['in_lot_purity']:'';
    $this->data['record']['from_date']=!empty($_GET['from_date'])?$_GET['from_date']:'';
    $this->data['record']['to_date']=!empty($_GET['to_date'])?$_GET['to_date']:'';
    $this->data['record']['karigar']=!empty($_GET['karigar'])?$_GET['karigar']:'';
    $where=array('stone_in!='=>0,'stone_out!='=>0);
    if(!empty($this->data['record']['process_name'])){
       $where['department_name']=$this->data['record']['process_name'];
    }
    if(!empty($this->data['record']['in_lot_purity'])){
       $where['in_lot_purity']=$this->data['record']['in_lot_purity'];
    }
    if(!empty($this->data['record']['karigar'])){
       $where['karigar']=$this->data['record']['karigar'];
    }
    if(!empty($this->data['record']['from_date'])) {
      $where['date(processes.completed_at) >=']  = date('Y-m-d', strtotime($this->data['record']['from_date']));
    }
    if(!empty($this->data['record']['to_date'])) {
     $where['date(processes.completed_at )<='] = date('Y-m-d', strtotime($this->data['record']['to_date']));
    }
    $this->data['stone_vatav_records'] = $this->process_model->get('',$where,array(),array('order_by'=>'completed_at desc'));
  }

}
