<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_wise_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model'));
  }

  public function index() {

  if($_GET['type']=='arc_chain_casting') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('updated_at,product_name,process_name,department_name ,lot_no,balance,balance_gross,balance_fine,melting_wastage',array('product_name in ("Arc 92 Chain","Arc 75 Chain") and (department_name in ("Melting Start", "Melting","Casting"))'=>NULL,'balance!='=>0));

  }

  if($_GET['type']=='arc_chains') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('
    updated_at,product_name,department_name,process_name,lot_no,(balance) balance,(balance_gross) balance_gross ,(balance_fine) balance_fine,melting_wastage,melting_lot_category_one,melting_lot_category_two',array('product_name in ("Arc Chain") and (melting_lot_category_one in ("SUMO CHAIN","INTERNAL CHAIN","CHAIN","AQUA GOLD","SPRING KADA","SUMO BRC","SUMO BANGELES"))'=>NULL,'balance!='=>0));
  }

  if($_GET['type']=='arc_ornament_casting') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('
    updated_at,product_name,department_name,process_name,lot_no,(balance) balance,(balance_gross) balance_gross ,(balance_fine) balance_fine,melting_wastage',array('product_name in ("Arc 92 Ornament","Arc 75 Ornament") and (department_name in ("Melting Start", "Melting","Casting"))'=>NULL,'balance!='=>0));
  }

  if($_GET['type']=='arc_ornament') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('
    updated_at,product_name,process_name,department_name,lot_no,(balance) balance,(balance_gross) balance_gross ,(balance_fine) balance_fine,melting_wastage,melting_lot_category_one,melting_lot_category_two',array('product_name in ("Arc Ornament","Arc Chain") and (melting_lot_category_one in ("RING","RINGS","TRUMP COLLECTIONS","PENDANTS","BRACELETS","CHAIN SETS","KADA","CNC PENDENT SET","LARIATES","NECKLACES","TOPS"))'=>NULL,'balance!='=>0));
  }

  if($_GET['type']=='arc_kuwaitis') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('
    updated_at,product_name,process_name,department_name,lot_no,melting_wastage,(balance) balance,(balance_gross) balance_gross ,(balance_fine) balance_fine,melting_wastage,melting_lot_category_one,melting_lot_category_two',array('product_name in ("Arc Kuwaiti") and (melting_lot_category_one in ("KUWAITI"))'=>NULL,'balance!='=>0));
  }

  if($_GET['type']=='arc_balance_melting_wastage') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('updated_at,product_name,process_name,lot_no,balance_melting_wastage,(balance_melting_wastage) balance,(balance_melting_wastage) balance_gross ,(balance_melting_wastage * out_lot_purity / 100) balance_fine',array('product_name not in ("Rhodium Receipt","Receipt")'=>NULL,'balance_melting_wastage !='=>0));
  }

  if($_GET['type']=='lock_process') {
  $lock_process = $this->process_model->get('updated_at,product_name,process_name,lot_no,balance,balance_gross,balance_fine,melting_wastage',array('product_name in ("Lock Process")'=>NULL,'balance!='=>0));

  $lock_process_in_weight=$this->process_model->get('sum(daily_drawer_in_weight) as in_weight,0 as out_weight,lot_no,melting_wastage
                                                    ,updated_at,product_name,process_name,lot_no,hook_kdm_purity' ,
                                                   array('where'=>array('(daily_drawer_in_weight!=0)'=>NULL,
                                                                        'type != ' => 'GPC Powder',
                                                                        'karigar'=>"Model")),array(),
                                                   array('group_by'=>'product_name,lot_no,updated_at,hook_kdm_purity'));


  $lock_process_out_weight=$this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as out_weight,0 as in_weight,updated_at,product_name as product_name,melting_wastage,lot_no,hook_kdm_purity', array('where'=>array('(hook_in-hook_out+daily_drawer_out_weight)!='=>0,'chain_name != '=>'Fancy Chain',
                                                                               'karigar'=>"Model")),array(),array('group_by'=>'chain_name,lot_no,updated_at,hook_kdm_purity'));
  $lock_process_total=array_merge($lock_process_in_weight,$lock_process_out_weight, $lock_process);
  $this->data['process_wise_dashboard_listing']=$lock_process_total;
  }
    
  if($_GET['type']=='pure_metal') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('updated_at,product_name,process_name,lot_no,balance_melting_wastage,(balance_melting_wastage) balance,(balance_melting_wastage) balance_gross ,(balance_melting_wastage * out_lot_purity / 100) balance_fine',array('product_name in ("Receipt") and process_name in ("Receipt")'=>NULL,'balance_melting_wastage !='=>0));
  }
  if($_GET['type']=='other') {
  $this->data['process_wise_dashboard_listing'] = $this->process_model->get('
    updated_at,product_name,process_name,lot_no,melting_wastage,(balance) balance,(balance_gross) balance_gross ,(balance_fine) balance_fine',array('product_name not in ("Chain 92","Chain 75","Ring","Pendant","Ring 75","Pendant 75","Casting RND","Lock Process","Kuwaitis","Stone Transfer","Arc Chain","Arc 75 Chain","Arc 92 Chain","Arc Ornament","Arc 92 Ornament","Arc 75 Ornament","Arc Kuwaiti","Arc 92 Kuwaiti","Arc 75 Kuwaiti")'=>NULL,'balance!='=>0));
  }  
  if($_GET['type']=='casting_rnd') {

  $casting_rnd_total = $this->process_model->get('updated_at,product_name,process_name,department_name,lot_no,0 as in_weight,0 as out_weight,0 as balance_fine,0 as balance_gross,0 as out_balance_fine,balance as casting_rnd_balance,balance_gross as casting_rnd_balance_gross,balance_fine as casting_rnd_balance_fine,lot_no,melting_wastage',array('product_name in ("Casting RND")'=>NULL,'balance!='=>0));
  $rnd_issue_total=array();
  $rnd_receipt_total=array();
  $rnd_issue_total=$this->process_model->get('product_name,process_name,department_name,updated_at,lot_no,out_weight as out_weight,
                                                 out_weight as balance,
                                                 (out_weight * out_lot_purity/100) as out_balance_fine',
                                                array('product_name' => 'RND', 'process_name' => 'RND Issue'));
  $rnd_receipt_total=$this->process_model->get('product_name,process_name,department_name,updated_at,lot_no,out_weight as in_weight,
                                                 out_weight as balance,
                                                 (out_weight * out_lot_purity/100) as balance_fine',
                                                array('product_name' => 'RND', 'process_name' => 'RND Receipt'));
  $rnd_total=array_merge($rnd_issue_total,$rnd_receipt_total,$casting_rnd_total);

  $total_rnd_balance=array();
  foreach($rnd_total as $index => $rnd){
    $total_rnd_balance[$rnd['updated_at']]['updated_at']=$rnd['updated_at'];
    $total_rnd_balance[$rnd['updated_at']]['balance']=(!empty($rnd['in_weight'])?$rnd['in_weight']:'0')-(!empty($rnd['out_weight'])?$rnd['out_weight']:'0')+$rnd['casting_rnd_balance'];
    $total_rnd_balance[$rnd['updated_at']]['balance_gross']=(!empty($rnd['in_weight'])?$rnd['in_weight']:'0')-(!empty($rnd['out_weight'])?$rnd['out_weight']:'0')+$rnd['casting_rnd_balance_gross'];
    $total_rnd_balance[$rnd['updated_at']]['lot_no']=(!empty($rnd['lot_no'])?$rnd['lot_no']:'-');
    $total_rnd_balance[$rnd['updated_at']]['product_name']=(!empty($rnd['product_name'])?$rnd['product_name']:'-');
    $total_rnd_balance[$rnd['updated_at']]['process_name']=(!empty($rnd['process_name'])?$rnd['process_name']:'-');
    $total_rnd_balance[$rnd['updated_at']]['balance_fine']=(!empty($rnd['balance_fine'])?$rnd['balance_fine']:'0')-(!empty($rnd['out_balance_fine'])?$rnd['out_balance_fine']:'0')+$rnd['casting_rnd_balance_fine'];
    $total_rnd_balance[$rnd['updated_at']]['melting_wastage']=(!empty($rnd['melting_wastage'])?$rnd['melting_wastage']:'-');
    $rnd_total[$index]['balance']=($rnd['in_weight']-$rnd['out_weight']+$rnd['casting_rnd_balance']);
    $rnd_total[$index]['balance_gross']=($rnd['in_weight']-$rnd['out_weight']+$rnd['casting_rnd_balance_gross']);
    $rnd_total[$index]['balance_fine']=($rnd['balance_fine']-$rnd['out_balance_fine']+$rnd['casting_rnd_balance_fine']);
  }
  $this->data['process_wise_dashboard_listing']=$rnd_total;
  } 
  if($_GET['type']=='daily_drawer_92') {
    $daily_drawer_in_92 = $this->process_model->get('sum(daily_drawer_in_weight) as in_weight,0 as out_weight,lot_no,
                                                    ,updated_at,product_name,process_name,lot_no,hook_kdm_purity' ,
                                                   array('where'=>array('(hook_kdm_purity>90 and hook_kdm_purity<93)'=>NULL,'(daily_drawer_in_weight!=0)'=>NULL,
                                                                        'type != ' => 'GPC Powder',
                                                                        'karigar'=>"Factory")),array(),
                                                   array('group_by'=>'product_name,lot_no,updated_at,hook_kdm_purity'));

    $daily_drawer_out_92=$this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as out_weight,0 as in_weight,updated_at,chain_name as product_name,lot_no,hook_kdm_purity',
                                                          array('where'=>array('(hook_in-hook_out+daily_drawer_out_weight)!='=>0,'(hook_kdm_purity>90 and hook_kdm_purity<93)'=>NULL,'chain_name != '=>'Fancy Chain',
                                                                               'karigar'=>"Factory")),array(),array('group_by'=>'chain_name,lot_no,updated_at,hook_kdm_purity'));

    $this->data['process_wise_dashboard_listing'] =array_merge($daily_drawer_in_92,$daily_drawer_out_92);

  }
  if($_GET['type']=='daily_drawer_75') {
    $daily_drawer_in_75 = $this->process_model->get('sum(daily_drawer_in_weight) as in_weight,0 as out_weight, updated_at,product_name as product_name,lot_no,hook_kdm_purity' ,
                                                   array('where'=>array('daily_drawer_in_weight != '=>0,
                                                                        'product_name != '=>'Fancy Chain',
                                                                        '(hook_kdm_purity>70 and hook_kdm_purity<76)'=>NULL,
                                                                        'type != ' => 'GPC Powder',
                                                                        'karigar'=>"Factory")),array(),array('group_by'=>'product_name,lot_no,updated_at,hook_kdm_purity'));
    
    $daily_drawer_out_75=$this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as out_weight,0 as in_weight,updated_at,chain_name as product_name,lot_no,hook_kdm_purity',
                                                          array('where'=>array('(hook_in-hook_out+daily_drawer_out_weight)!='=>0,'chain_name != '=>'Fancy Chain',
                                                                               '(hook_kdm_purity>70 and hook_kdm_purity<76)'=>NULL,
                                                                               'karigar'=>"Factory")),array(),array('group_by'=>'chain_name,lot_no,updated_at,hook_kdm_purity'));
    $this->data['process_wise_dashboard_listing'] =array_merge($daily_drawer_in_75,$daily_drawer_out_75);

  }
    parent::view(1);
    
  }
  private function set_daily_drawer_array($in_out, $daily_drawers) {
    if(!empty($daily_drawers)){
      $this->data['process_wise_dashboard_listing']=array();
      foreach ($daily_drawers as $index => $daily_drawer) {
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']]=array('in'=>0,'out'=>0);
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']][$in_out]= $daily_drawer['balance'];
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']]['product_name']= $daily_drawer['product_name'];
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']]['lot_no']= $daily_drawer['lot_no'];
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']]['updated_at']= $daily_drawer['updated_at'];
        $this->data['process_wise_dashboard_listing'][$daily_drawer['product_name']]['hook_kdm_purity']= $daily_drawer['hook_kdm_purity'];
      }
    }
  }
}