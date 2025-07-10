<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Two_tone_rhodiums extends BaseController {  
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

   $this->data['report_datas']=$this->two_tone_rhodium_model->get('id,
                                                              product_name,
                                                              process_name,
                                                              updated_at as date,
                                                              product_name,
                                                              (rhodium_in) as rhodium_in,
                                                              out_weight,
                                                              melting_lot_category_four as design_name',
                                                          array('product_name in (
                                                                      "KA Chain",
                                                                      "Ball Chain",
                                                                      "Office Outside")'=>NULL,
                                                                'process_name in (
                                                                      "Stripping Process",
                                                                      "DC Process",
                                                                      "CNC Process")'=>NULL,
                                                                'department_name'=>'Stripping',
                                                                'out_weight !='=>0,
                                                                'date(updated_at)>='=>$this->data['from_date'],
                                                                'date(updated_at)<='=>$this->data['to_date']));


    $this->load->render('rhodium_reports/two_tone_rhodiums/index',$this->data);    
  }
}