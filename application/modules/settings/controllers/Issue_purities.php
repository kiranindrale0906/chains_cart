<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Issue_purities extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model', 'settings/category_four_model', 'settings/category_model', 'processes/process_model',
                             'ka_chains/ka_chain_order_model', 'ka_chains/ka_chain_order_detail_model'));
  }

  public function _get_form_data(){
    $category_one='';
    if (!empty($_GET['category_one']))
      $category_one = (strpos($_GET['category_one'],'%')) ? urlencode($_GET['category_one']) : urldecode($_GET['category_one']);
    
    $this->data['order_detail_id'] = !empty($_GET['order_detail_id']) ? $_GET['order_detail_id'] : '';
    if (!empty($this->data['order_detail_id'])) {
      $order_detail = $this->ka_chain_order_detail_model->find('', array('id' => $this->data['order_detail_id']));
      $order = $this->ka_chain_order_model->find('', array('id' => $order_detail['order_id']));
      $this->data['record']['chain_name'] = 'KA Chain';
      $this->data['record']['category_one'] = $order_detail['category_one'];
      $this->data['record']['category_two'] = $order_detail['category_two'];
      $this->data['record']['category_three'] = $order_detail['category_three'];
      $this->data['record']['category_four'] = $order_detail['category_four'];

      if ($order['lot_purity'] >= 88) 
        $order['lot_purity'] = 92;
      elseif ($order['lot_purity'] >= 80 && $order['lot_purity'] < 88) 
        $order['lot_purity'] = 83.50;
      elseif ($order['lot_purity'] >= 65 && $order['lot_purity'] < 80)
        $order['lot_purity'] = 75.00;
      else 
        $order['lot_purity'] = 58.50;
      $this->data['record']['chain_purity'] = $order['lot_purity'];
    }

    $this->data['record']['chain_name']=$this->data['product_name'] = (!empty($_GET['product_name'])) ? $_GET['product_name'] : '';

    if (!empty($_GET['category_one'])) $this->data['record']['category_one'] = str_replace('^^','+', $category_one);
    if (!empty($_GET['category_three'])) $this->data['record']['category_three'] = str_replace('^^','+',$category_three);
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';

    $this->data['products'] = get_process_refresh();
    
    if ($this->router->method == 'store' || $this->router->method == 'update') 
      $this->data['record']['chain_name'] = $_POST['issue_purities']['chain_name'];
        
    if (!empty($this->data['record']['chain_name']))
      if ($this->data['record']['chain_name'] == 'Finished Goods Receipt')
        $this->data['category_ones'] = $this->process_model->get('distinct(description) as id,
                                                                 description as name', array('product_name' => $this->data['record']['chain_name']));
      else
        $this->data['category_ones'] = $this->category_model->get('distinct(category_one) as id,
                                                                  category_one as name', array('product_name' => $this->data['record']['chain_name']));
    
    $this->data['category_threes']=array();
    if(!empty($this->data['record']['chain_name'])&&!empty($this->data['record']['category_one']))
      $this->data['category_threes'] = $this->category_model->get('distinct(category_three) as id,category_three as name',
                                                                 array('product_name'=>$this->data['record']['chain_name'],
                                                                       'category_one'=>$this->data['record']['category_one']));
  
    $this->data['category_fours']=array();
    if(!empty($this->data['record']['chain_name']))
      $this->data['category_fours'] = $this->category_four_model->get('distinct(category) as id,category as name',
                                                                      array('product_name'=>$this->data['record']['chain_name']));   
    $this->data['category_fours']=array_merge(array(array('id'=>'All','name'=>'All')),$this->data['category_fours']);

  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'settings/issue_purities';
    return $formdata;
  }

  public function _after_delete($id){
    $this->data['page_no'] = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    $page_no='';
    if(!empty($this->data['page_no'])){
      $page_no='?1=1&page_no='.$this->data['page_no'];
    }
    redirect(base_url().'settings/issue_purities'.$page_no);

    // $this->data['redirect_url']= ADMIN_PATH.'settings/issue_purities';
    // return $formdata;
  }
}