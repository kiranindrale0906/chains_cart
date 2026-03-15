<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','issue_departments/issue_department_model'));
  }

  public function index(){
    $this->trail_balance_records();
  	parent::view(1);
  } 
  private function trail_balance_records(){
    $trail_balance_ins = $this->process_model->get('sum(in_weight) as weight,FORMAT(in_lot_purity,4) as hook_kdm_purity,account as account_name',
                                 array('where'=>array('in_weight != '=>0,
                                                      'account != '=>'')),
                                 array(),array('group_by'=>'account,in_lot_purity'));
    $this->set_trail_balance_array('in_weight', $trail_balance_ins);
    
    $trail_balance_outs = $this->issue_department_model->get('sum(in_weight) as weight,
                                                          FORMAT(in_purity,4) as hook_kdm_purity,account_id as account_name',
                                              array('where'=>array('in_weight != ' => 0,
                                                'account_id != '=>'')),
                                              array(),
                                              array('group_by'=>'account_id,in_purity'));
    $this->set_trail_balance_array('out_weight', $trail_balance_outs);
   } 

  private function set_trail_balance_array($in_out, $balance_in_outs) {
    if(!empty($balance_in_outs)){
      foreach ($balance_in_outs as $index => $balance_in_out) {
       $account_name = $balance_in_out['account_name'];
       $purity = $balance_in_out['hook_kdm_purity']; 
       $account_names = $balance_in_out['account_name'];
        if (!isset($this->data['trail_balance_reports'][$account_names])) 
          $this->data['trail_balance_reports'][$account_names] = array();
        if (!isset($this->data['trail_balance_reports'][$account_names][$purity]))
        $this->data['trail_balance_reports'][$account_names][$purity] = array('in_weight'=>0,'out_weight'=>0);     
        $this->data['trail_balance_reports'][$account_names][$purity][$in_out] += $balance_in_out['weight'];
      }
    }
  }
}