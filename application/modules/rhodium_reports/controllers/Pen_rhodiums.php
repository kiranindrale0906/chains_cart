<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pen_rhodiums extends BaseController {  
  public function __construct(){
    parent::__construct();
  }  

  public function index() {
    $this->data['from_date'] = date('Y-m-d', strtotime('-1 Days'));
    $this->data['to_date']   = date('Y-m-d');

    if(!empty($_GET['from_date'])) {
      $this->data['from_date'] = date('Y-m-d', strtotime($_GET['from_date']));
    }

    if(!empty($_GET['to_date'])) {
      $this->data['to_date'] = date('Y-m-d', strtotime($_GET['to_date']));
    }

    $this->data['report_datas']=$this->pen_rhodium_model->get('id,product_name,updated_at as date,product_name,rhodium_in,gpc_out as out_weight,melting_lot_category_four as design_name',array('product_name'=>'Fancy Chain','department_name'=>'Rhodium','gpc_out !='=>0,'date(updated_at)>='=>$this->data['from_date'],'date(updated_at)<='=>$this->data['to_date']));

    $this->load->render('rhodium_reports/pen_rhodiums/index',$this->data);    
  }
}