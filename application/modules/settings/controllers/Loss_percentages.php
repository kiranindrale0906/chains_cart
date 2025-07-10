<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loss_percentages extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'settings/same_karigar_model'));
  }

  public function _get_form_data(){
    //pd($this->data);
    if (empty($this->data['record']['loss_percentage'])) $this->data['record']['loss_percentage'] = 0;
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if (empty($this->data['record']['max_loss_percentage'])) $this->data['record']['max_loss_percentage'] = 0;
    $processes = $this->process_model->get('distinct(product_name) as product_name', array('where_not_in' => array('product_name' => array("'Receipt'","'Chain Receipt'","'Daily Drawer Receipt'","'Pending Loss Out'","'Pending Loss from Hook'","'Issue'")), 'department_name != ' => 'Start'), array(), array('order_by' => 'product_name'));
    
    $product_names = array_column($processes, 'product_name');
    $this->data['products']  = get_dropdown_array($product_names, true);  //$this->same_karigar_model->get_product_dropdown();
    $this->data['processes'] = array();
    $this->data['departments'] = array();
    $this->data['karigars'] = array();

    if (!empty($_GET['product_name'])) {
      $this->data['record']['product_name'] = $_GET['product_name'];
      $processes = $this->process_model->get('distinct(process_name) as product_name', array('product_name' => $this->data['record']['product_name']));
      $process_names = array_column($processes, 'product_name');
      $this->data['processes'] = get_dropdown_array($process_names, true);
      //$this->data['processes'] = $this->same_karigar_model->get_process_dropdown($this->data['record']['product_name']);
    }

    if (!empty($_GET['process_name'])) {
      $this->data['record']['process_name'] = $_GET['process_name'];
      //if (!empty($this->data['record']['product_name']) && !empty($this->data['record']['process_name']))   
      $processes = $this->process_model->get('distinct(department_name) as department_name', array('product_name' => $this->data['record']['product_name'],
                                                                                                   'process_name' => $this->data['record']['process_name'],
                                                                                                   'department_name != ' => 'Start'));
      $department_names = array_column($processes, 'department_name');
      $this->data['departments'] = get_dropdown_array($department_names, true);
      //$this->data['departments'] = $this->same_karigar_model->get_department_dropdown($this->data['record']['product_name'], 
      //                                                                                $this->data['record']['process_name']);
    }

    if (!empty($_GET['department_name'])) $this->data['record']['department_name'] = $_GET['department_name'];
    if (!empty($this->data['record']['product_name']) 
        && !empty($this->data['record']['process_name']) 
        && !empty($this->data['record']['department_name'])) {
      $this->data['karigars'] =  $this->same_karigar_model->get_karigar_dropdown($this->data['record']['product_name'], 
                                                                                 $this->data['record']['process_name'], 
                                                                                 $this->data['record']['department_name']);
    }
  }

  function _after_save($formdata, $action){
    $page_no='';
    if(!empty($formdata['page_no'])){
      $page_no='?1=1&page_no='.$formdata['page_no'];
    }
    $this->data['redirect_url']= ADMIN_PATH.'settings/loss_percentages'.$page_no;
    return $formdata;
  }
}
