<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alloy_details extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'index';
    $this->data['validation_klass'] = 'record';
    $this->load->model(array('same_karigar_model','chain_purity_model','alloy_type_model','melting_lots/melting_lot_model','processes/process_model','settings/category_model','ka_chains/ka_chain_factory_order_master_model'));
  }
  public function store(){
    if(!empty($_POST['import']))
      $this->data['validation_klass'] = 'import_file';
    parent::store();
  }

  public function _get_form_data(){
  	$product_name = $this->melting_lot_model->get('DISTINCT(process_name) as id,process_name as name',array(),array(),array('order_by'=>'process_name'));
    $process_name = array(array('id'=>'Daily Drawer',
                                'name'=>'Daily Drawer'));
    $product_name = array_merge($product_name,$process_name);
    //$product_name = get_process_dropdown_with_host();
  	$this->data['product_name'] = $product_name;
  	if(($this->router->method == 'edit' || $this->router->method == 'update') 
  		&& !isset($_GET['process_name']) && !isset($_POST['alloy_details']['product_name'])){
  		$process_name = $this->data['record']['product_name'];
  	}else{
	  	if(isset($_GET['process_name']) && !empty($_GET['process_name'])) $process_name = $_GET['process_name'];
	  	elseif(isset($_POST['alloy_details']['product_name']) 
	  																									&& !empty($_POST['alloy_details']['product_name']))
	  	$process_name = $_POST['alloy_details']['product_name'];
  		else $process_name = '';
		}
    $this->data['machine_sizes']=array();
    $this->data['design_names']=array();
 
  	if(!empty($process_name)){
  		$purities = $this->chain_purity_model->get('DISTINCT(lot_purity) as id,lot_purity as name',array('product_name'=>$process_name));
      
  		if(HOST=='ARC'){
      $tone= array(array('id'=>'yellow','name'=>'Yellow'),array('id'=>'pink','name'=>'Pink'),array('id'=>'White','name'=>'White'),array('id'=>'Green','name'=>'Green'));
      }else{
        $tone= array(array('id'=>'yellow','name'=>'Yellow'),array('id'=>'pink','name'=>'Pink'));
      }
  		$chains = get_chain_options($process_name);
      if(HOST=='ARF'){
      $category_one =$this->ka_chain_factory_order_master_model->get('DISTINCT(category_name) as name,category_name as id');
      $this->data['machine_sizes'] =$this->ka_chain_factory_order_master_model->get('DISTINCT(gauge) as name,gauge as id');
      $this->data['design_names'] =$this->ka_chain_factory_order_master_model->get('DISTINCT(design_name) as name,design_name as id');
      }else{
      $category_one =isset(get_category_one()[$process_name])?get_category_one()[$process_name]:array();
      }
 /* 		if(isset($purities[$process_name])) $purities = $purities[$process_name];
  		else $purities = $purities['Other Chain'];*/
  		$this->data['record']['product_name'] = $process_name;
  		/*if(isset($tone[$process_name])) $tone = $tone[$process_name];
  		else $tone = array();*/
  		$this->data['record']['product_name'] = $process_name;

  	}else {
  		$purities = array();
  		$tone = array();
  		$chains = array();
      $category_one = array();
  	}
    if($this->router->method == 'edit' || $this->router->method == 'update')
        $this->data['category_one'] = $category_one;
        else
        $this->data['category_one'] = array_merge(array(array('id'=>'All','name'=>'All')),$category_one);
  	$this->data['purities'] =array_merge(array(array('id'=>'','name'=>'All')),$purities);
  	$this->data['tone'] =$tone;
  	$this->data['chains'] =$chains;
  	$this->data['alloy_types'] = $this->alloy_type_model->get('id,alloy_name as name');
  
  }

  public function _after_save(){
  	$this->data['redirect_url'] = base_url().'settings/alloy_details';
  }

}