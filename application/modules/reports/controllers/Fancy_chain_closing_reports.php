<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fancy_chain_closing_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model'));
  }

  public function index() {
    $this->data['record']['in_lot_purity'] = (!empty($_GET['in_purity'])) ? $_GET['in_purity'] : '';
    $this->data['purities'] = array(array('name' => '100',       'id' => '100'),
                                    array('name' => '88%  >',    'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.65'),
                                    array('name' => '80% - 85%', 'id' => '83.65'),
                                    array('name' => '< 80%',     'id' => '75.15'));
    $in_where=$hook_in_where='';

    $group_by=array('group_by'=>'hook_kdm_purity,karigar');
    $hook_in_where='hook_kdm_purity!=0 and';
   if(!empty($this->data['record']['in_lot_purity'])) {
    $group_by='karigar,hook_kdm_purity';
    $hook_in_where='';
      if ($this->data['record']['in_lot_purity'] == '83.65') {
        $in_where      .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)' ;
        $hook_in_where .= '  (hook_kdm_purity >= 80 and hook_kdm_purity < 85) and ' ;
      } elseif ($this->data['record']['in_lot_purity'] == '87.65') {
        $in_where.=' and (processes.in_lot_purity >= 85 and processes.in_lot_purity < 88)' ;
        $hook_in_where .= '  (hook_kdm_purity >= 85 and hook_kdm_purity < 88) and ' ;
      } elseif ($this->data['record']['in_lot_purity'] == '75.15') {
        $in_where.=' and processes.in_lot_purity < 80 ' ;
        $hook_in_where .= '  hook_kdm_purity < 80 and' ;
      } elseif ($this->data['record']['in_lot_purity'] == '100') {
        $in_where.=' and processes.in_lot_purity = 100' ;
        $hook_in_where .= '  hook_kdm_purity = 100 and' ;
      } else {
        $in_where      .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)' ;
        $hook_in_where .= '  (hook_kdm_purity >= 88 and hook_kdm_purity < 100) and' ;
      }
    }  
   $this->data['fancy_hold_details'] = $this->process_model->get('sum(balance) as balance,sum(balance_gross) as balance_gross,sum(balance_fine) as balance_fine,in_lot_purity',array('product_name in ("Fancy Chain","Fancy 75 Chain") and process_name="Fancy Hold Process" '.$in_where.''=>NULL,'balance!='=>0), array(),
                                                   array('group_by'=>'in_lot_purity'));
   $this->data['fancy_chain_making_details'] = $this->process_model->get('sum(balance) as balance,sum(balance_gross) as balance_gross,sum(balance_fine) as balance_fine,in_lot_purity',array('product_name in ("Fancy Chain","Fancy 75 Chain") and process_name="Chain Making Process" '.$in_where.''=>NULL,'balance!='=>0), array(),
                                                   array('group_by'=>'in_lot_purity'));
   $this->data['fancy_chain_making_75_details'] = $this->process_model->get('sum(balance) as balance,sum(balance_gross) as balance_gross,sum(balance_fine) as balance_fine,in_lot_purity',array('product_name in ("Fancy Chain","Fancy 75 Chain") and process_name="Chain Making 75 Process" '.$in_where.''=>NULL,'balance!='=>0), array(),array('group_by'=>'in_lot_purity'));

    $karigar_names=$this->process_model->get('karigar',array('product_name in ("Fancy Chain","Fancy 75 Chain")'=>NULL,'karigar!=""'=>NULL),array(),array('group_by'=>'karigar'));
    $excluded_karigar_names=array_column($karigar_names,'karigar');
   $daily_drawer_ins =$this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar',
                                                   array('where'=>array(''.$hook_in_where.' daily_drawer_in_weight !=0 '=>NULL,
                                                         'type != ' => 'GPC Powder'),
                                                   'where_in'=>array('karigar' =>array('"'.implode('", "', $excluded_karigar_names).'"'),)), array(),$group_by);


    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar',
                                                          array('where'=>array(''.$hook_in_where.' (hook_in != 0' => NULL),
                                                                'or_where'=>array('hook_out != ' =>0,        'daily_drawer_out_weight != 0)' => NULL),
                                                                'where_in'=>array('karigar' =>array('"'.implode('", "', $excluded_karigar_names).'"'),)), array(),$group_by);
    $this->set_daily_drawer_array('out', $daily_drawer_outs);
    parent::view(1);
    
  }

  private function set_daily_drawer_array($in_out, $daily_drawers) {
     if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
          $purity = $daily_drawer['hook_kdm_purity'];
        if (!isset($this->data['daily_drawers'][$purity])) 
        $this->data['daily_drawers'][$purity]= array('in' => 0, 'out' => 0);
        $this->data['daily_drawers'][$purity][$in_out] += $daily_drawer['weight'];
      }
    }
  }
}