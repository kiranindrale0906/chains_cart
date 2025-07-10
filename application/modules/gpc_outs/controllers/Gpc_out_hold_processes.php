<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpc_out_hold_processes extends BaseController { 
  public function __construct(){
   parent::__construct();
   }  
   
  public function index() { 
    redirect(base_url().'gpc_outs/gpc_out_hold_processes/create');
  } 
  
  public function _get_form_data() {
    $this->data['product_names'] = $this->process_model->get('DISTINCT(product_name) as id, product_name as name',array('product_name!='=>"KA Chain"));
    $this->data['purities'] = array(array('name' => '100', 'id' => '100'),
                                    array('name' => '90% - 93%', 'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.50'),
                                    array('name' => '80% - 85%', 'id' => '83.50'),
                                    array('name' => '70% - 79.99%', 'id' => '75.15'),
                                    array('name' => '58% - 59%', 'id' => '58.50'),
                                    array('name' => '41% - 42%', 'id' => '41.50'));

    $this->data['record']['product_name'] = (!empty($_GET['product_name']) ? $_GET['product_name'] : '');
    $this->data['record']['melting'] = (!empty($_GET['melting']) ? $_GET['melting'] : '');
   
    
       if (!empty($this->data['record']['melting'])) {
      if ($this->data['record']['melting'] == '83.50') {
        $where = array('hook_kdm_purity >' => '80',
                       'hook_kdm_purity <' => '85');
      }elseif ($this->data['record']['melting'] == '87.50') {
        $where = array('hook_kdm_purity >' => '86',
                       'hook_kdm_purity <' => '88');
      }elseif ($this->data['record']['melting'] == '92') {
        $where = array('hook_kdm_purity >' => '90',
                       'hook_kdm_purity <' => '93');
      }elseif ($this->data['record']['melting'] == '75.15') {
        $where = array('hook_kdm_purity >' => '70',
                       'hook_kdm_purity <' => '79.99');
      }elseif ($this->data['record']['melting'] == '58.50') {
        $where = array('hook_kdm_purity >' => '58',
                       'hook_kdm_purity <' => '59');
      }elseif ($this->data['record']['melting'] == '41.50') {
        $where = array('hook_kdm_purity >' => '41',
                       'hook_kdm_purity <' => '42',);
      } elseif ($this->data['record']['melting'] == '100') {
        $where = array('hook_kdm_purity ' => '100',
                       );
      }}
    $where['gpc_out_required_status']=0;
    $where['balance_gpc_out !=']=0;
//    $where['product_name !=']="KA Chain";
    if(!empty($this->data['record']['product_name'])){
      $where['product_name']=$this->data['record']['product_name'];
    }

    $this->data['processes'] = $this->process_model->get('', $where);
    foreach ($this->data['processes'] as $index => $value) {
      $users=$this->user_model->find('name',array('id'=>$value['created_by']));
      $this->data['processes'][$index]['username']=$users['name'];
    }
  }


  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'gpc_outs/gpc_out_hold_processes';
    return $formdata;
  }
}
