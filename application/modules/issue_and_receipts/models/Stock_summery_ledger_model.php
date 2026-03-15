<?php 
include_once APPPATH . "modules/issue_and_receipts/models/Ledger_model.php";
class Stock_summery_ledger_model extends Ledger_model{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function get_data_from_processes($url, $field_name, $purity, $module, $model_name, $conditions) {
    $select_fields = 'product_name, account as issue_type, description,
                      '.$field_name.' as weight, 
                      '.$purity.' as purity, 
                      ('.$field_name.' * '.$purity.' / 100) as fine, 
                      date(created_at) as created_date, created_at';
                             
    $this->load->model(''.$module.'/'.$model_name.'');

    /*$where_date = array('created_at >='=>date('Y-m-d H:i:s',strtotime('1 Dec 2019')),
                        'created_at <='=>date('Y-m-d H:i:s',strtotime('20 Mar 2020')));

    $conditions = array_merge($conditions,$where_date);*/

    $data = 
      $this->$model_name->get('"'.$url.'" as url,'.$select_fields.'',
                              $conditions,
                              array(),
                              array('order_by' => 'created_at asc'));

    return $data;
  }

  public function get_data_from_melting_lots($url, $field_name, $purity, $module, $model_name, $conditions) {
    $select_fields = '"" as product_name, "" as issue_type, "" as description,
                      '.$field_name.' as weight, 
                      '.$purity.' as purity, 
                      ('.$field_name.' * '.$purity.' / 100) as fine, 
                      date(created_at) as created_date, created_at';
                             
    /*$where_date = array('created_at >='=>date('Y-m-d H:i:s',strtotime('1 Dec 2019')),
                        'created_at <='=>date('Y-m-d H:i:s',strtotime('20 Mar 2020')));

    $conditions = array_merge($conditions,$where_date);*/

    $this->load->model(''.$module.'/'.$model_name.'');
    $data = 
      $this->$model_name->get('"'.$url.'" as url,'.$select_fields.'',
                              $conditions,
                              array(),
                              array('order_by' => 'created_at asc'));

    return $data; 
  }

  public function get_data_from_issue_department_details($url, $conditions){
    $issue_department_details_fields = 'processes.product_name, 
                                        processes.process_name as issue_type, processes.description,
                                        issue_department_details.out_weight as weight, 
                                        processes.in_lot_purity as purity, 
                                        (issue_department_details.out_weight * processes.in_lot_purity / 100) as fine, 
                                        date(issue_department_details.created_at) as created_date, 
                                        issue_department_details.created_at';

    $this->load->model('issue_departments/issue_department_detail_model');

    /*$where_date = array('issue_department_details.created_at >='=>date('Y-m-d H:i:s',strtotime('1 Dec 2019')),
                        'issue_department_details.created_at <='=>date('Y-m-d H:i:s',strtotime('20 Mar 2020')));

    $conditions = array_merge($conditions,$where_date);*/

    $data = 
      $this->issue_department_detail_model->get('"'.$url.'" as url,'.$issue_department_details_fields.'',
                                                $conditions,
                                                array(array('processes', 
                                                            'issue_department_details.process_id = processes.id')),
                                                array('order_by' => 'issue_department_details.created_at asc'));
    return $data;
  }

