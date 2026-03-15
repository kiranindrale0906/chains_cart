<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_hold_processes extends BaseController {	
	public function __construct(){
	 parent::__construct();
   $this->load->model(array('processes/process_model','users/user_model'));
   }  
   
  public function index() { 
    redirect(base_url().'daily_drawers/daily_drawer_hold_processes/create');
  } 
  public function create() {
    // $this->data['record']['product_name'] =  isset($_GET['product_name']) ? $_GET['product_name'] : '';
    $this->data['record']['in_purity'] =  isset($_GET['in_purity']) ? $_GET['in_purity'] : '';
    parent::create();
  }

  public function _get_form_data() {
      if ($this->data['record']['in_purity'] == '83.50') {
        $where = array('hook_kdm_purity >' => '80',
                       'hook_kdm_purity <' => '85',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '87.50') {
        $where = array('hook_kdm_purity >' => '86',
                       'hook_kdm_purity <' => '88',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '92') {
        $where = array('hook_kdm_purity >' => '90',
                       'hook_kdm_purity <' => '93',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '75.15') {
        $where = array('hook_kdm_purity >' => '70',
                       'hook_kdm_purity <' => '79.99',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '58.50') {
        $where = array('hook_kdm_purity >' => '58',
                       'hook_kdm_purity <' => '59',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '41.50') {
        $where = array('hook_kdm_purity >' => '41',
                       'hook_kdm_purity <' => '42',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }elseif ($this->data['record']['in_purity'] == '37') {
        $where = array('hook_kdm_purity >' => '37',
                       'hook_kdm_purity <' => '38',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      } elseif ($this->data['record']['in_purity'] == '100') {
        $where = array('hook_kdm_purity ' => '100',
                       'wastage_purity >' => 0,
                       'wastage_lot_purity >' => 0,
                       'balance_daily_drawer_wastage != ' => 0);
      }

      if ($this->data['record']['in_purity'] == '83.50') 
        $where_condition = 'round(balance_daily_drawer_wastage,4)  !=0 and  hook_kdm_purity >80 and hook_kdm_purity < 85';
      elseif ($this->data['record']['in_purity'] == '87.50') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  hook_kdm_purity >86 and hook_kdm_purity < 88';
      elseif ($this->data['record']['in_purity'] == '92') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  and  hook_kdm_purity >90 and hook_kdm_purity < 93';
      elseif ($this->data['record']['in_purity'] == '75.15') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  and  hook_kdm_purity >70 and hook_kdm_purity < 79.99';
      elseif ($this->data['record']['in_purity'] == '58.50') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  and  hook_kdm_purity >58 and hook_kdm_purity < 59';
      elseif ($this->data['record']['in_purity'] == '41.50') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  and  hook_kdm_purity >41 and hook_kdm_purity < 42';
      elseif ($this->data['record']['in_purity'] == '37') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  and  hook_kdm_purity >37 and hook_kdm_purity < 38';
      elseif ($this->data['record']['in_purity'] == '100') 
        $where_condition = 'balance_daily_drawer_wastage  !=0  and  hook_kdm_purity =100';
      $where['daily_drawer_required_status']=0;
      $where['balance_daily_drawer_wastage !=']=0;
      $this->data['processes'] = $this->process_model->get('', $where);
      foreach ($this->data['processes'] as $index => $value) {
        $users=$this->user_model->find('name',array('id'=>$value['created_by']));
        $this->data['processes'][$index]['username']=$users['name'];
      }
       

    $this->data['purities'] = array(array('name' => '100', 'id' => '100'),
                                    array('name' => '90% - 93%', 'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.50'),
                                    array('name' => '80% - 85%', 'id' => '83.50'),
                                    array('name' => '70% - 79.99%', 'id' => '75.15'),
                                    array('name' => '58% - 59%', 'id' => '58.50'),
                                    array('name' => '41% - 42%', 'id' => '41.50'),
                                    array('name' => '37% - 38%', 'id' => '37'));
    
    
  }

  public function _get_view_data() {
    $this->data['process_out_wastage_details'] = $this->process_out_wastage_detail_model->get('',array('parent_id' => $this->data['record']['id']));
    $process_ids = array_column($this->data['process_out_wastage_details'], 'process_id');
    $this->data['processes'] = $this->process_model->get('',array('where_in' => array('id' => $process_ids)));
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'daily_drawers/daily_drawer_hold_processes';
    return $formdata;
  }
}