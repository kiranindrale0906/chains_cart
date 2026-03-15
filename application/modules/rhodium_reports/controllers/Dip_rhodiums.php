<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dip_rhodiums extends BaseController {  
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

    $this->data['report_datas']=$this->dip_rhodium_model->get('id,
                                                              product_name,
                                                              process_name,
                                                              updated_at as date,
                                                              product_name,
                                                              (rhodium_in+micro_coating) as rhodium_in,
                                                              out_weight,
                                                              melting_lot_category_four as design_name',
                                                            array('product_name in ("Fancy Chain","Ball Chain","Office Outside")'=>NULL,'process_name in ("Rhodium Process","Pipe and Para Rhodium Process","Rose Gold Two Tone Process","Rose And White Gold Cutting Process")'=>NULL,'department_name'=>'Rhodium','out_weight !='=>0,'date(updated_at)>='=>$this->data['from_date'],'date(updated_at)<='=>$this->data['to_date']));

    $this->load->render('rhodium_reports/dip_rhodiums/index',$this->data);    
  }
}