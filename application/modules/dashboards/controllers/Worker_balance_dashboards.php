<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Worker_balance_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model','users/user_model','daily_drawers/box_weight_model','issue_departments/issue_department_model'));
  }

  public function index() {
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string,$_GET);

    $users = $this->user_model->get('*');
    $this->data['worker'] = $this->worker_balance_dashboard_model->get('worker as id,worker as name',array(),array(),array('order_by'=>'worker','group_by'=>'worker'));
    $this->data['record']['worker']=!empty($_GET['worker'])?$_GET['worker']:'';

    $this->get_worker_balance_dashboard_cards();
    $this->get_worker_total_balance();
    $this->get_hook_department_worker_total_balance();
    $this->wastage_records();
    // if(HOST=='ARF'){
      $where_in['where']=array('balance !='=> 0, 'worker !=' => 'Factory','department_name'=>'Chain Making');
    // }else{
    //   $where_in['where']=array('department_name'=>'Hook','balance !='=> 0,'worker !=' => 'Factory');
    // }
    $group_by_in=array('group_by'=>'worker, lot_no, design_code, hook_kdm_purity, balance');
    
    if(!empty($this->data['record']['worker'])){
      $where_in['where']['worker']=$this->data['record']['worker'];
      $group_by_in=array('group_by'=>'lot_no, design_code, hook_kdm_purity, balance');
    }

    $group_by_daily_drawer_balance=array('group_by'=>'worker, hook_kdm_purity,lot_no,design_code',
                                         'having' => 'balance != 0');
    $where_daily_drawer_balance=array('(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) != ' => 0,'worker != ' => 'Factory','department_name'=>'Chain Making');
   

    if(!empty($this->data['record']['worker'])){
      $where_balance['worker']              = $this->data['record']['worker'];
      $group_by_balance = array('group_by'=>'hook_kdm_purity');

      $where_daily_drawer_balance['worker'] = $this->data['record']['worker'];
      $group_by_daily_drawer_balance=array('group_by'=>'hook_kdm_purity,lot_no,design_code',
                                           'having' => 'balance != 0');
    }
    $worker_daily_drawer_balances = $this->worker_balance_dashboard_model->get(
                            'concat(worker, " - ", round(hook_kdm_purity,2)) as worker, hook_kdm_purity as in_lot_purity, 
                            round((daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out), 4) as balance,lot_no, hook_kdm_purity,design_code',
                            $where_daily_drawer_balance, array(), $group_by_daily_drawer_balance);

    
    $ka_chain_worker_balance= $this->worker_balance_dashboard_model->get('concat(worker, " - ", round(hook_kdm_purity,2)) as worker, 
                                                                            lot_no, hook_kdm_purity as in_lot_purity, round(balance, 4) as balance, design_code',
                                                                                $where_in,array(),$group_by_in);
    $this->set_worker_balance_array('in', $ka_chain_worker_balance);
    
    foreach ($ka_chain_worker_balance as $index => $value) {
      if ($value['in_lot_purity'] >= 80 && $value['in_lot_purity'] < 88) 
        $purity = '80% - 88%';
      elseif ($value['in_lot_purity'] < 80)
        $purity = '- 80%';
      elseif ($value['in_lot_purity'] == 100)
        $purity = '100%';
      elseif ($value['in_lot_purity'] >= 88)
        $purity = '88% +';
      if (!isset($this->data['group_purity_of_process_balance'][$purity])) 
          $this->data['group_purity_of_process_balance'][$purity] = array('weight'=>0); 
      $this->data['group_purity_of_process_balance'][$purity]['weight']+=$value['balance'];

    }

    parent::view($users[0]['id']);
  }

  private function get_worker_balance_dashboard_cards() {
    $where_balance=array('worker !=' => 'Factory','department_name'=>'Chain Making',
                         //'department_name' => array("Hook", "Lobster", "Ball Chain Making", "Chain Making", "Ashish", "Clipping", "Refresh-Repairing"), 
                         'balance != ' => 0);
    
    $group_by_balance=array('group_by'=>'worker, department_name, hook_kdm_purity');

    $where_daily_drawer_balance=array('(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) != ' => 0,'worker != ' => 'Factory','department_name'=>'Chain Making');
    $group_by_daily_drawer_balance=array('group_by'=>'worker, hook_kdm_purity',
                                         'having' => 'balance != 0');

    if(!empty($this->data['record']['worker'])){
      $where_balance['worker']              = $this->data['record']['worker'];
      $group_by_balance = array('group_by'=>'hook_kdm_purity');

      $where_daily_drawer_balance['worker'] = $this->data['record']['worker'];
      $group_by_daily_drawer_balance=array('group_by'=>'hook_kdm_purity',
                                           'having' => 'balance != 0');
    }
    $this->data['worker_balances'] = $this->worker_balance_dashboard_model->get('concat(worker, " - ", round(hook_kdm_purity,2)) as worker, 
                                                                                   round(sum(balance), 4) as balance, hook_kdm_purity',
                                                                                   $where_balance, array(), $group_by_balance);

    $this->data['worker_balances'] = get_records_by_id($this->data['worker_balances'], 'worker');

    $worker_daily_drawer_balances = $this->worker_balance_dashboard_model->get(
                            'concat(worker, " - ", round(hook_kdm_purity,2)) as worker, hook_kdm_purity as in_lot_purity, 
                            round(sum(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out), 4) as balance, hook_kdm_purity',
                            $where_daily_drawer_balance, array(), $group_by_daily_drawer_balance);

    foreach($worker_daily_drawer_balances as $worker_daily_drawer_balance) {
      $worker = $worker_daily_drawer_balance['worker'];
      if (!isset($this->data['worker_balances'][$worker])) 
        $this->data['worker_balances'][$worker] = $worker_daily_drawer_balance;
      else
        $this->data['worker_balances'][$worker]['balance'] += $worker_daily_drawer_balance['balance'];
    }
  }

  private function get_worker_total_balance() {
    $where_balance['where']=array('balance != ' => 0,'department_name'=>'Chain Making');
    $group_by_total_balance=array('group_by'=>'parent_lot_name,department_name,worker','order_by'=>'parent_lot_name');
    if(!empty($this->data['record']['worker'])){
      $where_balance['where']['worker'] = $this->data['record']['worker'];
      $group_by_total_balance = array('group_by'=>'parent_lot_name, department_name','order_by'=>'parent_lot_name');
   }
    $chain_wise_balances = $this->worker_balance_dashboard_model->get('sum(balance) as balance, worker, parent_lot_name, department_name',
                                                                       $where_balance, array(), $group_by_total_balance);
    $this->set_worker_total_balance_array('balance', $chain_wise_balances);
    $group_by_total_balance=array('group_by'=>'lot_no,department_name,worker','order_by'=>'lot_no');
    $chain_wise_balances = $this->worker_balance_dashboard_model->get('sum(balance) as balance, worker,lot_no, department_name',$where_balance, array(), $group_by_total_balance);
   
    $this->set_worker_lot_wise_total_balance_array('balance', $chain_wise_balances);
  } 

   private function get_hook_department_worker_total_balance() {
    $where_balance['where']=array('balance != ' => 0,'department_name'=>'Chain Making');
   
    $group_by_total_balance=array('group_by'=>'product_name,in_lot_purity,worker');
    if(!empty($this->data['record']['worker'])){
      $where_balance['where']['worker'] = $this->data['record']['worker'];
      $group_by_total_balance = array('group_by'=>'product_name,in_lot_purity, worker');
    }
    $chain_wise_balances = $this->worker_balance_dashboard_model->get('sum(balance) as balance, worker, product_name,in_lot_purity',
                                                                       $where_balance, array(), $group_by_total_balance);

    $this->set_hook_department_worker_balance_array('balance', $chain_wise_balances);
  }

  private function set_worker_balance_array($in_out, $worker_balances) {
    if(!empty($worker_balances)){
      foreach ($worker_balances as $index => $worker_balance) {
        
        $worker_name = $worker_balance['worker'];
        $purity = $worker_balance['in_lot_purity'];      
        $design_code = $worker_balance['design_code'];
        $lot_no = $worker_balance['lot_no'];
     
        if (!isset($this->data['worker_wise_balances'][$worker_name])) 
          $this->data['worker_wise_balances'][$worker_name] = array(); 

        if (!isset($this->data['worker_wise_balances'][$worker_name][$lot_no]))
          $this->data['worker_wise_balances'][$worker_name][$lot_no] = array();

         if (!isset($this->data['worker_wise_balances'][$worker_name][$lot_no][$purity]))
          $this->data['worker_wise_balances'][$worker_name][$lot_no][$purity] = array();  
             
        if (!isset($this->data['worker_wise_balances'][$worker_name][$lot_no][$purity][$design_code])) 
          $this->data['worker_wise_balances'][$worker_name][$lot_no][$purity][$design_code] = array('in' => 0, 'out' => 0);     
        $this->data['worker_wise_balances'][$worker_name][$lot_no][$purity][$design_code][$in_out] += $worker_balance['balance'];
      }
    }
  }
