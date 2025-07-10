<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_factory_order_details extends BaseController {	
	public function __construct(){
    $this->_model='process_factory_order_detail_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model', 'processes/process_out_wastage_detail_model','ka_chains/ka_chain_factory_order_master_model', 'processes/process_field_model', 'processes/process_model','ka_chains/ka_chain_factory_order_detail_model','ka_chains/ka_chain_order_detail_model','ka_chains/ka_chain_factory_order_model'));
  }  
  public function index() { 
    $this->data['process_id']=!empty($_GET['process_id'])?$_GET['process_id']:0;
    redirect(base_url().'processes/process_factory_order_details/create?process_id='.$this->data['process_id']);    
  } 
 
  public function _get_form_data() {

    $this->data['process_id']=!empty($_GET['process_id'])?$_GET['process_id']:0;
    if($this->router->method=='store'){
      $this->data['process_id']=!empty($this->data['record']['process_id'])?$this->data['record']['process_id']:0;
    }
    $orders_ids = $this->process_factory_order_detail_model->get('factory_order_detail_id',array('factory_order_detail_id!='=>NULL));
    $process_details = $this->process_model->find('*',array('id'=>$this->data['process_id']));
    $order_details = $this->ka_chain_order_detail_model->find('*',array('id'=>$process_details['order_detail_id']));
    $factory_order_masters = $this->ka_chain_factory_order_master_model->find('*',array('category_name'=>$order_details['category_one'],'design_name'=>$order_details['category_four'],'line'=>$order_details['line']));
    $this->data['factory_order_details']['balance']=$process_details['balance'];
    $this->data['factory_order_details']['product_name']=$process_details['product_name'];
    $this->data['factory_order_details']['process_name']=$process_details['process_name'];
    $this->data['factory_order_details']['category_name']=!empty($factory_order_masters['category_name'])?$factory_order_masters['category_name']:'';
    $this->data['factory_order_details']['market_design_name']=!empty($factory_order_masters['market_design_name'])?$factory_order_masters['market_design_name']:'';
    $this->data['factory_order_details']['design_name']=!empty($factory_order_masters['design_name'])?$factory_order_masters['design_name']:'';
    $this->data['factory_order_details']['gauge']=!empty($factory_order_masters['gauge'])?$factory_order_masters['gauge']:'';
    $this->data['factory_order_details']['line']=!empty($factory_order_masters['line'])?$factory_order_masters['line']:'';
    
    $exclude_order_ids = array_column($orders_ids, 'factory_order_detail_id');
    $where=array('(14_inch_qty_pending!=0 or 
            15_inch_qty_pending!=0 or 
            16_inch_qty_pending!=0 or 
            17_inch_qty_pending!=0 or 
            18_inch_qty_pending!=0 or 
            19_inch_qty_pending!=0 or 
            20_inch_qty_pending!=0 or 
            21_inch_qty_pending!=0 or 
            22_inch_qty_pending!=0 or 
            23_inch_qty_pending!=0 or 
            24_inch_qty_pending!=0 or 
            25_inch_qty_pending!=0 or 
            26_inch_qty_pending!=0 or 
            27_inch_qty_pending!=0 or 
            28_inch_qty_pending!=0 or 
            29_inch_qty_pending!=0 or 
            30_inch_qty_pending!=0 or 
            31_inch_qty_pending!=0 or 
            32_inch_qty_pending!=0 or 
            33_inch_qty_pending!=0 or 
            34_inch_qty_pending!=0 or 
            35_inch_qty_pending!=0 or 
            36_inch_qty_pending!=0)'=>NULL);
    if(!empty($exclude_order_ids)){
      $where['ka_chain_factory_order_details.id not in  ('.implode(", ", $exclude_order_ids).')']=NULL;
    }
    $this->data['ka_chain_factory_details'] = $this->ka_chain_factory_order_detail_model->get(
                                                   'ka_chain_factory_order_details.*,
                                                    ka_chain_factory_order_masters.category_name as category_name,
                                                    ka_chain_factory_order_masters.design_name as design_name,
                                                    ka_chain_factory_order_masters.gauge as gauge,
                                                    ka_chain_factory_order_masters.wt_in_18_inch as wt_in_18_inch,
                                                    ka_chain_factory_order_masters.wt_in_24_inch as wt_in_24_inch,
                                                    ka_chain_factory_order_masters.line as line',
                                                    $where,
                                                    array(array('ka_chain_factory_order_masters',
                                                                'ka_chain_factory_order_details.market_design_name=ka_chain_factory_order_masters.market_design_name')));

      $customer_name='';
      foreach ($this->data['ka_chain_factory_details'] as $index => $value) {
        $process_details = $this->process_model->find('*',array('id'=>$this->data['process_id']));
        $factory_orders=$this->ka_chain_factory_order_model->find('*',array('id'=>$value['ka_chain_factory_order_id']));
        if($process_details['melting_lot_category_four']==$value['design_name']&&
           $process_details['melting_lot_category_three']==$value['gauge']&&
           $process_details['melting_lot_category_one']==$value['category_name']&&
           $process_details['line']==$value['line']){
            $wt_18_in_inch=$value['wt_in_18_inch'];
            $wt_24_in_inch=$value['wt_in_24_inch'];
          $this->data['processes'][$index]=$value;
          $this->data['processes'][$index]['wt_18_in_inch']=round($wt_18_in_inch);
          $this->data['processes'][$index]['wt_24_in_inch']=round($wt_24_in_inch);
          $this->data['processes'][$index]['due_date']=date('d-m-y',strtotime($factory_orders['due_date']));
          $this->data['processes'][$index]['customer_name']=$factory_orders['customer_name'];
        }
      }
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'ka_chains/factory_processes';
    return $formdata;
  }
}
