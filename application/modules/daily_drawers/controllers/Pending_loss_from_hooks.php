<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_loss_from_hooks extends BaseController {	
	public function __construct(){
    $this->_model='pending_loss_from_hook_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model', 'settings/karigar_model',
                             'ka_chains/ka_chain_hook_process_model',
                             'ball_chains/ball_chain_hook_plain_process_model',
                             'ka_chains/ka_chain_hook_refresh_process_model',
                             'processes/process_out_wastage_detail_model'));
  }  

  // public function index() { 
  //   redirect(base_url().'daily_drawers/pending_loss_from_hooks/create');
  // }

  public function create() {
    $this->data['record']['karigar'] =  isset($_GET['karigar']) ? $_GET['karigar'] : '';
    $this->data['record']['in_lot_purity'] =  isset($_GET['purity']) ? $_GET['purity'] : '';
    parent::create();
  }

  public function _get_form_data() {
    if (!empty($this->data['record']['karigar'])&&!empty($this->data['record']['in_lot_purity'])) {

      $where = array('karigar' => $this->data['record']['karigar'],
                     'department_name' => 'Hook',
                     'hook_in > 0' => NULL,
                     'id not in (select process_id from process_out_wastage_details where field_name = "Pending Loss from Hook")' => NULL);
      $in_weight_where=array('karigar' => $this->data['record']['karigar']);
      // if ($this->data['record']['in_lot_purity'] == '83.65') {
      //   $where['hook_kdm_purity >'] =  '80';
      //   $where['hook_kdm_purity <'] =  '85';
      //   $in_weight_where['hook_kdm_purity >'] =  '80';
      //   $in_weight_where['hook_kdm_purity <'] =  '85';
      // }elseif ($this->data['record']['in_lot_purity'] == '87.65') {
      //   $where['hook_kdm_purity >'] =  '86';
      //   $where['hook_kdm_purity <'] =  '88';
      //   $in_weight_where['hook_kdm_purity >'] =  '86';
      //   $in_weight_where['hook_kdm_purity <'] =  '88';
      // }elseif ($this->data['record']['in_lot_purity'] == '75.15') {
      //   $where['hook_kdm_purity <'] =  '80';
      //   $in_weight_where['hook_kdm_purity <'] =  '80';
      // } elseif ($this->data['record']['in_lot_purity'] == '100') {
      //   $where['hook_kdm_purity '] =  '100';
      //   $in_weight_where['hook_kdm_purity '] =  '100';
      // } else {
      //  $where['hook_kdm_purity >'] =  '88';
      //  $where['hook_kdm_purity <'] =  '100';
      //  $in_weight_where['hook_kdm_purity >'] =  '88';
      //  $in_weight_where['hook_kdm_purity <'] =  '100';
      // }
      $where['hook_kdm_purity >'] =  $this->data['record']['in_lot_purity']- 2;
      $where['hook_kdm_purity <'] =  $this->data['record']['in_lot_purity']+ 2;
      $in_weight_where['hook_kdm_purity >'] =  $this->data['record']['in_lot_purity']- 2;
      $in_weight_where['hook_kdm_purity <'] =  $this->data['record']['in_lot_purity']+2;
      $ka_chain_hook_processes = $this->ka_chain_hook_process_model->get('', $where);
      $ball_chain_hook_processes = $this->ball_chain_hook_plain_process_model->get('', $where);
      $ka_chain_hook_refresh_processes = $this->ka_chain_hook_refresh_process_model->get('', $where);
      $this->data['processes']=array_merge($ka_chain_hook_processes,$ka_chain_hook_refresh_processes,$ball_chain_hook_processes);
      $this->data['record']['in_weight'] = $this->process_model->find('sum(daily_drawer_in_weight - daily_drawer_out_weight 
                                                                       - hook_in + hook_out) as daily_drawer_weight',$in_weight_where
                                                                       )['daily_drawer_weight'];
    }
    $this->data['purity'] = $this->process_model->get('distinct(hook_kdm_purity) as name,hook_kdm_purity as id',array('where'=>array('hook_kdm_purity>'=>0,'department_name'=>'Hook')),array(),array('order_by'=>'hook_kdm_purity'));
    //$this->data['karigars'] = get_karigars();
    $this->data['karigars'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));
  }

  public function _get_view_data() {
    $this->data['process_out_wastage_details'] = $this->process_out_wastage_detail_model->get('', array('parent_id' => $this->data['record']['id']));
    $process_ids = array_column($this->data['process_out_wastage_details'], 'process_id');
    $this->data['processes'] = $this->process_model->get('',array('where_in' => array('id' => $process_ids)));
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'daily_drawers/pending_loss_from_hooks';
    return $formdata;
  }
}
