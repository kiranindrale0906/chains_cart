<?php
class Item_code_masters extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->redirect_after_save = 'index';
    $this->load->model(array('settings/category_model','processes/process_model','ka_chains/ka_chain_factory_order_master_model'));
  }
  public function _get_form_data(){
    $this->data['product_names'] = $this->get_distinct_values_for_dropdown('product_name');
    $this->data['record']['product_name']=!empty($_GET['product_name'])?$_GET['product_name']:$this->data['record']['product_name'];
    $where=array();
    if(!empty($this->data['record']['product_name'])){
      $where['product_name']=$this->data['record']['product_name'];
    }
    $this->data['design_names'] = $this->category_model->get('category_one as id, category_one as name',$where);
 
    $this->data['tones'] = $this->process_model->get('distinct(tone)  as name ,tone as id' ,array('tone!='=>""));
    
 $this->data['meltings'] = $this->process_model->get('distinct(out_lot_purity) as name ,out_lot_purity as id' ,array('balance!='=>0));
    if(HOST=='ARF' && $this->data['record']['product_name']=='KA Chain'){
      $this->data['category_ones'] = $this->ka_chain_factory_order_master_model->get('category_name as name ,category_name as id', 
                                                                  array(), array(),
                                                                  array('group_by'=>'category_name','order_by'=>'category_name'));
      $this->data['machine_sizes'] = $this->ka_chain_factory_order_master_model->get('gauge as name ,gauge as id', 
                                                                  array(), array(),
                                                                  array('group_by'=>'gauge','order_by'=>'gauge'));
    }else{

      $this->data['category_ones'] = $this->category_model->get('DISTINCT(category_one) as name, category_one as id', array('product_name'=>$this->data['record']['product_name']));
      $this->data['machine_sizes']=$this->category_model->get('DISTINCT(category_three) as name,category_three as id',array('product_name'=>$this->data['record']['product_name']));
    }
  }

  private function get_distinct_values_for_dropdown($field) {
    $where = array($field.' !=' => '');
    $values = $this->process_model->get('distinct('.$field.') as name, '.$field.' as id', 
                                      array(), array(), 
                                      array('order_by' => $field));
    
      return $values;
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'masters/item_code_masters';
    return $formdata;
  }
}
