<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purity_wise_balance_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model'));
  }

  public function index(){
  	$process_balances = $this->process_model->get('round(in_lot_purity) as purity,sum(balance) as balance,sum(balance_gross) as balance_gross,sum(balance_fine) as balance_fine',array('balance!='=>0),array(),array('order_by'=>'in_lot_purity,in_purity','group_by'=>'round(in_lot_purity,0)'));
    $this->set_purity_wise_array($process_balances,'process_balance');

  	$melting_wastage_balances = $this->process_model->get('wastage_lot_purity as purity,SUM(balance_melting_wastage) AS balance,SUM(balance_melting_wastage) AS balance_gross,(balance_melting_wastage * wastage_lot_purity/100) AS balance_fine',array('round(balance_melting_wastage,4) > 0'=>NULL,'wastage_purity > 0'=>NULL,'wastage_lot_purity > 0'=>NULL,'product_name not in("Chain Receipt","Rhodium Receipt","Hallmark Receipt") and department_name not in("Fancy Out")'=>NULL),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
//    lq();
    //pd($this->data['record']['melting_wastage_balances']);
    $this->set_purity_wise_array($melting_wastage_balances,'melting_wastage');

	  $daily_drawer_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_daily_drawer_wastage) as balance,
      sum(balance_daily_drawer_wastage * wastage_purity / 100) as balance_gross,
      sum(balance_daily_drawer_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine',array('balance_daily_drawer_wastage!='=>0),array(),array('group_by'=>'round(wastage_lot_purity,0)'));

    $this->set_purity_wise_array($daily_drawer_balances,'daily_drawer_wastage');

    $hcl_wastage_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_hcl_wastage) as balance,
      sum(balance_hcl_wastage * wastage_purity / 100) as balance_gross,
      sum(balance_hcl_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine ',array('balance_hcl_wastage!='=>0,"parent_lot_name!="=>""),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
    $this->set_purity_wise_array($hcl_wastage_balances,'hcl_wastage');
   
    $hcl_ghiss_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_hcl_ghiss) as balance,
      sum(balance_hcl_ghiss * wastage_purity / 100) as balance_gross,
      sum(balance_hcl_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine ',array('balance_hcl_ghiss!='=>0),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
    $this->set_purity_wise_array($hcl_ghiss_balances,'hcl_ghiss');

    $ghiss_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_ghiss) as balance,
      sum(balance_ghiss * wastage_purity / 100) as balance_gross,
      sum(balance_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine ',array('balance_ghiss!='=>0),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
    $this->set_purity_wise_array($ghiss_balances,'ghiss');

    $pending_ghiss_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_pending_ghiss) as balance,
      sum(balance_pending_ghiss * wastage_purity / 100) as balance_gross,
      sum(balance_pending_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine ',array('balance_pending_ghiss!='=>0),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
    $this->set_purity_wise_array($pending_ghiss_balances,'pending_ghiss');

    $loss_balances = $this->process_model->get('wastage_lot_purity as purity,sum(balance_loss) as balance,
      sum(balance_loss * wastage_purity / 100) as balance_gross,
      sum(balance_loss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine ',array('balance_loss!='=>0),array(),array('group_by'=>'round(wastage_lot_purity,0)'));
    $this->set_purity_wise_array($loss_balances,'loss');

    $daily_drawer_in = $this->process_model->get('sum(daily_drawer_in_weight) as balance, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar',
                                                   array('where'=>array('daily_drawer_in_weight != '=>0,'karigar != '=>'','product_name != '=>'Fancy Chain','type != ' => 'GPC Powder'),'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"',      '"ARF Software"', '"ARF Software '.HOSTVERSION.'"',      '"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))), array(),
                                                   array('group_by'=>'hook_kdm_purity'));
    $this->set_daily_drawer_array('in',$daily_drawer_in);
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as balance,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar',
                                                          array('where'=>array('hook_in != ' => 0,'daily_drawer_type!='=>'','karigar!='=>''),
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'chain_name != '=>'Fancy Chain',
                                                                                  'daily_drawer_out_weight != ' => 0),
                                                                'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"','"ARF Software"', '"ARF Software '.HOSTVERSION.'"','"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,daily_drawer_type,karigar'));

    $this->set_daily_drawer_array('out',$daily_drawer_outs);

    $gpc_out_details = $this->process_model->get('out_lot_purity as purity,sum(`balance_gpc_out`) as balance,sum(balance_gpc_out) balance_gross ,(balance_gpc_out*out_lot_purity/100) as balance_fine',array('`out_purity` > 0'=>NULL,'out_lot_purity > 0' => NULL,'balance_gpc_out!='=>0,'finish_good='=>0),array(),array('group_by'=>'round(out_lot_purity,3)'));
//	pd($gpc_out_details);    
$this->set_purity_wise_array($gpc_out_details,'gpc_out');
	//pd($this->data);
    $this->load->render('reports/purity_wise_balance_reports/view', $this->data);
  } 

  private function set_purity_wise_array($records,$wastage_type) {

    if(!empty($records)){
      foreach ($records as $index => $record) {
          if ($record['purity'] >= 30 && $record['purity'] < 40) 
            $purity = '30% - 40%';
          elseif ($record['purity'] >= 40 && $record['purity'] < 50) 
            $purity = '40% - 50%';
          elseif ($record['purity'] >= 50 && $record['purity'] < 60) 
            $purity = '50% - 60%';
          elseif ($record['purity'] >= 60 && $record['purity'] < 70)
            $purity = '60% - 70%';
          elseif ($record['purity'] >= 70 && $record['purity'] < 80)
            $purity = '70% - 80%';
          elseif ($record['purity'] >= 80 && $record['purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($record['purity'] >= 88 && $record['purity'] <= 99)
            $purity = '88% +';
          elseif ($record['purity'] == 100)
            $purity = '100%';
        if (!isset($this->data[$wastage_type.'_detail'][$purity])) 
          $this->data[$wastage_type.'_detail'][$purity] = array('balance'=>0,'balance_gross'=>0,'balance_fine'=>0); 

        $this->data[$wastage_type.'_detail'][$purity]['balance'] += $record['balance'];
        $this->data[$wastage_type.'_detail'][$purity]['balance_gross'] += $record['balance_gross'];
        $this->data[$wastage_type.'_detail'][$purity]['balance_fine'] += $record['balance_fine'];
      }
    }
  }
  private function set_daily_drawer_array($in_out, $daily_drawers) {
    
//    $karigar_names=$this->process_model->get('karigar',array('product_name'=>'Fancy Chain'),array(),array('group_by'=>'karigar'));
    
  //  $excluded_karigar_names=array_column($karigar_names,'karigar');
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
    //    if(!in_array($daily_drawer['karigar'], $excluded_karigar_names)){
          $purity = $daily_drawer['hook_kdm_purity'];
          if ($purity >= 30 && $purity < 40) 
          $purity = '30% - 40%';
          elseif ($purity >= 40 && $purity < 50) 
            $purity = '40% - 50%';
          elseif ($purity >= 50 && $purity < 60) 
            $purity = '50% - 60%';
          elseif ($purity >= 60 && $purity < 70)
            $purity = '60% - 70%';
          elseif ($purity >= 70 && $purity < 80)
            $purity = '70% - 80%';
          elseif ($purity >= 80 && $purity < 88) 
            $purity = '80% - 88%';
          elseif ($purity >= 88 && $purity <= 99.99)
            $purity = '88% +';
          elseif ($purity == 100)
            $purity = '100%';
	if($purity!=0){
        if (!isset($this->data['karigar_daily_drawers'][$purity])) 
          $this->data['karigar_daily_drawers'][$purity]= array('in' => 0, 'out' => 0);     
        $this->data['karigar_daily_drawers'][$purity][$in_out] += $daily_drawer['balance'];
      }  }  }
  }
}