private function set_hook_department_worker_balance_array($in_out, $worker_balances) {
    if(!empty($worker_balances)){
      foreach ($worker_balances as $index => $worker_balance) {
        
        $worker_name = $worker_balance['worker'];
        $purity = $worker_balance['in_lot_purity'];      
        $product_name = $worker_balance['product_name'];
         if ($worker_balance['in_lot_purity'] >= 80 && $worker_balance['in_lot_purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($worker_balance['in_lot_purity'] < 80)
            $purity = '- 80%';
          elseif ($worker_balance['in_lot_purity'] == 100)
            $purity = '100%';
          elseif ($worker_balance['in_lot_purity'] >= 88)
            $purity = '88% +';
        
     
        if (!isset($this->data['hook_department_worker_wise_balances'][$worker_name])) 
          $this->data['hook_department_worker_wise_balances'][$worker_name] = array(); 

        if (!isset($this->data['hook_department_worker_wise_balances'][$worker_name][$product_name]))
          $this->data['hook_department_worker_wise_balances'][$worker_name][$product_name] = array();

         if (!isset($this->data['hook_department_worker_wise_balances'][$worker_name][$product_name][$purity])) 
          $this->data['hook_department_worker_wise_balances'][$worker_name][$product_name][$purity] = array('balance' => 0);     
        $this->data['hook_department_worker_wise_balances'][$worker_name][$product_name][$purity][$in_out] += $worker_balance['balance'];
      }
    }
  }


  private function set_worker_total_balance_array($in_out, $worker_balances) {
    if(!empty($worker_balances)){
      foreach ($worker_balances as $index => $worker_balance) {
        
        $worker_name = $worker_balance['worker'];
        $parent_lot_name =$worker_balance['parent_lot_name'];
//pd($parent_lot_name);     
        if (!isset($this->data['total_worker_wise_balances'][$worker_name])) 
          $this->data['total_worker_wise_balances'][$worker_name] = array(); 

        if (!isset($this->data['total_worker_wise_balances'][$worker_name][$parent_lot_name]))
          $this->data['total_worker_wise_balances'][$worker_name][$parent_lot_name] = array();
  //      $this->data['total_worker_wise_balances'][$worker_name][$parent_lot_name]= array('balance' => 0,'department_name'=>'');     
        $this->data['total_worker_wise_balances'][$worker_name][$parent_lot_name][$in_out] += $worker_balance['balance'];
        $this->data['total_worker_wise_balances'][$worker_name][$parent_lot_name]['department_name']= $worker_balance['department_name'];
      }
    }
  }
  private function set_worker_lot_wise_total_balance_array($in_out, $worker_balances) {
    if(!empty($worker_balances)){
      foreach ($worker_balances as $index => $worker_balance) {
        
        $worker_name = $worker_balance['worker'];
        $lot_no = $worker_balance['lot_no'];
     
        if (!isset($this->data['total_worker_lot_wise_balances'][$worker_name])) 
          $this->data['total_worker_lot_wise_balances'][$worker_name] = array(); 

        if (!isset($this->data['total_worker_lot_wise_balances'][$worker_name][$lot_no]))
          $this->data['total_worker_lot_wise_balances'][$worker_name][$lot_no] = array();
    
//          $this->data['total_worker_lot_wise_balances'][$worker_name][$lot_no]= array('balance' => 0,'department_name'=>'');     
        $this->data['total_worker_lot_wise_balances'][$worker_name][$lot_no][$in_out] += $worker_balance['balance'];
        $this->data['total_worker_lot_wise_balances'][$worker_name][$lot_no]['department_name']= $worker_balance['department_name'];
      }
    }
  }
  private function wastage_records(){
    $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   worker, 
                                                   process_name as daily_drawer_type',
                                                   array('daily_drawer_in_weight != '=>0,
                                                         'type != ' => 'GPC Powder'), array(),
                                                   array('group_by'=>'hook_kdm_purity, worker, process_name'));
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          worker,
                                                          daily_drawer_type',
                                                          array('where'=>array('hook_in != ' => 0),
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'daily_drawer_out_weight != ' => 0)),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,worker,daily_drawer_type'));

    $this->set_daily_drawer_array('out', $daily_drawer_outs);
    $daily_drawer_box_weights = $this->box_weight_model->get('sum(weight) as weight,
                                                          FORMAT(purity,4) as hook_kdm_purity,
                                                          worker,
                                                          daily_drawer_type',
                                                          array('where'=>array('weight  >' => 0)),
                                                          array(),
                                                          array('group_by'=>'purity,worker,daily_drawer_type'));
    $this->set_daily_drawer_array('box_weight', $daily_drawer_box_weights);
  }  

  
  private function set_daily_drawer_array($in_out, $daily_drawers) {
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        
        $worker_name = $daily_drawer['worker'];
        
        // if ($this->data['group_by_purity'] == 1) {
          if ($daily_drawer['hook_kdm_purity'] >= 80 && $daily_drawer['hook_kdm_purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($daily_drawer['hook_kdm_purity'] < 80)
            $purity = '- 80%';
          elseif ($daily_drawer['hook_kdm_purity'] == 100)
            $purity = '100%';
          elseif ($daily_drawer['hook_kdm_purity'] >= 88)
            $purity = '88% +';
        // } else
        //   $purity = $daily_drawer['hook_kdm_purity'];      

        $daily_drawer_type = $daily_drawer['daily_drawer_type'];

        // if ($this->data['group_by_purity'] == 1) {
          if ($worker_name == 'Factory' && $daily_drawer_type != 'Hook' 
                                         && $daily_drawer_type != 'KDM' 
                                         && $daily_drawer_type != 'Lobster'
                                         && $daily_drawer_type != 'GPC Powder')
            $daily_drawer_type = 'Hook';
        // }

        if (HOST == 'ARF') {
          $daily_drawer_type = 'ARF Accessories';
        } else {
          if ($daily_drawer_type == 'Ball') $daily_drawer_type = 'Hook';
          if ($daily_drawer_type == 'Solid Wire') $daily_drawer_type = 'Hook';
          if ($daily_drawer_type == 'Hard Wire') $daily_drawer_type = 'Hook';
        }

        if (!isset($this->data['worker_daily_drawers'][$worker_name])) 
          $this->data['worker_daily_drawers'][$worker_name] = array(); 

        if (!isset($this->data['worker_daily_drawers'][$worker_name][$purity]))
          $this->data['worker_daily_drawers'][$worker_name][$purity] = array();  
             
        if (!isset($this->data['worker_daily_drawers'][$worker_name][$purity][$daily_drawer_type])) 
          $this->data['worker_daily_drawers'][$worker_name][$purity][$daily_drawer_type] = array('in' => 0, 'out' => 0,'box_weight'=>0,'gpc_powder_out'=>0);     
        $this->data['worker_daily_drawers'][$worker_name][$purity][$daily_drawer_type][$in_out] += $daily_drawer['weight'];
      }
    }
  }
  
}
