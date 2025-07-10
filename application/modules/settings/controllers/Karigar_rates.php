<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karigar_rates extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model','settings/karigar_rate_worker_detail_model','processes/process_model'));
  }

  public function index() {
    
    if(!empty($_POST['product_name_post'])) {
      $product_name=$_POST['product_name_post'];
      $departments=$this->model->get('DISTINCT(department_name) as id, department_name as name', 
                                      array('product_name'=>$product_name), array(), 
                                      array('order_by'=>'department_name asc'));
      $karigars=$this->model->get('DISTINCT(karigar_name) as id, karigar_name as name', 
                                      array('product_name'=>$product_name), array(), 
                                      array('order_by'=>'department_name asc'));
      echo json_encode(array('departments' => $departments,'karigars'=>$karigars,'status'=>'success',
                             'js_function'=>'populate_department_option(response)')); die;
    }
    if(!empty($_POST['product_name_design_code'])){
      $product_name=$_POST['product_name_design_code'];
      $this->ajax_dropdown_process($product_name);
    }
    parent::index();


  }

  public function _get_form_data() {
    if(!empty($this->data['record']['id'])){
      $this->data['karigar_rate_worker_details']=$this->karigar_rate_worker_detail_model->get('',array('karigar_rate_id'=>$this->data['record']['id']));                              
      $this->data['karigar_rate_worker_details']=!empty($this->data['karigar_rate_worker_details'])?$this->data['karigar_rate_worker_details']:array(array());
    }
    $this->data['karigar_rate_worker_details']=!empty($this->data['karigar_rate_worker_details'])?$this->data['karigar_rate_worker_details']:array(array());
    
    $record =& $this->data['record'];
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    
    $this->data['dropdown_data'] = $this->same_karigar_model->get_product_process_department_data();
    $this->data['products']      = $this->same_karigar_model->get_product_dropdown();
    $this->data['processes']     = array();
    $this->data['departments']   = array();
    $this->data['karigars']      = array();
    $this->data['design_codes']  = array();
    $this->data['check_fields']  = array(array('id'=>'hook_in','name'=>'Hook In'),array('id'=>'ghiss','name'=>'Ghiss'));
    $this->data['purities']  = array();

    if (!empty($record['product_name'])) {
      $this->data['processes'] = $this->same_karigar_model->get_process_dropdown($record['product_name']);
    }

    if (!empty($record['product_name']) && !empty($record['process_name'])) {
      $this->data['departments'] = $this->same_karigar_model->get('distinct(department_name) as id,department_name as name',
                                                                array('product_name'=>$record['product_name'],'process_name'=>$record['process_name']));
      //$this->data['departments'] = $this->same_karigar_model->get_department_dropdown($record['product_name'], $record['process_name']);
    }

    if (!empty($record['product_name']) && !empty($record['process_name']) & !empty($record['department_name'])) {
      // $this->data['karigars'] = $this->same_karigar_model->get_karigar_dropdown($record['product_name'], $record['process_name'], $record['department_name']);
      $this->data['karigars'] = $this->same_karigar_model->get('karigar_name as id,karigar_name as name',
                                                                array('product_name'=>$record['product_name'],'process_name'=>$record['process_name'], 
                                                                  'department_name'=>$record['department_name']));
    }
    $category_list = get_category_one();
    $this->data['category_list'] = $category_list['Machine Chain'];
    $this->data['code_list'] = $category_list['Rope Chain'];
    if($this->router->method!="create") {
      if(!empty($this->data['record']['product_name']) && $this->data['record']['product_name']=="Machine Chain"){
        $selected_category = $this->data['record']['category'];
        $selected_wire_size = $this->data['record']['wire_size'];
        $category_list = get_category_one();
        $this->data['category_list'] = $category_list['Machine Chain'];
        if(!empty($selected_category)) {
          $wire_sizes = get_category_two();
          $this->data['wire_size_list'] = $wire_sizes['Machine Chain'][$selected_category];  
        }
        
        if(!empty($selected_category) && !empty($selected_wire_size)) {
          $design_codes_list = get_category_three();
          $this->data['design_codes'] = $design_codes_list['Machine Chain'][$selected_category][$selected_wire_size];
        }
      
        

        // $this->data['design_codes']=$this->process_model->get('distinct(substring_index(lot_no,"-",1)),
        //                                                       substring_index(lot_no,"-",1) as id,
        //                                                       substring_index(lot_no,"-",1) as name', 
        //                                                       array('product_name'=>'Machine Chain'), 
        //                                                       array(), 
        //                                                       array('order_by'=>'substring_index(lot_no,"-",1) asc'));  
      }
      else if(!empty($this->data['record']['product_name']) && ($this->data['record']['product_name']=="Rope Chain" || $this->data['record']['product_name']=="Round Box Chain")) {
        $this->data['design_codes']= $this->process_model->get('Distinct(design_code) as name,
                                        design_code as id', 
                                        array('product_name'=>$this->data['record']['product_name'],
                                              'DATE(created_at)>'=>'2020-01-31',
                                              '(design_code!="" AND design_code!="0")'=>NULL), 
                                        array(), array('order_by'=>'design_code asc'));
      }
      else if(!empty($this->data['record']['product_name']) && ($this->data['record']['product_name']=="Choco Chain")) {
        $this->data['design_codes']= $this->process_model->get('Distinct(design_code) as name,
                                        design_code as id', 
                                        array('product_name'=>$this->data['record']['product_name'],
                                              'DATE(created_at)>'=>'2020-01-31',
                                              '(design_code!="" AND design_code!="0")'=>NULL), 
                                        array(), array('order_by'=>'design_code asc'));
        $this->data['purities'] = $this->get_required_purity_type($this->data['record']['product_name']);

      }
      else if(!empty($this->data['record']['product_name']) && ($this->data['record']['product_name']=="Imp Italy Chain")) {
        $this->data['design_codes']=$this->process_model->get('Distinct(concept) as name,concept as id', 
                                                        array('product_name'=>$this->data['record']['product_name'],
                                                              'DATE(created_at)>'=>'2020-01-31',
                                                              '(design_code!="" AND design_code!="0")'=>NULL), 
                                                        array(), array('order_by'=>'design_code asc'));
      }
      else if(!empty($this->data['record']['product_name']) && ($this->data['record']['product_name']=="Sisma Chain")) {
        $this->data['design_codes']=get_sisma_concepts();
      }
      else {
        $this->data['design_codes']=array(); 
      }   
    }   
  }

  private function ajax_dropdown_process($product_name) {
    $purities = array();
    if($product_name=="Machine Chain") {
         // $design_codes = $this->process_model->get('distinct(substring_index(lot_no,"-",1)), 
         //                                            substring_index(lot_no,"-",1) as id,
         //                                            substring_index(lot_no,"-",1) as name', 
         //                                            array('product_name'=>'Machine Chain'), 
         //                                            array(), array('order_by'=>'substring_index(lot_no,"-",1) asc')); 
        $design_codes = array();
      }
      else if($product_name=="Rope Chain" || $product_name=="Round Box Chain") {
        $design_codes = $this->process_model->get('Distinct(design_code) as name,design_code as id', 
                                                        array('product_name'=>$product_name,
                                                              'DATE(created_at)>'=>'2020-01-31',
                                                              '(design_code!="" AND design_code!="0")'=>NULL), array(), 
                                                        array('order_by'=>'design_code asc'));
      }
      else if($product_name=="Imp Italy Chain") {
        $design_codes = $this->process_model->get('Distinct(concept) as name,concept as id', 
                                                        array('product_name'=>$product_name,
                                                              'DATE(created_at)>'=>'2020-01-31',
                                                              '(design_code!="" AND design_code!="0")'=>NULL), array(), 
                                                        array('order_by'=>'design_code asc'));
      }
      else if($product_name=="Choco Chain") {
        $design_codes = $this->process_model->get('Distinct(design_code) as name,design_code as id', 
                                                        array('product_name'=>$product_name,
                                                              'DATE(created_at)>'=>'2020-01-31',
                                                              '(design_code!="" AND design_code!="0")'=>NULL), array(), 
                                                        array('order_by'=>'design_code asc'));
        $purities = get_melting_lots_lot_purity();
      }
      else if($product_name=="Sisma Chain") {
        $design_codes = get_sisma_concepts();
      }
      else {
        $design_codes = array();
      }
      
      echo json_encode(array('design_codes' => $design_codes,'purities'=>$purities,'status'=>'success',
                             'js_function'=>'populate_design_code_option(response)')); die; 
  }

  private function get_required_purity_type($product_name) {
    $purities_list=get_melting_lots_lot_purity();
    $purity=array();
    if($product_name=="Choco Chain") {
      $purity=$purities_list['Other Chain'];
    }

    return $purity;
  }
  function _after_save($formdata, $action){
    $page_no='';
    if(!empty($formdata['page_no'])){
      $page_no='?1=1&page_no='.$formdata['page_no'];
    }
    $this->data['redirect_url']= ADMIN_PATH.'settings/karigar_rates'.$page_no;
    return $formdata;
  }
}
