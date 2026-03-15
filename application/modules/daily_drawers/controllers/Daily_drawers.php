<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawers extends BaseController {	
	public function __construct(){
		 $this->load->model(array('processes/process_model', 'processes/process_field_model','issue_departments/issue_department_model',
                              'daily_drawers/daily_drawer_receipt_model'));
    parent::__construct();
  }  

  public function index() { 
    $this->get_purity_group_wise_wastages();
    //$this->get_cutting_daily_drawer_wastages();
    $this->get_fancy_chain_daily_drawer_wastages();
    $this->get_other_daily_drawer_wastages();
    $this->get_tone_wise_wastages();
    $this->get_office_outside_details();
    $this->get_ghiss_records();
    $this->get_gpc_powder_records();
    $this->get_tounch_out_records();
    $this->get_solder_wastage_records();
    $this->data['column'] = (isset($_GET['column']) ? $_GET['column'] : '');

    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('daily_drawers/daily_drawers/index',$this->data);    
  }

  private function get_purity_group_wise_wastages() {
    $purity_groups = array('100'   => '100', 
                           '92.00' => '88% >',
                           '87.65' => '86% - 88%',
                           '83.65' => '80% - 85%',
                           '75.15' => '< 80%');
    
    $processes_and_departments ='';
    foreach ($purity_groups as $purity => $purity_display_range) {
      if($purity!=100){
        if (HOST == 'ARF') 
          $where = array('product_name != ' => 'Fancy Chain',
                         'process_name not like ' => 'Pipe and Para%');
        else 
          $where = array('department_name' => 'Hook');
      }
   

      if ($purity == '83.65') {
        $where['hook_kdm_purity >'] = '80';
        $where['hook_kdm_purity <'] = '85';
      }elseif ($purity == '87.65') {
        $where['hook_kdm_purity >'] = '86';
        $where['hook_kdm_purity <'] = '88';
      }elseif ($purity == '75.15') {
        $where['hook_kdm_purity <'] = '80';
      }elseif ($purity == '100') {
        $where['hook_kdm_purity '] = '100';
      } else {
        $where['hook_kdm_purity >'] = '88';
        $where['hook_kdm_purity <'] = '100';
      }
      
      $this->data['wastages'][$purity]=$this->process_model->find('"'.$purity_display_range.'" as purity_group,
                                                                 sum(daily_drawer_wastage) as in_weight,
                                                                 sum(out_daily_drawer_wastage ) as out_weight,
                                                                 sum(issue_daily_drawer_wastage ) as issue_weight,
                                                                 sum(balance_daily_drawer_wastage) as balance,
                                                                 sum(balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine',
                                                                 $where);

      $this->data['wastages'][$purity]['hook_kdm_purity'] = $purity;
    }
  }

  private function get_other_daily_drawer_wastages() {
    if (HOST == 'ARF') {
      $this->data['other_daily_drawer_wastages'] = array();
      return true;
    }

    $purity_groups = array('92.00'=>'88% >',
                           '87.65'=>'86% - 88%',
                           '83.65'=>'80% - 85%',
                           '75.15'=>'< 80%');
    
    foreach ($purity_groups as $purity => $purity_display_range) {
      $where = array('department_name != ' => 'Hook');

      if ($purity == '83.65') {
        $where['hook_kdm_purity >'] = '80';
        $where['hook_kdm_purity <'] = '85';
      }elseif ($purity == '87.65') {
        $where['hook_kdm_purity >'] = '86';
        $where['hook_kdm_purity <'] = '88';
      }elseif ($purity == '75.15') {
        $where['hook_kdm_purity <'] = '80';
      }elseif ($purity == '100') {
        $where['hook_kdm_purity '] = '100';
      } else {
        $where['hook_kdm_purity >'] = '88';
        $where['hook_kdm_purity <'] = '100';

      } 
      $this->data['other_daily_drawer_wastages'][$purity] = $this->process_model->find('"'.$purity_display_range.'" as purity_group,
                                                                 sum(daily_drawer_wastage) as in_weight,
                                                                 sum(out_daily_drawer_wastage ) as out_weight,
                                                                 sum(issue_daily_drawer_wastage ) as issue_weight,
                                                                 sum(balance_daily_drawer_wastage) as balance,
                                                                 sum(balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine',
                                                                 $where);
      $this->data['other_daily_drawer_wastages'][$purity]['hook_kdm_purity'] = $purity;
    }
  }

  private function get_fancy_chain_daily_drawer_wastages() {
    if (HOST != 'ARF') $this->data['fancy_chain_daily_drawer_wastages'] = array();

    $purity_groups = array('92.00'=>'88% >',
                           '87.65'=>'86% - 88%',
                           '83.65'=>'80% - 85%',
                           '75.15'=>'< 80%');
    
    foreach ($purity_groups as $purity => $purity_display_range) {
    
      $processes_and_departments = '(   product_name = "Fancy Chain"
                                     or (product_name = "Office Outside" and process_name like "Pipe and Para%"))';
      $where = array($processes_and_departments => NULL);

      if ($purity == '83.65') {
        $where['hook_kdm_purity >'] = '80';
        $where['hook_kdm_purity <'] = '85';
      }elseif ($purity == '87.65') {
        $where['hook_kdm_purity >'] = '86';
        $where['hook_kdm_purity <'] = '88';
      }elseif ($purity == '75.15') {
        $where['hook_kdm_purity <'] = '80';
      }elseif ($purity == '100') {
        $where['hook_kdm_purity '] = '100';
      } else {
        $where['hook_kdm_purity >'] = '88';
        $where['hook_kdm_purity <'] = '100';

      } 
      $this->data['fancy_chain_daily_drawer_wastages'][$purity] = $this->process_model->find('"'.$purity_display_range.'" as purity_group,
                                                                 sum(daily_drawer_wastage) as in_weight,
                                                                 sum(out_daily_drawer_wastage ) as out_weight,
                                                                 sum(issue_daily_drawer_wastage ) as issue_weight,
                                                                 sum(balance_daily_drawer_wastage) as balance,
                                                                 sum(balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine',
                                                                 $where);
      $this->data['fancy_chain_daily_drawer_wastages'][$purity]['hook_kdm_purity'] = $purity;
    }
  }

  private function get_tone_wise_wastages() {
    $tones=array('yellow'=>'yellow' ,'pink'=>'pink','other'=>'');

    foreach ($tones as $tone_index => $tone) {
      $this->data['tone_wastages'][$tone_index]=$this->process_model->find('
                                                                sum(daily_drawer_wastage) as in_weight,
                                                                sum(out_daily_drawer_wastage ) as out_weight,
                                                                sum(issue_daily_drawer_wastage ) as issue_weight,
                                                                sum(balance_daily_drawer_wastage) as balance,
                                                                sum(balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine,tone,hook_kdm_purity',
                                                                array('tone'=>$tone,
                                                                      'hook_kdm_purity'=>75.15),
                                                                array(),
                                                                array('group_by'=>'tone,hook_kdm_purity'));
    }  
  }

  private function get_office_outside_details(){
    $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   process_name as daily_drawer_type',
                                                   array('daily_drawer_in_weight != ' => 0,
                                                         'type != ' => 'GPC Powder'), array(),
                                                   array('group_by'=>'hook_kdm_purity, process_name','order_by'=>'hook_kdm_purity desc'));
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          daily_drawer_type',
                                                          array('where'=>array('hook_in  != ' => 0),
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'daily_drawer_out_weight != ' => 0)),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,daily_drawer_type','order_by'=>'hook_kdm_purity desc'));
    $this->set_daily_drawer_array('out', $daily_drawer_outs);
  } 

  private function get_ghiss_records(){
    $this->data['ghiss_reports']=$this->process_model->find('sum(ghiss) as in_weight,
                                                             sum(out_ghiss) as out_weight,
                                                             sum(balance_ghiss) as balance,sum(ghiss * out_purity / 100) as balance_gross,
                                                             sum(balance_ghiss * out_purity / 100 * out_lot_purity / 100) as balance_fine');
  }

  private function get_gpc_powder_records() {
     $gpc_powder_out=$this->issue_department_model->find('sum(in_weight) as out_weight',array('product_name'=>'GPC Powder'))['out_weight'];
     if(!empty($gpc_powder_out)){
      $this->data['gpc_powder_reports']=$this->process_model->find('sum(daily_drawer_in_weight) as in_weight,
                                                               ('.$gpc_powder_out.') as out_weight,
                                                               sum(daily_drawer_in_weight)-'.$gpc_powder_out.' as balance, (sum(daily_drawer_in_weight)-'.$gpc_powder_out.' * out_purity / 100) as balance_gross,(sum(daily_drawer_in_weight)-'.$gpc_powder_out.') * out_purity / 100 * out_lot_purity / 100 as balance_fine',array('type'=>'GPC Powder'));
     
    }else{
       $this->data['gpc_powder_reports']=$this->process_model->find('sum(daily_drawer_in_weight) as in_weight,
                                                               sum(daily_drawer_out_weight) as out_weight,
                                                               sum(daily_drawer_in_weight-daily_drawer_out_weight) as balance,sum((daily_drawer_in_weight-daily_drawer_out_weight) * out_purity / 100) as balance_gross,
                                                               sum((daily_drawer_in_weight-daily_drawer_out_weight) * out_purity / 100 * out_lot_purity / 100) as balance_fine',array('type'=>'GPC Powder'));
    }
     
  }

    private function get_tounch_out_records(){
      $this->data['tounch_out_reports']=$this->process_model->find('sum(tounch_out) as in_weight,
                                                                    sum(out_tounch_out) as out_weight,
                                                                    sum(balance_tounch_out) as balance,
                                                                    sum(balance_tounch_out) as balance_gross,
                                                                    sum(balance_tounch_out * tounch_purity / 100) as balance_fine');
    }

    private function get_solder_wastage_records(){
      $this->data['solder_wastage_reports']=$this->process_model->find('sum(solder_wastage) as in_weight,
                                                                    sum(out_solder_wastage) as out_weight,
                                                                    sum(balance_solder_wastage) as balance,
                                                                    sum(balance_solder_wastage) as balance_gross,
                                                                    0 as balance_fine');
    }

    private function set_daily_drawer_array($in_out, $daily_drawers) {
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        $purity = $daily_drawer['hook_kdm_purity'];      
        $daily_drawer_type = $daily_drawer['daily_drawer_type'];
        if ($daily_drawer_type == 'Solid Wire') $daily_drawer_type = 'Hook';
        if ($daily_drawer_type == 'Hard Wire')  $daily_drawer_type = 'Hook';
        if (!isset($this->data['daily_drawers'][$purity]))
          $this->data['daily_drawers'][$purity] = array();  
             
        if (!isset($this->data['daily_drawers'][$purity][$daily_drawer_type])) 
          $this->data['daily_drawers'][$purity][$daily_drawer_type] = array('in' => 0, 'out' => 0);     
        $this->data['daily_drawers'][$purity][$daily_drawer_type][$in_out] += $daily_drawer['weight'];
      }
    }
  }
}