  public function get_receipt_data() {
  
    $metal_receipt = $this->get_data_from_processes('Metal Receipt', 'melting_wastage', 'in_lot_purity', 
                                                    'receipt_departments', 'receipt_department_model', 
                                                    array('department_name' => 'Start'));

    $chain_receipt = $this->get_data_from_processes('Chain Receipt', 'melting_wastage', 'in_lot_purity', 'receipt_departments',
                                                    'chain_receipt_model', array('department_name' => 'Start'));

    $daily_drawer_receipt = $this->get_data_from_processes('DD Receipt', 'daily_drawer_in_weight', 'in_lot_purity',
                                                           'daily_drawers', 'daily_drawer_receipt_model', 
                                                           array('department_name' => 'Start'));

    $alloy_receipt = $this->get_data_from_processes('Alloy Receipt', 'alloy_weight', 'in_lot_purity', 'alloys',
                                                    'alloy_receipt_model', array('department_name' => 'Start'));

    $refresh_receipt = $this->get_data_from_processes('Refresh Receipt', 'in_weight', 'in_lot_purity', 'refresh',
                                                      'refresh_model', array('department_name' => 'Start'));

    $rnd_receipt = $this->get_data_from_processes('RND Receipt Receipt', 'out_weight', 'in_lot_purity', 'rnds',
                                                    'rnd_receipt_model', array('department_name' => 'Start'));

    $alloy_vodatar = $this->get_data_from_melting_lots('Alloy Vodatar', 'alloy_vodatar', 'lot_purity', 'melting_lots',
                                                       'melting_lot_model', array('alloy_vodatar !=' => 0));

    $gpc_vodatar = $this->get_data_from_processes('GPC Vodatar', 'micro_coating', 'out_lot_purity', 'processes',
                                                  'process_model', array('micro_coating !=' => 0));

    $fe_in = $this->get_data_from_processes('FE In', 'fe_in', 'in_lot_purity', 'processes',
                                            'process_model', array('fe_in !=' => 0));

    $solder_in = $this->get_data_from_processes('Solder In', 'solder_in', 'in_lot_purity', 'processes',
                                                'process_model', array('solder_in !=' => 0));

    $liquor_in = $this->get_data_from_processes('Liquor In', 'liquor_in', 'in_lot_purity', 'processes',
                                                'process_model', array('liquor_in !=' => 0));
    
    $stone_vatav = $this->get_data_from_processes('Stone Vatav', 'stone_vatav', 'in_lot_purity', 'processes',
                                                  'process_model', array('stone_vatav !=' => 0)); 

    $receipts = array_merge($metal_receipt, $daily_drawer_receipt, $chain_receipt,
                            $alloy_receipt, $refresh_receipt,
                            $rnd_receipt, $alloy_vodatar, $gpc_vodatar, $fe_in, 
                            $solder_in, $liquor_in,
                            $stone_vatav);
    return $receipts;
  }

  public function get_stock_data() {
    $hollow_choco_chain = 
      $this->get_data_from_processes('Hollo Choco Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Hollow Choco Chain'));

