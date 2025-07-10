<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_drawer_wastage_category_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/daily_drawer_wastage_category_model','processes/process_model'));
  }

  public function index() { 
    $daily_drawer_wastage_categories = $this->daily_drawer_wastage_category_model->get('name,
                                                                          product_name,
                                                                          GROUP_CONCAT(QUOTE(process_name)) as process_name,
                                                                          GROUP_CONCAT(QUOTE(department_name)) as department_name',
                                                                          array(),array(),
                                                                          array('group_by'=>'name,product_name'));
    foreach ($daily_drawer_wastage_categories as $index => $category) {
    $process_name=explode(',', $category['process_name']);
    $department_name=explode(',', $category['department_name']);
    $this->data['records'][$category['name']] = $this->process_model->find('
                                                      sum(daily_drawer_wastage) as daily_drawer_wastage,
                                                      sum(daily_drawer_wastage*out_purity/100) as daily_drawer_wastage_gross,
                                                      sum((daily_drawer_wastage*out_purity/100)*out_lot_purity/100) as daily_drawer_wastage_fine,product_name',
                                                      array('product_name'=>$category['product_name'],
                                                      'where_in'=>array('process_name'=>$process_name,
                                                        'department_name'=>$department_name)));

    }
   $this->load->render('daily_drawers/daily_drawer_wastage_category_reports/index', $this->data);    
  }
}