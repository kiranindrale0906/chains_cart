<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_worker_reports extends BaseController {   
  public function __construct(){     
  parent::__construct();
  $this->load->model(array('settings/worker_model'));
  } 

  public function index() {

    $this->data['from_date'] = '';
    $this->data['to_date']   = '';

    if(!empty($_GET['from_date'])) {
      $this->data['from_date'] = date('Y-m-d', strtotime($_GET['from_date']));
    }

    if(!empty($_GET['to_date'])) {
      $this->data['to_date'] = date('Y-m-d', strtotime($_GET['to_date']));
    }
    $this->data['records']=array();
    if (!empty($this->data['from_date'])) {
        $where['where']=array('date(completed_at) >='=>$this->data['from_date'],'date(completed_at) <='=>$this->data['to_date']);
        $where['where']['out_weight!=']=0;
        $where['where']['department_name!=']='Start';
        $where['where_not_in']['product_name']=array('"Daily Drawer"','"Loss Out"','"Tounch Out"','"Ghiss Out"','"Pending Ghiss Out"','"Solder Wastage"');

    $reports=$this->process_model->get('department_name,sum(out_weight) as total_out_weight',$where['where'],array(),array('group_by'=>'department_name'));
    foreach ($reports as $index => $value) {
      $worker_count=$this->worker_model->find('count(name) as count',array('department_name'=>$value['department_name']))['count'];
      $this->data['records'][$index]=$value;
      $this->data['records'][$index]['worker_count']= $worker_count;
      $this->data['records'][$index]['average']=($worker_count!=0)?$value['total_out_weight']/$worker_count:0;

    }
      }
    $this->load->render('reports/product_worker_reports/index',$this->data);
  }
}