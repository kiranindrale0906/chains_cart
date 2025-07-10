<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karigar_balance_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model','users/user_model','daily_drawers/box_weight_model','issue_departments/issue_department_model'));
  }

  public function index() {
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string,$_GET);

    $users = $this->user_model->get('*');
    $this->data['karigar'] = $this->karigar_balance_dashboard_model->get('karigar as id,karigar as name',array(),array(),array('order_by'=>'karigar','group_by'=>'karigar'));
    $this->data['record']['karigar']=!empty($_GET['karigar'])?$_GET['karigar']:'';

    $this->get_karigar_balance_dashboard_cards();
    $this->get_karigar_total_balance();
    $this->get_hook_department_karigar_total_balance();
    $this->wastage_records();
    if(HOST=='ARF'){
      $where_in['where']=array('balance !='=> 0, 'karigar !=' => 'Factory');
      // $processes_and_departments = '(   
      //           (product_name = "KA Chain"           and process_name = "Hook Process"           and department_name in ("Hook", "Lobster"))
      //        or (product_name = "KA Chain"           and process_name = "Ashish Process"         and department_name = "Ashish")   
      //        or (product_name = "KA Chain"           and process_name = "Clipping Process"       and department_name = "Clipping")   
      //        or (product_name = "KA Chain"           and process_name = "Dhoom Process"          and department_name = "Chain Making")   
      //        or (product_name = "KA Chain"           and process_name = "Hook Refresh Process"   and department_name = "Hook")
      //        or (product_name = "Ball Chain"         and process_name = "Hook Plain Process"     and department_name in ("Hook", "Lobster"))
      //        or (product_name = "Ball Chain"         and process_name = "Strip Start Process"    and department_name = "Ball Chain Making")
      //        or (product_name = "Dhoom A"                                                        and department_name = "Chain Making") 
      //        or (product_name = "Dhoom B"                                                        and department_name = "Chain Making") 
      //        or (product_name = "Fancy Chain"        and process_name = "Chain Making Process"   and department_name = "Chain Making")
      //        or (product_name = "Fancy Chain"        and process_name = "Final Process"          and department_name = "Lobster")
      //        or (                                        process_name = "Vishnu Process"         and department_name ="Vishnu")
      //        or (product_name = "Nano Process"       and process_name = "Nano Process"           and department_name = "Chain Making")
      //        or (product_name = "Refresh"            and process_name = "Refresh"                and department_name = "Refresh-Repairing")
      //        )';
      // //$processes_and_departments = '(hook_in !=0 or hook_out != 0 or daily_drawer_in_weight != 0 or daily_drawer_out_weight != 0)';
      // $where_in['where'][$processes_and_departments] = NULL;
    }else{
      $where_in['where']=array('department_name'=>'Hook','balance !='=> 0,'karigar !=' => 'Factory');
    }
    // $where_out=array('(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) != ' => 0,
    //                               'karigar != ' => 'Factory');
    $group_by_in=array('group_by'=>'karigar, lot_no, design_code, hook_kdm_purity, balance');
    // $group_by_out=array('group_by'=>'karigar, hook_kdm_purity',
    //                               'having' => 'balance > 0');
    if(!empty($this->data['record']['karigar'])){
      $where_in['where']['karigar']=$this->data['record']['karigar'];
      // $where_out['karigar']=$this->data['record']['karigar'];
      $group_by_in=array('group_by'=>'lot_no, design_code, hook_kdm_purity, balance');
      // $group_by_out=array('group_by'=>'hook_kdm_purity','having' => 'balance > 0');
    }

    // $ka_chain_karigar_daily_drawer_balance = $this->karigar_balance_dashboard_model->get(
    //                         'concat(karigar, " - ", round(hook_kdm_purity,2)) as karigar, hook_kdm_purity as in_lot_purity, 
    //                         round(sum(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out), 4) as balance,
    //                         "Daily Drawer" as lot_no,  "ARF Accessories" as design_code',
    //                         $where_out,array(),$group_by_out
    //                         );
    // $this->set_karigar_balance_array('out',$ka_chain_karigar_daily_drawer_balance);
    $group_by_daily_drawer_balance=array('group_by'=>'karigar, hook_kdm_purity,lot_no,design_code',
                                         'having' => 'balance != 0');
    $where_daily_drawer_balance=array('(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) != ' => 0,'karigar != ' => 'Factory');
   

    if(!empty($this->data['record']['karigar'])){
      $where_balance['karigar']              = $this->data['record']['karigar'];
      $group_by_balance = array('group_by'=>'hook_kdm_purity');

      $where_daily_drawer_balance['karigar'] = $this->data['record']['karigar'];
      $group_by_daily_drawer_balance=array('group_by'=>'hook_kdm_purity,lot_no,design_code',
                                           'having' => 'balance != 0');
    }
    $karigar_daily_drawer_balances = $this->karigar_balance_dashboard_model->get(
                            'concat(karigar, " - ", round(hook_kdm_purity,2)) as karigar, hook_kdm_purity as in_lot_purity, 
                            round((daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out), 4) as balance,lot_no, hook_kdm_purity,design_code',
                            $where_daily_drawer_balance, array(), $group_by_daily_drawer_balance);

    
    $ka_chain_karigar_balance= $this->karigar_balance_dashboard_model->get('concat(karigar, " - ", round(hook_kdm_purity,2)) as karigar, 
                                                                            lot_no, hook_kdm_purity as in_lot_purity, round(balance, 4) as balance, design_code',
                                                                                $where_in,array(),$group_by_in);
    $this->set_karigar_balance_array('in', $ka_chain_karigar_balance);
    
    foreach ($ka_chain_karigar_balance as $index => $value) {
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

  private function get_karigar_balance_dashboard_cards() {
    $where_balance=array('karigar !=' => 'Factory',
                         //'department_name' => array("Hook", "Lobster", "Ball Chain Making", "Chain Making", "Ashish", "Clipping", "Refresh-Repairing"), 
                         'balance != ' => 0);
    
    $group_by_balance=array('group_by'=>'karigar, department_name, hook_kdm_purity');

    $where_daily_drawer_balance=array('(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) != ' => 0,'karigar != ' => 'Factory');
    $group_by_daily_drawer_balance=array('group_by'=>'karigar, hook_kdm_purity',
                                         'having' => 'balance != 0');

    if(!empty($this->data['record']['karigar'])){
      $where_balance['karigar']              = $this->data['record']['karigar'];
      $group_by_balance = array('group_by'=>'hook_kdm_purity');

      $where_daily_drawer_balance['karigar'] = $this->data['record']['karigar'];
      $group_by_daily_drawer_balance=array('group_by'=>'hook_kdm_purity',
                                           'having' => 'balance != 0');
    }
    $this->data['karigar_balances'] = $this->karigar_balance_dashboard_model->get('concat(karigar, " - ", round(hook_kdm_purity,2)) as karigar, 
                                                                                   round(sum(balance), 4) as balance, hook_kdm_purity',
                                                                                   $where_balance, array(), $group_by_balance);

    $this->data['karigar_balances'] = get_records_by_id($this->data['karigar_balances'], 'karigar');

    $karigar_daily_drawer_balances = $this->karigar_balance_dashboard_model->get(
                            'concat(karigar, " - ", round(hook_kdm_purity,2)) as karigar, hook_kdm_purity as in_lot_purity, 
                            round(sum(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out), 4) as balance, hook_kdm_purity',
                            $where_daily_drawer_balance, array(), $group_by_daily_drawer_balance);

    foreach($karigar_daily_drawer_balances as $karigar_daily_drawer_balance) {
      $karigar = $karigar_daily_drawer_balance['karigar'];
      if (!isset($this->data['karigar_balances'][$karigar])) 
        $this->data['karigar_balances'][$karigar] = $karigar_daily_drawer_balance;
      else
        $this->data['karigar_balances'][$karigar]['balance'] += $karigar_daily_drawer_balance['balance'];
    }
  }

  private function get_karigar_total_balance() {
    $where_balance['where']=array('balance != ' => 0);
    $processes_and_departments = '(   
              (product_name = "KA Chain"           and process_name = "Hook Process"           and department_name in ("Hook", "Lobster"))
           or (product_name = "KA Chain"           and process_name = "Ashish Process"         and department_name = "Ashish")   
           or (product_name = "KA Chain"           and process_name = "Clipping Process"       and department_name = "Clipping")   
           or (product_name = "KA Chain"           and process_name = "Dhoom Process"          and department_name = "Chain Making")   
           or (product_name = "KA Chain"           and process_name = "Hook Refresh Process"   and department_name = "Hook")
           or (product_name = "Ball Chain"         and process_name = "Hook Plain Process"     and department_name in ("Hook", "Lobster"))
           or (product_name = "Ball Chain"         and process_name = "Strip Start Process"    and department_name = "Ball Chain Making")
           or (product_name = "Dhoom A"                                                        and department_name = "Chain Making") 
           or (product_name = "Dhoom B"                                                        and department_name = "Chain Making") 
           or (product_name = "Fancy Chain"        and process_name = "Chain Making Process"   and department_name = "Chain Making")
           or (product_name = "Fancy Chain"        and process_name = "Final Process"          and department_name = "Lobster")
           or (                                        process_name = "Vishnu Process"         and department_name ="Vishnu")
           or (product_name = "Nano Process"       and process_name = "Nano Process"           and department_name = "Chain Making")
           or (product_name = "Refresh"            and process_name = "Refresh"                and department_name = "Refresh-Repairing")
           or  (product_name = "Rope Chain"         and process_name = "Final Process"          and department_name = "Hook")
           or (product_name = "Machine Chain"      and process_name = "Final Process"          and department_name in ("Joinning Department", "Hook"))
           or (product_name = "Choco Chain"        and process_name = "Machine Process"        and department_name = "Chain Making")
           or (product_name = "Round Box Chain"    and process_name = "Final Process"          and department_name = "Hook")
           or (product_name = "Sisma Chain"        and process_name in ("Karigar Process","RND Process")           and department_name =  "Chain Making")
           or (product_name = "Sisma Chain"        and process_name in ("Karigar Bom Process","RND Process")           and department_name =  "Chain Making")
           or (product_name = "Imp Italy Chain"    and process_name in ("Chain Making Process", "Spring Process")  and department_name in ("Chain Making","Spring"))
           or (product_name = "Indo tally Chain"   and process_name in ("Chain Making Process", "Spring Process")  and department_name in ("Chain Making","Spring"))
           or (product_name = "Hollow Choco Chain" and process_name in ("Chain Making Process", "Spring Process")  and department_name in ("Chain Making","Spring")))';
    //$processes_and_departments = '(hook_in !=0 or hook_out != 0 or daily_drawer_in_weight != 0 or daily_drawer_out_weight != 0)';
    //$where_balance['where'][$processes_and_departments] = NULL;
    $group_by_total_balance=array('group_by'=>'parent_lot_name,department_name,karigar','order_by'=>'parent_lot_name');
    if(!empty($this->data['record']['karigar'])){
      $where_balance['where']['karigar'] = $this->data['record']['karigar'];
      $group_by_total_balance = array('group_by'=>'parent_lot_name, department_name','order_by'=>'parent_lot_name');
    }
    $chain_wise_balances = $this->karigar_balance_dashboard_model->get('sum(balance) as balance, karigar, parent_lot_name, department_name',
                                                                       $where_balance, array(), $group_by_total_balance);
    $this->set_karigar_total_balance_array('balance', $chain_wise_balances);
    $group_by_total_balance=array('group_by'=>'lot_no,department_name,karigar','order_by'=>'lot_no');
    $chain_wise_balances = $this->karigar_balance_dashboard_model->get('sum(balance) as balance, karigar,lot_no, department_name',$where_balance, array(), $group_by_total_balance);
   
    $this->set_karigar_lot_wise_total_balance_array('balance', $chain_wise_balances);
  } 

   private function get_hook_department_karigar_total_balance() {
    $where_balance['where']=array('balance != ' => 0,'department_name'=>'Hook');
   
    $group_by_total_balance=array('group_by'=>'product_name,in_lot_purity,karigar');
    if(!empty($this->data['record']['karigar'])){
      $where_balance['where']['karigar'] = $this->data['record']['karigar'];
      $group_by_total_balance = array('group_by'=>'product_name,in_lot_purity, karigar');
    }
    $chain_wise_balances = $this->karigar_balance_dashboard_model->get('sum(balance) as balance, karigar, product_name,in_lot_purity',
                                                                       $where_balance, array(), $group_by_total_balance);

    $this->set_hook_department_karigar_balance_array('balance', $chain_wise_balances);
  }

  private function set_karigar_balance_array($in_out, $karigar_balances) {
    if(!empty($karigar_balances)){
      foreach ($karigar_balances as $index => $karigar_balance) {
        
        $karigar_name = $karigar_balance['karigar'];
        $purity = $karigar_balance['in_lot_purity'];      
        $design_code = $karigar_balance['design_code'];
        $lot_no = $karigar_balance['lot_no'];
     
        if (!isset($this->data['karigar_wise_balances'][$karigar_name])) 
          $this->data['karigar_wise_balances'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_wise_balances'][$karigar_name][$lot_no]))
          $this->data['karigar_wise_balances'][$karigar_name][$lot_no] = array();

         if (!isset($this->data['karigar_wise_balances'][$karigar_name][$lot_no][$purity]))
          $this->data['karigar_wise_balances'][$karigar_name][$lot_no][$purity] = array();  
             
        if (!isset($this->data['karigar_wise_balances'][$karigar_name][$lot_no][$purity][$design_code])) 
          $this->data['karigar_wise_balances'][$karigar_name][$lot_no][$purity][$design_code] = array('in' => 0, 'out' => 0);     
        $this->data['karigar_wise_balances'][$karigar_name][$lot_no][$purity][$design_code][$in_out] += $karigar_balance['balance'];
      }
    }
  }
private function set_hook_department_karigar_balance_array($in_out, $karigar_balances) {
    if(!empty($karigar_balances)){
      foreach ($karigar_balances as $index => $karigar_balance) {
        
        $karigar_name = $karigar_balance['karigar'];
        $purity = $karigar_balance['in_lot_purity'];      
        $product_name = $karigar_balance['product_name'];
         if ($karigar_balance['in_lot_purity'] >= 80 && $karigar_balance['in_lot_purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($karigar_balance['in_lot_purity'] < 80)
            $purity = '- 80%';
          elseif ($karigar_balance['in_lot_purity'] == 100)
            $purity = '100%';
          elseif ($karigar_balance['in_lot_purity'] >= 88)
            $purity = '88% +';
        
     
        if (!isset($this->data['hook_department_karigar_wise_balances'][$karigar_name])) 
          $this->data['hook_department_karigar_wise_balances'][$karigar_name] = array(); 

        if (!isset($this->data['hook_department_karigar_wise_balances'][$karigar_name][$product_name]))
          $this->data['hook_department_karigar_wise_balances'][$karigar_name][$product_name] = array();

         if (!isset($this->data['hook_department_karigar_wise_balances'][$karigar_name][$product_name][$purity])) 
          $this->data['hook_department_karigar_wise_balances'][$karigar_name][$product_name][$purity] = array('balance' => 0);     
        $this->data['hook_department_karigar_wise_balances'][$karigar_name][$product_name][$purity][$in_out] += $karigar_balance['balance'];
      }
    }
  }


  private function set_karigar_total_balance_array($in_out, $karigar_balances) {
    if(!empty($karigar_balances)){
      foreach ($karigar_balances as $index => $karigar_balance) {
        
        $karigar_name = $karigar_balance['karigar'];
        if (HOST=='ARF')
          $parent_lot_name = $karigar_balance['department_name'];
        else
          $parent_lot_name = $karigar_balance['parent_lot_name'];
     
        if (!isset($this->data['total_karigar_wise_balances'][$karigar_name])) 
          $this->data['total_karigar_wise_balances'][$karigar_name] = array(); 

        if (!isset($this->data['total_karigar_wise_balances'][$karigar_name][$parent_lot_name]))
          $this->data['total_karigar_wise_balances'][$karigar_name][$parent_lot_name] = array();
    
          $this->data['total_karigar_wise_balances'][$karigar_name][$parent_lot_name]= array('balance' => 0,'department_name'=>'');     
        $this->data['total_karigar_wise_balances'][$karigar_name][$parent_lot_name][$in_out] += $karigar_balance['balance'];
        $this->data['total_karigar_wise_balances'][$karigar_name][$parent_lot_name]['department_name']= $karigar_balance['department_name'];
      }
    }
  }
  private function set_karigar_lot_wise_total_balance_array($in_out, $karigar_balances) {
    if(!empty($karigar_balances)){
      foreach ($karigar_balances as $index => $karigar_balance) {
        
        $karigar_name = $karigar_balance['karigar'];
        $lot_no = $karigar_balance['lot_no'];
     
        if (!isset($this->data['total_karigar_lot_wise_balances'][$karigar_name])) 
          $this->data['total_karigar_lot_wise_balances'][$karigar_name] = array(); 

        if (!isset($this->data['total_karigar_lot_wise_balances'][$karigar_name][$lot_no]))
          $this->data['total_karigar_lot_wise_balances'][$karigar_name][$lot_no] = array();
    
          $this->data['total_karigar_lot_wise_balances'][$karigar_name][$lot_no]= array('balance' => 0,'department_name'=>'');     
        $this->data['total_karigar_lot_wise_balances'][$karigar_name][$lot_no][$in_out] += $karigar_balance['balance'];
        $this->data['total_karigar_lot_wise_balances'][$karigar_name][$lot_no]['department_name']= $karigar_balance['department_name'];
      }
    }
  }
  private function wastage_records(){
    $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar, 
                                                   process_name as daily_drawer_type',
                                                   array('daily_drawer_in_weight != '=>0,
                                                         'type != ' => 'GPC Powder'), array(),
                                                   array('group_by'=>'hook_kdm_purity, karigar, process_name'));
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar,
                                                          daily_drawer_type',
                                                          array('where'=>array('hook_in != ' => 0),
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'daily_drawer_out_weight != ' => 0)),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar,daily_drawer_type'));

    $this->set_daily_drawer_array('out', $daily_drawer_outs);
    $daily_drawer_box_weights = $this->box_weight_model->get('sum(weight) as weight,
                                                          FORMAT(purity,4) as hook_kdm_purity,
                                                          karigar,
                                                          daily_drawer_type',
                                                          array('where'=>array('weight  >' => 0)),
                                                          array(),
                                                          array('group_by'=>'purity,karigar,daily_drawer_type'));
    $this->set_daily_drawer_array('box_weight', $daily_drawer_box_weights);
  }  

  
  private function set_daily_drawer_array($in_out, $daily_drawers) {
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        
        $karigar_name = $daily_drawer['karigar'];
        
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
          if ($karigar_name == 'Factory' && $daily_drawer_type != 'Hook' 
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

        if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
          $this->data['karigar_daily_drawers'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity]))
          $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array();  
             
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type])) 
          $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type] = array('in' => 0, 'out' => 0,'box_weight'=>0,'gpc_powder_out'=>0);     
        $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type][$in_out] += $daily_drawer['weight'];
      }
    }
  }
  
}