    $imp_italy_chain = 
      $this->get_data_from_processes('Imp Italy Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Imp Italy Chain'));

    $machine_chain =
      $this->get_data_from_processes('Machine Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Machine Chain'));       

    $choco_chain = 
      $this->get_data_from_processes('Choco Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Choco Chain'));
    $rope_chain = 
      $this->get_data_from_processes('Rope Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Rope Chain'));

    $round_box_chain = 
      $this->get_data_from_processes('Round Box Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Round Box Chain'));

    $indo_tally_chain = 
      $this->get_data_from_processes('Indo Tally Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Indo tally Chain'));

    $fancy_chain =
      $this->get_data_from_processes('Fancy Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Fancy Chain')); 

    $sisma_chain = 
      $this->get_data_from_processes('Sisma Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Sisma Chain'));

    $arc_chain = 
      $this->get_data_from_processes('ARC Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'ARC'));

    $ka_chain = 
      $this->get_data_from_processes('KA Chain', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'KA Chain'));

    $balance_metal_receipt = 
      $this->get_data_from_processes('Balance Metal Receipt','balance_melting_wastage', 'in_lot_purity', 
                                      'receipt_departments', 'receipt_department_model', 
                                      array('department_name' => 'Start',
                                            'balance_melting_wastage !=' => 0));

    $balance_chain_receipt = 
      $this->get_data_from_processes('Balance Chain Receipt', 'balance_melting_wastage', 'in_lot_purity', 
                                     'chain_receipts', 'chain_receipt_model', 
                                      array('department_name' => 'Start',
                                            'balance_melting_wastage !=' => 0));
    
    $office_outside = 
      $this->get_data_from_processes('Office Outside', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Office Outside'));

    $daily_drawer = 
      $this->get_data_from_processes('Daily Drawer', 
                                     '(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight))', 
                                     'hook_kdm_purity', 
                                     'processes', 'process_model', 
                                      array('(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) !=' => 0));

    $daily_drawer_wastage = 
      $this->get_data_from_processes('Daily Drawer Wastage', 'balance_daily_drawer_wastage', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_daily_drawer_wastage != ' => 0));

    $daily_drawer_process = 
      $this->get_data_from_processes('Daily Drawer Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Daily Drawer'));      

    $refresh_process = 
      $this->get_data_from_processes('Refresh Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Refresh'));

    $solder_wastage_process = 
      $this->get_data_from_processes('Solder Wastage Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Solder Wastage'));

    $gpc =
      $this->get_data_from_processes('GPC', 'balance_gpc_out', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_gpc_out != ' => 0)); 

    $melting_wastage = 
      $this->get_data_from_processes('Melting Wastage', 'balance_melting_wastage', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('where_not_in' => array('product_name' => array("'Receipt'", 
                                                                                            "'Chain Receipt'")),
                                            'balance_melting_wastage !=' => 0));
      
    $solder_wastage = 
      $this->get_data_from_processes('Solder Wastage', 'balance_solder_wastage', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_solder_wastage != ' => 0));

    $ghiss = 
      $this->get_data_from_processes('Ghiss', 'balance_ghiss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_ghiss != ' => 0));

    $ghiss_process =
      $this->get_data_from_processes('Ghiss Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Ghiss out'));   

    $rope_ghiss = 
      $this->get_data_from_processes('Rope Ghiss', 'balance_hcl_ghiss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_hcl_ghiss != ' => 0));

    $rope_ghiss_process = 
      $this->get_data_from_processes('Rope Ghiss Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'HCL Ghiss out'));      

    $tounch_ghiss = 
      $this->get_data_from_processes('Tounch Ghiss', 'balance_tounch_ghiss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_tounch_ghiss != ' => 0));

    $pending_ghiss = 
      $this->get_data_from_processes('Pending Ghiss', 'balance_pending_ghiss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_pending_ghiss != ' => 0));

    $hcl_wastage = 
      $this->get_data_from_processes('HCL Wastage', 'balance_hcl_wastage', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_hcl_wastage != ' => 0));

    $hcl_process = 
      $this->get_data_from_processes('HCL Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'HCL'));

    $hcl_gross_loss_issue =
      $this->get_data_from_processes('HCL Gross Loss Issue', 
                                     '(-1 * issue_hcl_loss)', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('issue_hcl_loss !=' => 0)); 
    $tounch_in = 
      $this->get_data_from_processes('Tounch In', 
                                     '(tounch_in - tounch_ghiss - tounch_out)', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(tounch_in - tounch_ghiss - tounch_out) !=' => 0));

    $tounch_out = 
      $this->get_data_from_processes('Tounch Out', 'balance_tounch_out', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_tounch_out != ' => 0));

    $tounch_out_process = 
      $this->get_data_from_processes('Tounch Out Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Tounch Out'));

    $fire_tounch_in = 
      $this->get_data_from_processes('Fire Tounch In', 
                                     '(fire_tounch_in - fire_tounch_out)', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(fire_tounch_in - fire_tounch_out) !=' => 0));  

    $fire_tounch_out = 
      $this->get_data_from_processes('Fire Tounch Out', 'balance_fire_tounch_out', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_fire_tounch_out != ' => 0));

    $copper = 
      $this->get_data_from_processes('Copper', 
                                     '(-1 * (copper_in - copper_out))', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(copper_in - copper_out) !=' => 0));

    $loss =
      $this->get_data_from_processes('Loss', 'balance_loss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance_loss != ' => 0)); 

    $loss_process = 
      $this->get_data_from_processes('Loss Out Process', 'balance', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('balance != ' => 0,
                                            'product_name' => 'Loss Out'));

    $refine_loss = 
      $this->get_data_from_processes('Refine Loss', 'refine_loss', 'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('refine_loss != ' => 0));

    $liquor = 
      $this->get_data_from_processes('Liquor', 
                                     '(liquor_in - liquor_out)', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(liquor_in - liquor_out) !=' => 0));

    $rnd_receipt = 
      $this->get_data_from_processes('RND Receipt Receipt', 'out_weight', 'in_lot_purity', 'rnds',
                                     'rnd_receipt_model', array('department_name' => 'Start'));

    $rnd_issue = 
      $this->get_data_from_processes('RND Issue', 
                                     '(-1 * out_weight)', 
                                     'in_lot_purity', 
                                     'rnds', 'rnd_issue_model', 
                                      array('department_name' => 'Start'));  

    $alloy_receipt_out_melting_lots = 
      $this->get_data_from_melting_lots('Alloy Out Melting Lot', 
                                        '(-1 * alloy_weight)', 
                                        'lot_purity', 
                                        'melting_lots', 'melting_lot_model', 
                                        array('alloy_weight !=' => 0));

    $alloy_receipt_out_processes = 
      $this->get_data_from_processes('Alloy Out Processes', 
                                     '(alloy_weight - out_alloy_weight)', 
                                     'out_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(alloy_weight - out_alloy_weight) !=' => 0));    

    $stocks = array_merge($hollow_choco_chain, $imp_italy_chain, $machine_chain, $choco_chain, $rope_chain,
                          $round_box_chain, $indo_tally_chain, $fancy_chain, $sisma_chain, $arc_chain, $ka_chain, 
                          $office_outside, $daily_drawer, $daily_drawer_wastage, $daily_drawer_process,
                          $refresh_process, $solder_wastage_process, $gpc, $melting_wastage, $solder_wastage,
                          $ghiss, $ghiss_process, $rope_ghiss, $rope_ghiss_process, $tounch_ghiss, $pending_ghiss,
                          $hcl_wastage, $hcl_process, $hcl_gross_loss_issue,
                          $tounch_in, $tounch_out, $tounch_out_process,
                          $fire_tounch_in, $fire_tounch_out,
                          $copper,
                          $loss, $loss_process, $refine_loss,
                          $liquor,
                          $rnd_receipt, $rnd_issue, $alloy_receipt_out_melting_lots, $alloy_receipt_out_processes,
                          $balance_metal_receipt, $balance_chain_receipt);
    return $stocks;
  }

  public function get_issue_data() {
    $issue_gpc_out = 
      $this->get_data_from_issue_department_details('GPC Out', 
                                                    array('where_not_in' => 
                                                                  array('field_name' => array('"Melting Wastage"',
                                                                                              '"Daily Drawer Wastage"',
                                                                                              '"HCL Loss"',
                                                                                              '"Cutting Ghiss"',
                                                                                              '"Repair Out"',
                                                                                              '"Tounch Loss Fine"'))));

    $issue_melting_wastage = 
      $this->get_data_from_issue_department_details('Issue Melting Out', 
                                                    array('issue_department_details.field_name' => 'Melting Wastage'));

    $issue_daily_drawer_wastage = 
      $this->get_data_from_issue_department_details('Issue Daily Drawer Wastage', 
                                                    array('issue_department_details.field_name' => 'Daily Drawer Wastage'));

    $issue_hcl_loss = 
      $this->get_data_from_issue_department_details('Issue HCL Loss', 
                                                    array('issue_department_details.field_name' => 'HCL Loss'));

    $issue_tounch_loss_fine = 
      $this->get_data_from_issue_department_details('Issue Tounch Loss Fine', 
                                                    array('issue_department_details.field_name' => 'Tounch Loss Fine'));

    $issue_ghiss = 
      $this->get_data_from_issue_department_details('Issue Ghiss', 
                                                    array('issue_department_details.field_name' => 'Cutting Ghiss'));

    $issue_daily_drawer = 
      $this->get_data_from_processes('Issue Daily Drawer', 'in_weight', 'in_lot_purity', 
                                     'daily_drawers', 
                                     'daily_drawer_issue_department_model', 
                                     array('department_name' => 'Start'));

    $issue_rnd = 
      $this->get_data_from_processes('Issue RND', 'in_weight', 'in_lot_purity', 
                                     'rnds','rnd_issue_model', 
                                     array('department_name' => 'Start'));

    $fe_out = 
      $this->get_data_from_processes('FE Out', 
                                     '(fe_out + wastage_fe)', 
                                     'in_lot_purity', 
                                     'processes', 'process_model', 
                                      array('(fe_out + wastage_fe) !=' => 0));

    $liquor_out = 
      $this->get_data_from_processes('Liquor Out', 'liquor_out', 'in_lot_purity', 
                                     'processes','process_model', 
                                     array('liquor_out !=' => 0));

    $issues = array_merge($issue_gpc_out, $issue_melting_wastage, $issue_daily_drawer_wastage,
                          $issue_hcl_loss, $issue_ghiss, $issue_daily_drawer,
                          $issue_rnd, $fe_out, $liquor_out);
    return $issues;
  }
}