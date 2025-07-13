<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_summary_reports extends BaseController {
  protected $columns = array('in_weight', 'in_weight_gross', 'in_weight_fine',
                             'out_weight', 'product_name',
                             'balance', 'balance_gross', 'balance_fine');

  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model',
                             'issue_departments/issue_department_detail_model',
                             'reports/daily_change_rolling_balance_report_model',
                             'export_internals/packing_slip_model',
			                       'melting_lots/melting_lot_model', 'melting_lots/melting_lot_detail_model',
                             'issue_departments/issue_department_model', 'settings/karigar_model'));
    $this->process_group_by_fields = 'process_name';
    $this->wastage_group_by_fields = 'concat(product_name)';
//    $this->group_by_id = 'concat(lot_no, " ", process_name, " ", department_name)';
    $this->group_by_id = 'concat(process_name)';

    $this->zero_in_out_select = '0 as in_weight,product_name, 0 as in_weight_gross, 0 as in_weight_fine, 0 as out_weight';
    $this->zero_balance_select = '0 as balance, 0 as balance_gross, 0 as balance_fine';
  }

  public function index() {
    $this->data['enable_mapping'] = isset($_GET['disable_mapping']) ? 0 : 1;

    $karigars = $this->karigar_model->get('concat(karigar_name, " - ", round(hook_kdm_purity,2)) as karigar_name, chain_name');

    $this->data['karigar_chain_mappings'] = array();
    if ($this->data['enable_mapping']) {
      foreach ($karigars as $karigar) {
        if (empty($karigar['chain_name'])) continue;
        $chain_name_key = str_replace_space_dash_dot($karigar['chain_name']);
        $karigar_name_key = 'karigar_daily_drawer_'.str_replace_space_dash_dot($karigar['karigar_name']);
        $this->data['karigar_chain_mappings'][$karigar_name_key] = $chain_name_key;
      }
    }

    $this->received_summary();
    $this->stock_and_issue_summary();
    $this->balance_summary();
    
    if((isset($_GET['return']) && $_GET['return'] == 'json')){
      echo json_encode($this->data);
    }
    elseif ((isset($_GET['rolling']) && $_GET['rolling'] == '1')){
      $date_report=!empty($_GET['date_report'])?$_GET['date_report']:date('Y-m-d');
      $this->daily_change_rolling_balance_report_model->create_daily_product_rolling($this->data,$date_report);
      echo "Record Inserted Successfully.";die();
    } 
    elseif($this->uri->segment(2)=='telegram'){
      return $this->data;
    }
    else
      $this->load->render('stock_summary_reports/stock_summary_reports/index', $this->data);
  }

  public function view($id=1) {
    $this->data['enable_mapping'] = isset($_GET['disable_mapping']) ? 0 : 1;

    $karigars = $this->karigar_model->get('concat(karigar_name, " - ", round(hook_kdm_purity,2)) as karigar_name, chain_name');

    $this->data['karigar_chain_mappings'] = array();
    if ($this->data['enable_mapping']) {
      foreach ($karigars as $karigar) {
        if (empty($karigar['chain_name'])) continue;
        $chain_name_key = str_replace_space_dash_dot($karigar['chain_name']);
        $karigar_name_key = 'karigar_daily_drawer_'.str_replace_space_dash_dot($karigar['karigar_name']);
        $this->data['karigar_chain_mappings'][$karigar_name_key] = $chain_name_key;
      }
    }

    $this->received_summary();
    $this->stock_and_issue_summary();
    $this->balance_summary();
    $date_report=!empty($_GET['date_report'])?$_GET['date_report']:date('Y-m-d');
    $this->daily_change_rolling_balance_report_model->create_daily_product_rolling($this->data,$date_report);
    echo "Record Inserted Successfully.";die();
  }

  private function received_summary() { 
    $row_names = array('metal_summary', 'chain_receipt_summary','internal_receipt_summary', 'daily_drawer_receipt_summary','loss_receipt', 'finished_goods_receipt',
                       'refresh_metal_receipt',/* 'rnd_receipt_in_summary', 'rnd_receipt_out_summary',*/ 
                       'pending_ghiss_receipt', 'stone_vatav_receipt',
                       'alloy_receipt_in_summary', 'alloy_receipt_out_summary', 'alloy_receipt_out_weight_summary',
                       'copper_receipt_in_summary',/*'domestic_internal_receipt_summary',*/
                       'alloy_vodatar', 'gpc_vodatar', 'fe', 'solder',  
                       'liquor_in', 'stone_receipt', 'stone_issue',
                       //'hallmark_in'
                       );  //'rhodium_receipt'
    $this->get_section_data($row_names);

    $row_names = array('alloy_receipt_in_summary', 'alloy_receipt_out_summary', 'alloy_receipt_out_weight_summary');
    $this->get_section_total('alloy_receipt_summary', $row_names);

    $row_names = array('refresh_metal_receipt', 'rnd_receipt_in_summary'/*, 'rnd_receipt_out_summary'*/);
    $this->get_section_total('refresh_receipt_summary', $row_names);

    $row_names = array('metal_summary','internal_receipt_summary', 'chain_receipt_summary', 'hallmark_receipt_summary','loss_receipt', 'daily_drawer_receipt_summary', 'finished_goods_receipt',
                       'refresh_metal_receipt', 'rnd_receipt_in_summary',/*, 'rnd_receipt_out_summary',*/
                       'pending_ghiss_receipt', 'stone_vatav_receipt', /*'domestic_internal_receipt_summary',*/
                       'alloy_receipt_in_summary', 'alloy_receipt_out_summary', 'alloy_receipt_out_weight_summary',
                       'copper_receipt_in_summary',
                       'alloy_vodatar', 'gpc_vodatar', 'fe', 'solder', 
                       'liquor_in', 'stone_receipt',
                       //'hallmark_in'
                       );   //'rhodium_receipt',
    $this->get_section_total('total_received', $row_names);
  }

  private function stock_and_issue_summary() { 
    $this->data['rows'] = array();

    $this->data['chains'] = array('ARC', 'Arc Chain','Hallmark', 'Casting Process', 'Arc Ornament', 'Arc Para','Arc Customer Order','Arc Rnd Chain', 'Arc Lock','Arc Turkey','Arc Fancy','Arc Kuwaiti', 'Ball Chain','Casting Chain', 'Choco Chain', 'Chain 75', 'Chain 92', 
                                  'Daily Drawer', 'Dus Collection', 'Domestic Internal', 'Tanishq Fancy Chain', 'Fancy Chain','Fancy 75 Chain', 'Hollow Choco Chain','Hollow Bangle Chain','Hand Made Chain', 'I 10 Process', 'Imp Italy Chain',
                                  'Indo tally Chain', 'Internal', 'KA Chain', 'Lock Process','Lotus Chain','Lopster Making Chain','Lopster', 'Machine Chain', 'Nano Process','Nawabi Chain',  'Kuwaitis',
                                  'Pendent Set', 'Pendent Set 75', 'Pendent Set Plain', 'Plain Ring', 
                                  'Refresh', 'Ring', 'Ring 75', 'Roco Choco Chain','Rope Chain','Round Box Chain','Rolex Chain', 
                                  'Pendant', 'Pendant 75', 'Sisma Chain','Sisma ARF Chain', 'Sisma Accessories Making Chain', 'Solid Machine Chain','Solid Nawabi Chain', 'Solid Rope Chain','Stone Ring 75', 'Stone Ring 92');
    $this->get_chain_section_data($this->data['chains'], $this->process_group_by_fields); 

    $rows = array(/*'choco_chain_dye_process', 'imp_italy_chain_dye_process', 'hollow_choco_chain_dye_process', 'nawabi_chain_dye_process', 'lotus_chain_dye_process', 
                  'roco_choco_chain_dye_process',*/
                  /*'rope_chain_cutting_pipe',
                  'choco_chain_cutting_pipe',
                  // 'hand_made_cutting_pipes',
                  'hollow_choco_cutting_pipe',
                  'machine_chain_cutting_pipe',
                  // 'roco_choco_cutting_pipes',
                  'imp_italy_cutting_pipe',
                  // 'indo_tally_cutting_pipes',
                  // 'lopster_making_cutting_pipes',
                  'hollow_bangle_cutting_pipe',
                  // 'nawabi_chain_cutting_pipes',
                  'sisma_chain_cutting_pipe',
                  // 'solid_rope_cutting_pipes',
                  // 'solid_machine_cutting_pipes',

                  'choco_chain_solid_pipe',
                  // 'hand_made_solid_pipes',
                  'hollow_choco_solid_pipe',
                  'rope_chain_solid_pipe',
                  'machine_chain_solid_pipe',
                  // 'roco_choco_solid_pipes',
                  'imp_italy_solid_pipe',
                  // 'indo_tally_solid_pipes',
                  // 'lopster_making_solid_pipes',
                  'hollow_bangle_solid_pipe',
                  // 'nawabi_chain_solid_pipes',
                  'sisma_chain_solid_pipe',
                  // 'solid_rope_solid_pipes',
                  // 'solid_machine_solid_pipes',

                  'choco_chain_hollow_pipe',
                  // 'hand_made_hollow_pipes',
                  'hollow_choco_hollow_pipe',
                  'rope_chain_hollow_pipe',
                  'machine_chain_hollow_pipe',
                  // 'roco_choco_hollow_pipes',
                  'imp_italy_hollow_pipe',
                  // 'indo_tally_hollow_pipes',
                  // 'lopster_making_hollow_pipes',
                  'hollow_bangle_hollow_pipe',
                  // 'nawabi_chain_hollow_pipes',
                  'sisma_chain_hollow_pipe',
                  // 'solid_rope_hollow_pipes',
                  // 'solid_machine_hollow_pipes',

                  'choco_chain_hard_wire',
                  // 'hand_made_hard_wire',
                  'hollow_choco_hard_wire',
                  'rope_chain_hard_wire',
                  'machine_chain_hard_wire',
                  // 'roco_choco_hard_wire',
                   'imp_italy_hard_wire',
                  // 'indo_tally_hard_wire',
                  // 'lopster_making_hard_wire',
                  'hollow_bangle_hard_wire',
                  // 'nawabi_chain_hard_wire',
                  'sisma_chain_hard_wire',
                  // 'solid_rope_hard_wire',
                  // 'solid_machine_hard_wire',

                   'choco_chain_solid_wire',
                  // 'hand_made_solid_wire',
                   'hollow_choco_solid_wire',
                   'rope_chain_solid_wire',
                   'machine_chain_solid_wire',
                  // 'roco_choco_solid_wire',
                   'imp_italy_solid_wire',
                  // 'indo_tally_solid_wire',
                  // 'lopster_making_solid_wire',
                   'hollow_bangle_solid_wire',
                  // 'nawabi_chain_solid_wire',
                   'sisma_chain_solid_wire',
                  // 'solid_rope_solid_wire',
                  // 'solid_machine_solid_wire',

                  'rope_chain_ag_out', 'rope_chain_ag_flatting_out', 
                  'machine_chain_ag_out', 
                  'imp_italy_chain_ag_out',
                  'hollow_choco_chain_pl_out',
                  'nawabi_chain_pl_out',
                  'lotus_chain_pl_out',
                  'roco_choco_chain_pl_out',
                  'indo_tally_chain_ag_out', 'indo_tally_chain_pl_out'*/);
    $this->get_section_data($rows);

    foreach ($rows as $row) 
      unset($this->data['rows'][$row]);

    if (isset($this->data['hollow_choco_chain_pl_out_pl'])) 
      $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_pl_out_pl';
    
    if (isset($this->data['lotus_chain_pl_out_pl'])) 
      $this->data['rows']['lotus_chain'][] = 'lotus_chain_pl_out_pl';

    if (isset($this->data['roco_choco_chain_pl_out_pl'])) 
      $this->data['rows']['roco_choco_chain'][] = 'roco_choco_chain_pl_out_pl';
    
    if (isset($this->data['nawabi_chain_pl_out_pl'])) 
      $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_pl_out_pl';
    
    if (isset($this->data['hollow_choco_chain_dye_process_hollow_choco_dye_process']))
      $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_dye_process_hollow_choco_dye_process';

    if (isset($this->data['nawabi_chain_dye_process_nawabi_dye_process']))
      $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_dye_process_nawabi_dye_process';

    if (isset($this->data['lotus_chain_dye_process_lotus_dye_process']))
      $this->data['rows']['lotus_chain'][] = 'lotus_chain_dye_process_lotus_dye_process';
    

    if (isset($this->data['roco_choco_chain_dye_process_roco_choco_dye_process']))
      $this->data['rows']['roco_choco_chain'][] = 'roco_choco_chain_dye_process_roco_choco_dye_process';

    if (isset($this->data['imp_italy_chain_ag_out_ag'])) 
      $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_ag_out_ag';

    if (isset($this->data['imp_italy_chain_dye_process_imp_italy_dye_process'])) 
      $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_dye_process_imp_italy_dye_process';
  
    if (isset($this->data['choco_chain_dye_process_choco_chain_dye_process'])) 
      $this->data['rows']['choco_chain'][] = 'choco_chain_dye_process_choco_chain_dye_process';

    if (isset($this->data['rope_chain_ag_out_ag'])) 
      $this->data['rows']['rope_chain'][] = 'rope_chain_ag_out_ag'; 
    if (isset($this->data['rope_chain_ag_flatting_out_ag_flatting'])) 
      $this->data['rows']['rope_chain'][] = 'rope_chain_ag_flatting_out_ag_flatting';
    
    if (isset($this->data['machine_chain_ag_out_ag'])) 
      $this->data['rows']['machine_chain'][] = 'machine_chain_ag_out_ag';
    
    if (isset($this->data['indo_tally_chain_ag_out_ag'])) 
      $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_ag_out_ag';
    if (isset($this->data['indo_tally_chain_pl_out_pl'])) 
      $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_pl_out_pl';
    
    if (isset($this->data['hollow_choco_chain_cutting_pipes_hollow_choco_cutting_pipe']))
      $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_cutting_pipes_hollow_choco_cutting_pipe';

    if (isset($this->data['hollow_choco_chain_hollow_pipes_hollow_choco_hollow_pipe']))
          $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_hollow_pipes_hollow_choco_hollow_pipe';
    if (isset($this->data['hollow_choco_chain_solid_pipes_hollow_choco_solid_pipe']))
              $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_solid_pipes_hollow_choco_solid_pipe';
    if (isset($this->data['hollow_choco_chain_solid_wires_hollow_choco_solid_wire']))
                  $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_solid_wires_hollow_choco_solid_wire';
    if (isset($this->data['hollow_choco_chain_hard_wires_hollow_hard_wire']))
                      $this->data['rows']['hollow_choco_chain'][] = 'hollow_choco_chain_hard_wires_hollow_choco_hard_wire';

    if (isset($this->data['hollow_bangle_chain_cutting_pipes_hollow_bangle_cutting_pipe']))
      $this->data['rows']['hollow_bangle_chain'][] = 'hollow_bangle_chain_cutting_pipes_hollow_bangle_cutting_pipe';
    if (isset($this->data['hollow_bangle_chain_hollow_pipes_hollow_bangle_hollow_pipe']))
          $this->data['rows']['hollow_bangle_chain'][] = 'hollow_bangle_chain_hollow_pipes_hollow_bangle_hollow_pipe';
    if (isset($this->data['hollow_bangle_chain_solid_pipes_hollow_bangle_solid_pipe']))
              $this->data['rows']['hollow_bangle_chain'][] = 'hollow_bangle_chain_solid_pipes_hollow_bangle_solid_pipe';
    if (isset($this->data['hollow_bangle_chain_solid_wires_hollow_bangle_solid_wire']))
                  $this->data['rows']['hollow_bangle_chain'][] = 'hollow_bangle_chain_solid_wires_hollow_bangle_solid_wire';
    if (isset($this->data['hollow_bangle_chain_hard_wires_hollow_bangle_hard_wire']))
                      $this->data['rows']['hollow_bangle_chain'][] = 'hollow_bangle_chain_hard_wires_hollow_bangle_hard_wire';

    if (isset($this->data['choco_chain_cutting_pipes_choco_choco_cutting_pipe']))
      $this->data['rows']['choco_chain'][] = 'choco_chain_cutting_pipes_choco_choco_cutting_pipe';
    if (isset($this->data['choco_chain_hollow_pipes_choco_chain_hollow_pipe']))
          $this->data['rows']['choco_chain'][] = 'choco_chain_hollow_pipes_choco_chain_hollow_pipe';
    if (isset($this->data['choco_chain_solid_pipes_choco_chain_solid_pipe']))
              $this->data['rows']['choco_chain'][] = 'choco_chain_solid_pipes_choco_chain_solid_pipe';
    if (isset($this->data['choco_chain_solid_wires_choco_chain_solid_wire']))
                  $this->data['rows']['choco_chain'][] = 'choco_chain_solid_wires_choco_chain_solid_wire';
    if (isset($this->data['choco_chain_hard_wires_choco_chain_hard_wire']))
                      $this->data['rows']['choco_chain'][] = 'choco_chain_hard_wires_choco_chain_hard_wire';

    if (isset($this->data['rope_chain_cutting_pipes_rope_cutting_pipe']))
      $this->data['rows']['rope_chain'][] = 'rope_chain_cutting_pipes_rope_cutting_pipe';
    if (isset($this->data['rope_chain_hollow_pipes_rope_hollow_pipe']))
          $this->data['rows']['rope_chain'][] = 'rope_chain_hollow_pipes_rope_hollow_pipe';
    if (isset($this->data['rope_chain_solid_pipes_rope_chain_solid_pipe']))
              $this->data['rows']['rope_chain'][] = 'rope_chain_solid_pipes_rope_chain_solid_pipe';
    if (isset($this->data['rope_chain_solid_wires_rope_chain_solid_wire']))
              $this->data['rows']['rope_chain'][] = 'rope_chain_solid_wires_rope_chain_solid_wire';
    if (isset($this->data['rope_chain_hard_wires_rope_chain_hard_wire']))
              $this->data['rows']['rope_chain'][] = 'rope_chain_hard_wires_rope_chain_chain_hard_wire';
    // pd($this->data);

    if (isset($this->data['machine_chain_cutting_pipes_machine_chain_cutting_pipe']))
      $this->data['rows']['machine_chain'][] = 'machine_chain_cutting_pipes_machine_chain_cutting_pipe';
    if (isset($this->data['machine_chain_hollow_pipes_machine_chain_hollow_pipe']))
          $this->data['rows']['machine_chain'][] = 'machine_chain_hollow_pipes_machine_chain_hollow_pipe';
    if (isset($this->data['machine_chain_solid_pipes_machine_chain_solid_pipe']))
              $this->data['rows']['machine_chain'][] = 'machine_chain_solid_pipes_machine_chain_solid_pipe';
    if (isset($this->data['machine_chain_solid_wires_machine_chain_solid_wire']))
                  $this->data['rows']['machine_chain'][] = 'machine_chain_solid_wires_machine_chain_solid_wire';
    if (isset($this->data['machine_chain_hard_wires_machine_chain_hard_wire']))
                      $this->data['rows']['machine_chain'][] = 'machine_chain_hard_wires_machine_chain_hard_wire';
    
    // if (isset($this->data['indo_tally_chain_cutting_pipe_cutting_pipe']))
    //   $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['indo_tally_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['indo_tally_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['indo_tally_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_solid_wire_solid_wire';
    // if (isset($this->data['indo_tally_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['indo_tally_chain'][] = 'indo_tally_chain_hard_wire_hard_wire';
    if (isset($this->data['imp_italy_chain_cutting_pipes_imp_italy_cutting_pipe']))
      $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_cutting_pipes_imp_italy_cutting_pipe';
    if (isset($this->data['imp_italy_chain_hollow_pipes_imp_italy_hollow_pipe']))
          $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_hollow_pipes_imp_italy_hollow_pipe';
    if (isset($this->data['imp_italy_chain_solid_pipes_imp_italy_solid_pipe']))
              $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_solid_pipes_imp_italy_solid_pipe';
    if (isset($this->data['imp_italy_chain_solid_wires_imp_italy_solid_wire']))
                  $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_solid_wires_imp_italy_solid_wire';
    if (isset($this->data['imp_italy_chain_hard_wires_imp_italy_hard_wire']))
                      $this->data['rows']['imp_italy_chain'][] = 'imp_italy_chain_hard_wires_imp_italy_hard_wire';

    
    // if (isset($this->data['hand_made_chain_cutting_pipe_cutting_pipe']))
    //   $this->data['rows']['hand_made_chain'][] = 'hand_made_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['hand_made_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['hand_made_chain'][] = 'hand_made_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['hand_made_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['hand_made_chain'][] = 'hand_made_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['hand_made_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['hand_made_chain'][] = 'hand_made_chain_solid_wire_solid_wire';
    // if (isset($this->data['hand_made_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['hand_made_chain'][] = 'hand_made_chain_hard_wire_hard_wire';

    // if (isset($this->data['solid_rope_chain_cutting_pipe_cutting_pipe']))
    //   $this->data['rows']['solid_rope_chain'][] = 'solid_rope_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['solid_rope_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['solid_rope_chain'][] = 'solid_rope_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['solid_rope_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['solid_rope_chain'][] = 'solid_rope_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['solid_rope_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['solid_rope_chain'][] = 'solid_rope_chain_solid_wire_solid_wire';
    // if (isset($this->data['solid_rope_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['solid_rope_chain'][] = 'solid_rope_chain_hard_wire_hard_wire';

    // if (isset($this->data['solid_machine_chain_cutting_pipe_cutting_pipe']))
    //   $this->data['rows']['solid_machine_chain'][] = 'solid_machine_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['solid_machine_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['solid_machine_chain'][] = 'solid_machine_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['solid_machine_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['solid_machine_chain'][] = 'solid_machine_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['solid_machine_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['solid_machine_chain'][] = 'solid_machine_chain_solid_wire_solid_wire';
    // if (isset($this->data['solid_machine_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['solid_machine_chain'][] = 'solid_machine_chain_hard_wire_hard_wire';

    // if (isset($this->data['lotus_chain_cutting_pipe_cutting_pipe']))
    //       $this->data['rows']['lotus_chain'][] = 'lotus_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['lotus_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['lotus_chain'][] = 'lotus_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['lotus_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['lotus_chain'][] = 'lotus_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['lotus_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['lotus_chain'][] = 'lotus_chain_solid_wire_solid_wire';
    // if (isset($this->data['lotus_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['lotus_chain'][] = 'lotus_chain_hard_wire_hard_wire';

    // if (isset($this->data['nawabi_chain_cutting_pipe_cutting_pipe']))
    //       $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['nawabi_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['nawabi_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['nawabi_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_solid_wire_solid_wire';
    // if (isset($this->data['nawabi_chain_hard_wire_hard_wire']))
    //                   $this->data['rows']['nawabi_chain'][] = 'nawabi_chain_hard_wire_hard_wire';

    // if (isset($this->data['lopster_making_chain_cutting_pipe_cutting_pipe']))
    //       $this->data['rows']['lopster_making_chain'][] = 'lopster_making_chain_cutting_pipe_cutting_pipe';
    // if (isset($this->data['lopster_making_chain_hollow_pipe_hollow_pipe']))
    //       $this->data['rows']['lopster_making_chain'][] = 'lopster_making_chain_hollow_pipe_hollow_pipe';
    // if (isset($this->data['lopster_making_chain_solid_pipe_solid_pipe']))
    //           $this->data['rows']['lopster_making_chain'][] = 'lopster_making_chain_solid_pipe_solid_pipe';
    // if (isset($this->data['lopster_making_chain_solid_wire_solid_wire']))
    //               $this->data['rows']['lopster_making_chain'][] = 'lopster_making_chain_solid_wire_solid_wire';
    // if (isset($this->data['lopster_making_chain_hard_wire_hard_wire']))
                      // $this->data['rows']['lopster_making_chain'][] = 'lopster_making_chain_hard_wire_hard_wire';

    if (isset($this->data['sisma_chain_cutting_pipe_cutting_pipe']))
          $this->data['rows']['sisma_chain'][] = 'sisma_chain_cutting_pipe_cutting_pipe';
    if (isset($this->data['sisma_chain_hollow_pipe_hollow_pipe']))
          $this->data['rows']['sisma_chain'][] = 'sisma_chain_hollow_pipe_hollow_pipe';
    if (isset($this->data['sisma_chain_solid_pipe_solid_pipe']))
              $this->data['rows']['sisma_chain'][] = 'sisma_chain_solid_pipe_solid_pipe';
    if (isset($this->data['sisma_chain_solid_wire_solid_wire']))
                  $this->data['rows']['sisma_chain'][] = 'sisma_chain_solid_wire_solid_wire';
    if (isset($this->data['sisma_chain_hard_wire_hard_wire']))
                      $this->data['rows']['sisma_chain'][] = 'sisma_chain_hard_wire_hard_wire';

    

        
    $this->data['wastages'] = array('daily_drawer_wastage', 'ghiss', 'pending_ghiss', 
                                    'solder_wastage', 'tounch_out', 'tounch_ghiss'); 
    if (!$this->data['enable_mapping']) {
      $this->data['wastages'][] = 'hcl_wastage';
      $this->data['wastages'][] = 'hcl_ghiss';
    } else
      $this->get_wastage_section_data(array('hcl_wastage', 'hcl_ghiss')); 

    $this->get_wastage_section_data($this->data['wastages']); 
    

    $this->data['wastage_meltings'] = array('Ghiss Out', 'HCL', 'HCL Ghiss Out', 'Loss Out', 'Melting Loss Out', 'Solder Wastage', 'Tounch Out');
    $this->get_chain_section_data($this->data['wastage_meltings'], 'empty'); 
    
    $rows = array( 'stock_metal_summery', 'stock_chain_receipt_summary', 'stock_finished_goods_receipt',
                   //'stock_rhodium_summary',
                   'office_outside', 'office_outside_pipe_and_para',
                   'karigar_daily_drawer', 
                   'internal_rejected', 
                   'issue_gpc_powder', 'gpc_powder','refresh_gpc_out', 
                   'gpc_out', 'hallmark_out', 'hallmark_subcontracted',
                   'wastage_melting_wastage', 'wastage_refine_loss', 'melting_wastage_refine_loss',
                   'stock_melting_wastage_fine_difference', 'wastage_fire_tounch_gross_loss',
                   'wastage_walnut_hcl_gross_loss','wastage_hcl_gross_loss', 'hcl_gross_loss_issue',
                   'wastage_tounch_in', 'wastage_fire_tounch_in',
                   'gpc_tounch_department_loss', 'wastage_tounch_department_loss', 'refine_tounch_department_loss', 'other_tounch_department_loss',  
                   //'fire_tounch_out',
                   'wastage_loss', 'wastage_ghiss_loss',
                   'issue_loss',
                   'copper',
                   // 'refresh_rnd_issue', 
                   //'repair_out',
                   /*'rnd_stock_in_summary', 'rnd_stock_out_summary',*/
                   'liquor_stock', 'stone_stock', 'stone_vatav','stock_packing_slip','stock_after_packing_slip');
    $this->get_section_data($rows);

    $this->data['rows']['total_gpc_powder']           = array('gpc_powder');
    $this->data['rows']['total_internal_rejected']           = array('internal_rejected');
    //$this->data['rows']['office_outside'][]           = 'office_outside_pipe_and_para';
    $this->data['rows']['rnd_stock_summary']          = array('rnd_stock_in_summary', 'rnd_stock_out_summary');

    foreach($this->data['karigar_chain_mappings'] as $karigar_name_key => $chain_name_key) {
      $this->data['rows'][$chain_name_key][] = $karigar_name_key;
    }
    $this->data['rows']['karigar_daily_drawer']  = array_diff($this->data['rows']['karigar_daily_drawer'], array_keys($this->data['karigar_chain_mappings']));
    
    if ($this->data['enable_mapping']) {
      if (!empty($this->data['rows']['wastage_hcl_wastage'])) {
        foreach($this->data['rows']['wastage_hcl_wastage'] as $index => $chain_name_key) {
          $chain_name = str_replace('wastage_hcl_wastage_','',$chain_name_key);
          $this->data['rows'][$chain_name][] = $chain_name_key;
        }
      }
      unset($this->data['rows']['wastage_hcl_wastage']);

      if (!empty($this->data['rows']['wastage_hcl_ghiss'])) {
        foreach($this->data['rows']['wastage_hcl_ghiss'] as $index => $chain_name_key) {
          $chain_name = str_replace('wastage_hcl_ghiss_','',$chain_name_key);
          $this->data['rows'][$chain_name][] = $chain_name_key;
        }
      }
      unset($this->data['rows']['wastage_hcl_ghiss']);
      if (!empty($this->data['rows']['wastage_ghiss'])) {
        foreach($this->data['rows']['wastage_ghiss'] as $index => $chain_name_key) {
          $chain_name = str_replace('wastage_ghiss_','',$chain_name_key);
          if ($chain_name != 'pending_ghiss_out') {
            $this->data['rows'][$chain_name][] = $chain_name_key;
            unset($this->data['rows']['wastage_ghiss'][$index]);
          } 
        }
      }
//      unset($this->data['rows']['wastage_ghiss']);

      if (!empty($this->data['rows']['wastage_pending_ghiss'])) {
        foreach($this->data['rows']['wastage_pending_ghiss'] as $index => $chain_name_key) {
          $chain_name = str_replace('wastage_pending_ghiss_','',$chain_name_key);
          if ($chain_name != 'pending_ghiss_receipt') {
	    $this->data['rows'][$chain_name][] = $chain_name_key;
            unset($this->data['rows']['wastage_pending_ghiss'][$index]);
          }
        }
      }
    }
    
    foreach ($this->data['rows'] as $section_name => $sections) 
      $this->get_section_total($section_name, $sections);

    $row_names = array( 'stock_metal_summery', 'stock_chain_receipt_summary', 'stock_finished_goods_receipt',
                        //'stock_rhodium_summary',
                        'hallmark_out', 'hallmark_subcontracted',
                        'liquor_stock', 'stone_stock', 
                        'ghiss_out', 'hcl', 'hcl_ghiss_out', 'loss_out', 'melting_loss_out', 'solder_wastage', 'tounch_out','stock_packing_slip','stock_after_packing_slip'); //'karigar_daily_drawer',

    foreach (array_keys($this->data['rows']) as $row_name) {
        $row_names[] = $row_name;
    }

    $this->get_section_total('total_stock_summary', $row_names);
    //$this->get_hallmark_subcontracted();

    $row_names = array('issue_department_gpc_out', //'issue_department_hallmark_out',
                       'issue_department_hu_id',
                       'issue_department_qc_out',
                       'issue_department_hallmark_receipt', 'issue_department_finish_good', 'issue_loss_melting',
                       'issue_department_melting_wastage','issue_department_refine_loss', 'issue_department_daily_drawer_wastage', 
                       'issue_daily_drawer', 'issue_liquor', 'issue_hcl_loss', 'issue_tounch_loss_fine', 'issue_ghiss',
		       'issue_melting_wastage_refine_loss','issue_department_export_internal'/*,'issue_department_domestic_internal'*/,'issue_department_qc_out','issue_department_packing_slip','extra_packing_slip');
    $this->get_section_data($row_names);
    $this->get_zero_balance();
    
    $row_names = array('copper',  'stone_issue', 'stone_vatav', 'issue_department_gpc_out', //'issue_department_hallmark_out',
                       'issue_department_hu_id',
                       'issue_department_hallmark_receipt', 'issue_department_finish_good' , 'issue_loss_melting',
                       'issue_department_melting_wastage', 
                       'issue_department_refine_loss', 
                       'issue_department_daily_drawer_wastage',
                       'issue_daily_drawer','issue_fe', 'refresh_rnd_issue', 'issue_liquor', 'issue_loss',
                       'issue_hcl_loss', 'issue_tounch_loss_fine', 'issue_ghiss', 'issue_gpc_powder', 'issue_melting_wastage_refine_loss','issue_department_export_internal'/*,'issue_department_domestic_internal'*/,'issue_department_qc_out','issue_department_packing_slip','extra_packing_slip'); 
    $this->get_section_total('total_issued', $row_names);
    $row_names = array('adjustment_summary'); 
    $this->get_section_data($row_names);    
  }

  private function balance_summary() { 
    $this->get_zero_balance('adjustment');
    if (HOST=='ARF' && ENVIRONMENT=='production') {
      $this->data['adjustment']['balance'] = 0;
      $this->data['adjustment']['balance_gross'] = 0;
      $this->data['adjustment']['balance_fine'] = 0;
    }

    $this->data['summary_receipt_in']['balance'] = $this->data['total_received']['in_weight'];
    $this->data['summary_receipt_in']['balance_gross'] = $this->data['total_received']['in_weight_gross'];
    $this->data['summary_receipt_in']['balance_fine'] = $this->data['total_received']['in_weight_fine'];

    $this->data['summary_total_receipt']['balance'] = $this->data['summary_receipt_in']['balance'];
    $this->data['summary_total_receipt']['balance_gross'] = $this->data['summary_receipt_in']['balance_gross'];
    $this->data['summary_total_receipt']['balance_fine'] = $this->data['summary_receipt_in']['balance_fine'];

    $this->data['summary_receipt_balance']['balance'] = $this->data['total_received']['balance'];
    $this->data['summary_receipt_balance']['balance_gross'] = $this->data['total_received']['balance_gross'];
    $this->data['summary_receipt_balance']['balance_fine'] = $this->data['total_received']['balance_fine'];

    $this->data['summary_stock']['balance'] = $this->data['total_stock_summary']['balance'];
    $this->data['summary_stock']['balance_gross'] = $this->data['total_stock_summary']['balance_gross'];
    $this->data['summary_stock']['balance_fine'] = $this->data['total_stock_summary']['balance_fine'];

    $this->data['summary_issue']['balance'] = $this->data['total_issued']['balance'];
    $this->data['summary_issue']['balance_gross'] = $this->data['total_issued']['balance_gross'];
    $this->data['summary_issue']['balance_fine'] = $this->data['total_issued']['balance_fine'];

    $this->data['summary_total_stock']['balance'] = $this->data['summary_receipt_balance']['balance']
                                                    + $this->data['summary_stock']['balance']
                                                    + $this->data['adjustment_summary']['balance']
                                                    + $this->data['summary_issue']['balance'];
    $this->data['summary_total_stock']['balance_gross'] = $this->data['summary_receipt_balance']['balance_gross']
                                                          + $this->data['summary_stock']['balance_gross']
                                                          + $this->data['adjustment_summary']['balance_gross']
                                                          + $this->data['summary_issue']['balance_gross'];
    $this->data['summary_total_stock']['balance_fine'] = $this->data['summary_receipt_balance']['balance_fine']
                                                         + $this->data['summary_stock']['balance_fine']
                                                         + $this->data['adjustment_summary']['balance_fine']
                                                         + $this->data['summary_issue']['balance_fine'];

    $this->data['summary']['balance'] = $this->data['summary_total_receipt']['balance']
                                        - $this->data['summary_total_stock']['balance']
                                        - $this->data['adjustment']['balance'];

    $this->data['summary']['balance_gross'] = $this->data['summary_total_receipt']['balance_gross']
                                              - $this->data['summary_total_stock']['balance_gross']
                                              - $this->data['adjustment']['balance_gross'];

    $this->data['summary']['balance_fine'] = $this->data['summary_total_receipt']['balance_fine']
                                             - $this->data['summary_total_stock']['balance_fine']
                                             - $this->data['adjustment']['balance_fine'];
  }

  private function get_chain_section_data($chains, $group_by) {
    foreach($chains as $product_name) {
      $row_name = str_replace_space_dash_dot($product_name, '_');
      if ($product_name == 'KA Chain') $product_name = array('KA Chain', 'KA Chain Refresh');
      $groupby = ($product_name == 'Refresh') ? $this->group_by_id : $group_by;
      $this->get_chain_process_balance(str_replace_space_dash_dot($row_name, '_'), 'processes', 'process_model', $product_name, $groupby);
    } 
  }

  private function get_wastage_section_data($wastage_fields) {
    foreach($wastage_fields as $wastage_field) {
      $row_name = 'wastage_'.$wastage_field;
      $this->get_wastage_balance($row_name, 'processes', 'process_model', $wastage_field);
    }
  }

  private function get_section_data($row_names) {
    foreach($row_names as $row_name) {
      $function_name = 'get_'.$row_name;
      $this->$function_name();
    } 
  }

  private function get_section_total($total_row_name, $row_names) {
    foreach($this->columns as $column) {
      if($column=='product_name'){
      $this->data[$total_row_name][$column]="";
      }else{
      $this->data[$total_row_name][$column] = 0;
      }
      foreach($row_names as $row_name) {
        if (!isset($this->data[$row_name])) continue;
        $this->data[$total_row_name][$column] += $this->data[$row_name][$column];
        if($column=='product_name'){
        $this->data[$total_row_name][$column]=str_replace_underscore($total_row_name,' ');
        }
      }
    }
  }

  private function stock_summary_query($row_name, $module_name, $model_name, $select, $conditions=array(), $group_by = 'empty') {
    $this->load->model($module_name.'/'.$model_name);    
    $select_fields = $select['in_out'].', '.$select['balance'];
    $groupby = '';  
    if ($group_by != 'empty') {
      $groupby = $group_by;
      $select_fields .= ', '.$groupby.' as groupby';
    }
    $in_out_balances = $this->$model_name->get($select_fields, $conditions, array(), array('group_by' => $groupby));
    
    if     (empty($in_out_balances)) $this->get_zero_balance($row_name);
    elseif ($group_by == 'empty') $this->data[$row_name] = $in_out_balances[0];
    elseif (!empty($groupby)) {
      foreach ($in_out_balances as $in_out_balance) {

        if (empty($in_out_balance['groupby'])) {
          $process_name = $row_name.'_blank';
          $in_out_balance['groupby'] = $row_name.'_blank';
        } else {
          $process_name = $row_name.'_'.str_replace_space_dash_dot($in_out_balance['groupby'], '_');
          $in_out_balance['groupby'] = str_replace_space_dash_dot($in_out_balance['groupby']);
        }
        
        $this->data[$process_name] = $in_out_balance;
        $this->data['rows'][$row_name][] = $process_name; 
      }
    }
  }
  
  private function get_zero_balance($row_name = 'zero_balance') {
    $this->data[$row_name]['in_weight'] = 0;
    $this->data[$row_name]['in_weight_gross'] = 0;
    $this->data[$row_name]['in_weight_fine'] = 0;
    $this->data[$row_name]['out_weight'] = 0;

    $this->data[$row_name]['balance'] = 0;
    $this->data[$row_name]['balance_gross'] = 0;
    $this->data[$row_name]['balance_fine'] = 0;
  }

  private function get_metal_summary() {
    $select['in_out']  = 'sum(melting_wastage) as in_weight,product_name,
                          sum(melting_wastage) as in_weight_gross, 
                          sum(melting_wastage * out_lot_purity / 100) as in_weight_fine, 
                          sum(melting_wastage) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('metal_summary', 'receipt_departments', 'receipt_department_model', $select, array('parent_id' => 0));
  }
  private function get_domestic_internal_receipt_summary() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine,
                          sum(out_melting_wastage) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('domestic_internal_receipt_summary', 'domestic_internals', 'domestic_internal_receipt_model', $select, array('parent_id' => 0));
  }


  private function get_stock_metal_summery() {
    $select['in_out']  = 'sum(melting_wastage) as in_weight,product_name,
                          sum(melting_wastage) as in_weight_gross, 
                          sum(melting_wastage * out_lot_purity / 100) as in_weight_fine, 
                          sum(melting_wastage) as out_weight';
    $select['balance'] = 'sum(balance_melting_wastage) as balance,
                          sum(balance_melting_wastage) as balance_gross,
                          sum(balance_melting_wastage * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('stock_metal_summery', 'receipt_departments', 'receipt_department_model', $select);
  }

  private function get_stock_melting_wastage_fine_difference() {
    $this->get_zero_balance('stock_melting_wastage_fine_difference');

    $select = 'sum((melting_lot_details.required_weight * (processes.wastage_lot_purity - melting_lot_details.in_purity)/ 100)) as in_melting_wastage_fine';
    $diff = $this->melting_lot_detail_model->find($select, array(), array(array('processes', 'processes.id=melting_lot_details.process_id')));
    $this->data['stock_melting_wastage_fine_difference']['balance_fine']  = $diff['in_melting_wastage_fine'];
  }  

  private function get_internal_receipt_summary() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          product_name,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('internal_receipt_summary', 'internals', 'internal_receipt_model', $select, array('department_name' => 'Final', 'product_name'=>'Internal'));
  }
  private function get_hallmark_receipt_summary() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          product_name,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('hallmark_receipt_summary', 'hallmarking', 'hallmark_receipt_process_model', $select, array('department_name' => 'Receipt Department'));
  }

  private function get_chain_receipt_summary() {
    $select['in_out']  = 'sum(melting_wastage) as in_weight,product_name,
                          sum(melting_wastage) as in_weight_gross, 
                          sum(melting_wastage * out_lot_purity / 100) as in_weight_fine, 
                          sum(melting_wastage) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('chain_receipt_summary', 'receipt_departments', 'chain_receipt_model', $select, array('parent_id' => 0));
  }

  private function get_daily_drawer_receipt_summary() {
    $select['in_out']  = 'sum(daily_drawer_in_weight) as in_weight,product_name,
                          sum(daily_drawer_in_weight) as in_weight_gross, 
                          sum(daily_drawer_in_weight * out_lot_purity / 100) as in_weight_fine, 
                          sum(daily_drawer_in_weight) as out_weight';                          
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('daily_drawer_receipt_summary', 'daily_drawers', 'Daily_drawer_receipt_model', $select);
  }
  private function get_rhodium_receipt() {
    $select['in_out']  = 'sum(melting_wastage) as in_weight,product_name,
                          sum(melting_wastage) as in_weight_gross, 
                          sum(melting_wastage * out_lot_purity / 100) as in_weight_fine, 
                          sum(melting_wastage) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('rhodium_receipt', 'receipt_departments', 'rhodium_receipt_model', $select, array('parent_id' => 0));
  }

  private function get_stock_rhodium_summary() {
    $select['in_out']  = 'sum(melting_wastage) as in_weight,product_name,
                          sum(melting_wastage) as in_weight_gross, 
                          sum(melting_wastage * out_lot_purity / 100) as in_weight_fine, 
                          sum(melting_wastage) as out_weight';
     $select['balance'] = 'sum(melting_wastage) as balance,
                          sum(melting_wastage) as balance_gross,
                          sum(melting_wastage * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('stock_rhodium_summary', 'receipt_departments', 'rhodium_receipt_model', $select, array('parent_id' => 0));
  }

  private function get_stock_chain_receipt_summary() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_melting_wastage) as balance,
                          sum(balance_melting_wastage) as balance_gross,
                          sum(balance_melting_wastage * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('stock_chain_receipt_summary', 'receipt_departments', 'chain_receipt_model', $select, 
                               array('balance_melting_wastage != ' => 0), $this->process_group_by_fields);
  }
  private function get_stock_packing_slip() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(packing_slip_balance) as balance,
                          sum(packing_slip_balance) as balance_gross,
                          sum(packing_slip_balance * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('stock_packing_slip', 'processes', 'process_model', $select, 
                               array('packing_slip_balance > ' => 0));
  }
  private function get_stock_after_packing_slip() {
    $issue_department_details=$this->issue_department_detail_model->get('process_id',array('field_name'=>"Packing Slip"));
      if(!empty($issue_department_details)){
        $process_ids=array_column($issue_department_details,'process_id');
        $where['id not in ('.implode(',',$process_ids).')']=NULL;
      }
     //$select['in_out']  = $this->zero_in_out_select;
     $select['in_out']  = '0 as in_weight,
                           0 as in_weight_gross,
                           0 as in_weight_fine,
		           0 as out_weight';

	$select['balance'] = 'sum(gross_weight) as balance,
                          sum(gross_weight) as balance_gross,
                          sum(gross_weight * purity / 100) as balance_fine';
    $this->stock_summary_query('stock_after_packing_slip', 'packing_slips', 'packing_slip_model', $select,$where);
  }


  private function get_refresh_metal_receipt() {
    // $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
    //                       sum(in_weight) as in_weight_gross, 
    //                       sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
    //                       sum(out_weight) as out_weight';
    // $select['balance'] = '0 as balance,
    //                       0 as balance_gross,
    //                       0 as balance_fine';
    // $this->stock_summary_query('refresh_metal_receipt_old', 'refresh', 'refresh_hold_model', $select, 
    //                           array('department_name' => array('Start', 'Refresh Hold'), 'account like "%Software%"' => NULL));

    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * wastage_lot_purity / 100) as in_weight_fine, 
                          sum(out_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('refresh_metal_receipt', 'refresh', 'refresh_hold_model', $select, 
                               array('department_name' => array('Start', 'Refresh Hold'), 
                       //              'account like "%Software%"' => NULL,
                                     'parent_id = 0' => NULL));

    // $this->data['refresh_metal_receipt']['in_weight'] += $this->data['refresh_metal_receipt_old']['in_weight'];
    // $this->data['refresh_metal_receipt']['in_weight_gross'] += $this->data['refresh_metal_receipt_old']['in_weight_gross'];
    // $this->data['refresh_metal_receipt']['in_weight_fine'] += $this->data['refresh_metal_receipt_old']['in_weight_fine'];
    // $this->data['refresh_metal_receipt']['out_weight'] += $this->data['refresh_metal_receipt_old']['out_weight'];
    // $this->data['refresh_metal_receipt']['balance'] += $this->data['refresh_metal_receipt_old']['balance'];
    // $this->data['refresh_metal_receipt']['balance_gross'] += $this->data['refresh_metal_receipt_old']['balance_gross'];
    // $this->data['refresh_metal_receipt']['balance_fine'] += $this->data['refresh_metal_receipt_old']['balance_fine'];
  }

  /*private function get_rnd_receipt_in_summary() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
                          sum(out_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('rnd_receipt_in_summary', 'rnds', 'rnd_receipt_model', $select);
  }*/

  private function get_pending_ghiss_receipt() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('pending_ghiss_receipt', 'receipt_departments', 'pending_ghiss_receipt_model', $select);
  }

  private function get_stone_vatav_receipt() {
    $select['in_out']  = 'sum(stone_vatav) as in_weight,product_name,
                          sum(stone_vatav) as in_weight_gross, 
                          sum(stone_vatav * in_lot_purity / 100) as in_weight_fine, 
                          sum(stone_vatav) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('stone_vatav_receipt', 'processes', 'process_model', $select);
  }

  private function get_alloy_receipt_in_summary() {
    $select['in_out']  = 'sum(alloy_weight) as in_weight,product_name,
                          sum(alloy_weight) as in_weight_gross, 
                          0 as in_weight_fine, 
                          0 as out_weight';
    $select['balance'] = 'sum(alloy_weight) as balance,
                          sum(alloy_weight) as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('alloy_receipt_in_summary', 'alloys', 'alloy_receipt_model', $select);
  }

  private function get_copper_receipt_in_summary() {
    $select['in_out']  = 'sum(copper_in) as in_weight,product_name,
                          sum(copper_in) as in_weight_gross, 
                          sum(copper_in * in_lot_purity / 100) as in_weight_fine, 
                          sum(copper_in) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('copper_receipt_in_summary', 'processes', 'process_model', $select);
  }

  private function get_alloy_receipt_out_summary() {
    $select['in_out']  = '0 as in_weight,
                          0 as in_weight_gross, 
                          0 as in_weight_fine, 
                          sum(alloy_weight) as out_weight';
    $select['balance'] = '-sum(alloy_weight) as balance,
                          -sum(alloy_weight) as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('alloy_receipt_out_summary', 'melting_lots', 'melting_lot_model', $select);
  }

  private function get_alloy_receipt_out_weight_summary() {
    $select['in_out']  = '-sum(out_alloy_weight) as in_weight,product_name,
                          -sum(out_alloy_weight) as in_weight_gross, 
                          0 as in_weight_fine, 
                          sum(out_alloy_weight) as out_weight';
    $select['balance'] = '-sum(out_alloy_weight) as balance,
                          -sum(out_alloy_weight) as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('alloy_receipt_out_weight_summary', 'alloys', 'alloy_issue_model', $select);
  }

  private function get_alloy_vodatar() {
    $select['in_out']  = 'sum(alloy_vodatar) as in_weight,
                          sum(alloy_vodatar) as in_weight_gross,
                          0 as in_weight_fine,
                          sum(alloy_vodatar) as out_weight';
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          (0-sum(alloy_vodatar*lot_purity/100)) as balance_fine';
    $this->stock_summary_query('alloy_vodatar', 'melting_lots', 'melting_lot_model', $select);

  } 

  private function get_gpc_vodatar() {
    $select['in_out']  = 'sum(micro_coating) as in_weight,product_name,
                          sum(micro_coating) as in_weight_gross,
                          sum(micro_coating * wastage_lot_purity / 100) as in_weight_fine,
                          sum(micro_coating) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('gpc_vodatar', 'processes', 'process_model', $select);
  }

  private function get_fe() {
    $select['in_out']  = 'sum(fe_in) as in_weight,product_name,
                          0 as in_weight_gross,
                          0 as in_weight_fine,
                          sum(fe_in-fe_out-wastage_fe) as out_weight';
    $select['balance'] = 'sum(fe_out + wastage_fe) as balance,
                          0 as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('fe', 'processes', 'process_model', $select);

    $this->data['issue_fe']['in_weight'] = 0;
    $this->data['issue_fe']['in_weight_gross'] = 0;
    $this->data['issue_fe']['in_weight_fine'] = 0;
    $this->data['issue_fe']['out_weight'] = 0;

    $this->data['issue_fe']['balance'] = $this->data['fe']['balance'];
    $this->data['fe']['balance'] = 0;
    $this->data['issue_fe']['balance_gross'] = 0;
    $this->data['issue_fe']['balance_fine'] = 0;
  }

  private function get_solder() {
    $select['in_out']  = 'sum(solder_in + alloy_weight) as in_weight,product_name,
                          sum(solder_in + alloy_weight) as in_weight_gross,
                          0 as in_weight_fine,
                          sum(solder_in + alloy_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('solder', 'processes', 'process_model', $select, 
                               array('product_name !=' => 'Alloy Receipt'));
  }

  private function get_liquor_in(){
    $select['in_out']  = 'sum(liquor_in) as in_weight,product_name,
                          sum(liquor_in) as in_weight_gross,
                          0 as in_weight_fine,
                          sum(liquor_in) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('liquor_in', 'processes', 'process_model', $select);
  }

  private function get_stone_receipt() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('stone_receipt', 'processes', 'process_model', $select, array('product_name' => 'Stone Receipt'));
  }
  private function get_loss_receipt() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('loss_receipt', 'processes', 'process_model', $select, array('product_name' => 'Loss Receipt'));
  }

    private function get_hallmark_in() {
    $select['in_out']  = 'sum(hallmark_in + issue_hallmark_out - hallmark_in) as in_weight, product_name,
                          sum(hallmark_in + issue_hallmark_out - hallmark_in) as in_weight_gross, 
                          sum((hallmark_in + issue_hallmark_out - hallmark_in )* out_lot_purity / 100) as in_weight_fine, 
                          sum(hallmark_in + issue_hallmark_out - hallmark_in) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('hallmark_in', 'processes', 'process_model', $select, array('hallmark_out != ' => 0));
  }

  private function get_stone_issue() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          sum(in_weight) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('stone_issue', 'processes', 'process_model', $select, array('product_name' => 'Stone Issue'));
  }

  private function get_stone_stock() {
    $select['in_out']  = 'sum(stone_in - stone_out) as in_weight,product_name,
                          sum((stone_in - stone_out) * in_purity / 100) as in_weight_gross,
                          sum((stone_in - stone_out) * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(stone_in - stone_out) as balance,
                          sum((stone_in - stone_out) * in_purity / 100) as balance_gross,
                          sum((stone_in - stone_out) * in_purity / 100 * in_lot_purity / 100) as balance_fine'; 
    $this->stock_summary_query('stone_stock', 'processes', 'process_model', $select, 
                                array('product_name not in ("Stone Receipt", "Stone Issue")' => NULL));

    $this->data['stone_stock']['in_weight'] = $this->data['stone_receipt']['in_weight'] - $this->data['stone_issue']['in_weight'] 
                                              - $this->data['stone_stock']['in_weight'];
    $this->data['stone_stock']['in_weight_gross'] = $this->data['stone_receipt']['in_weight_gross'] - $this->data['stone_issue']['in_weight_gross']
                                                     - $this->data['stone_stock']['in_weight_gross'];
    $this->data['stone_stock']['in_weight_fine'] = $this->data['stone_receipt']['in_weight_fine'] - $this->data['stone_issue']['in_weight_fine']
                                                    - $this->data['stone_stock']['in_weight_fine'];
    $this->data['stone_stock']['out_weight'] = $this->data['stone_receipt']['out_weight'] - $this->data['stone_issue']['out_weight']
                                                    - $this->data['stone_stock']['out_weight'];    
    $this->data['stone_stock']['balance'] = $this->data['stone_receipt']['in_weight'] - $this->data['stone_issue']['in_weight']
                                                    - $this->data['stone_stock']['balance'];    
    $this->data['stone_stock']['balance_gross'] = $this->data['stone_receipt']['in_weight_gross'] - $this->data['stone_issue']['in_weight_gross']
                                                    - $this->data['stone_stock']['balance_gross'];    
    $this->data['stone_stock']['balance_fine'] = $this->data['stone_receipt']['in_weight_fine'] - $this->data['stone_issue']['in_weight_fine']
                                                    - $this->data['stone_stock']['balance_fine'];    
  }

  private function get_stone_vatav() {
    $select['in_out']  = 'sum(out_stone_vatav) as in_weight,product_name,
                          sum(out_stone_vatav) as in_weight_gross,
                          sum(out_stone_vatav * out_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(out_stone_vatav) as balance,
                          sum(out_stone_vatav * out_purity / 100) as balance_gross,
                          sum(out_stone_vatav * out_purity / 100 * out_lot_purity / 100) as balance_fine'; 
    $this->stock_summary_query('stone_vatav', 'processes', 'process_model', $select);
  }

  private function get_chain_daily_drawer_receipt_balance($row_name, $module_name, $model_name) {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = $this->zero_balance_select; 
    $this->stock_summary_query($row_name, $module_name, $model_name, $select,
                               array('department_name' => 'Start',
                                     'parent_id' => 0));
  }

  private function get_chain_daily_drawer_issue_balance($row_name, $module_name, $model_name, $department_name) {
    $select['in_out']  = 'sum(out_weight) as in_weight,product_name,
                          sum(out_weight * out_purity / 100) as in_weight_gross,
                          sum(out_weight * out_purity / 100 * out_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(out_weight) as balance,
                          sum(out_weight * out_purity / 100) as balance_gross,
                          sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine'; 
    $this->stock_summary_query($row_name, $module_name, $model_name, $select,
                                            array('department_name' => $department_name));
  }

  private function get_chain_process_balance($row_name, $module_name, $model_name, $product_name, $group_by) {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_quantity) as quantity,
                          product_name,
                          sum(balance) as balance,
                          sum(balance_gross) as balance_gross,
                          sum(balance_fine) as balance_fine'; 
    $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                               array('product_name' => $product_name, 'balance != ' => 0), $group_by);
  }

  private function get_wastage_balance($row_name, $module_name, $model_name, $wastage_field) {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_'.$wastage_field.') as balance,
                          sum(balance_'.$wastage_field.' * wastage_purity / 100) as balance_gross,
                          sum(balance_'.$wastage_field.' * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine';                          
    
    // if ($wastage_field == 'pending_ghiss')
    //   $group_by = 'department_name';       
    // else  
    $group_by = $this->wastage_group_by_fields;       


    if ($this->data['enable_mapping'])
      if ($row_name == 'wastage_hcl_wastage' || $row_name == 'wastage_hcl_ghiss') $group_by = 'product_name';

    $this->stock_summary_query($row_name, 'processes', 'process_model', $select, array('balance_'.$wastage_field. '!=' => 0), $group_by);
  }

  private function get_chain_process_balance_with_process_name($row_name, $module_name, 
                                                               $model_name, $product_name, $process_name) {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'product_name,
                          sum(balance) as balance,
                          sum(balance_gross) as balance_gross,
                          sum(balance_fine) as balance_fine'; 
    $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                               array('product_name' => $product_name,
                                     'process_name' => $process_name,
                                     'balance != ' => 0), $this->process_group_by_fields);
  }

  private function get_chain_out_balance($row_name, $module_name, $model_name, $product_name, 
                                         $process_name, $out_department_name, $in_department_name) {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(out_weight) as balance,
                          sum(out_weight * out_purity / 100) as balance_gross,
                          sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine';
    $groupby = $this->process_group_by_fields;

    if (!is_array($process_name)) {
      $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                               array('product_name' => $product_name, 'department_name' => $out_department_name,
                                     'where_not_in' => array('id' => "(select parent_id from processes
                                                                       where product_name = '".$product_name."'
                                                                       and process_name = '".$process_name."'
                                                                       and department_name = '".$in_department_name."')")), $groupby);
    } else {
      if (count($process_name) > 2) {
        $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                                 array('product_name' => $product_name, 'department_name' => $out_department_name,
                                       'where_not_in' => array('id' => "(select parent_id from processes
                                                                         where product_name = '".$product_name."'
                                                                         and (process_name = '".$process_name[0]."' or 
                                                                              process_name = '".$process_name[1]."' or 
                                                                              process_name = '".$process_name[2]."')
                                                                         and department_name = '".$in_department_name."')")), $groupby);
      } else {
        $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                                   array('product_name' => $product_name, 'department_name' => $out_department_name,
                                         'where_not_in' => array('id' => "(select parent_id from processes
                                                                           where product_name = '".$product_name."'
                                                                           and (process_name = '".$process_name[0]."' or 
                       `                                                         process_name = '".$process_name[1]."')
                                                                           and department_name = '".$in_department_name."')")), $groupby); 
      }
      
    }
    
  }

  private function get_chain_process_group_balance($row_name, $module_name, $model_name, $product_name, $department_name) {
    $select['in_out']  = 'sum(out_weight) as in_weight,product_name,
                          sum(out_weight * out_purity / 100) as in_weight_gross,
                          sum(out_weight * out_purity / 100 * out_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(out_weight) as balance,
                          sum(out_weight * out_purity / 100) as balance_gross,
                          sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query($row_name, $module_name, $model_name, $select, 
                               array('product_name'=>$product_name,
                                     'department_name' => $department_name,
                                     'where_not_in' => array('id' => "(select process_id from process_groups)"),
                                     'out_weight != ' => 0), $this->process_group_by_fields);
  }

  //PROCESS GROUPS OUT WEIGHT NOT TRANSFERED TO NEXT DEPARTMENT
  private function get_hollow_choco_chain_pl_out(){
    $this->get_chain_process_group_balance('hollow_choco_chain_pl_out', 'hollow_choco_chains', 'hollow_choco_pl_model', 'Hollow Choco Chain', 'Melting');
  }

  private function get_lotus_chain_pl_out(){
    $this->get_chain_process_group_balance('lotus_chain_pl_out', 'lotus_chains', 'lotus_pl_model', 'Lotus Chain', 'Melting');
  }

  private function get_roco_choco_chain_pl_out(){
    $this->get_chain_process_group_balance('roco_choco_chain_pl_out', 'roco_choco_chains', 'roco_choco_pl_model', 'Roco Choco Chain', 'Melting');
  }

  private function get_nawabi_chain_pl_out(){
    $this->get_chain_process_group_balance('nawabi_chain_pl_out', 'nawabi_chains', 'nawabi_pl_model', 'Nawabi Chain', 'Melting');
  }

  private function get_rope_chain_ag_out(){
    $this->get_chain_process_group_balance('rope_chain_ag_out', 'rope_chains', 'rope_chain_ag_model', 'Rope Chain', 'Melting');
  }

  private function get_imp_italy_chain_ag_out(){
    $this->get_chain_process_group_balance('imp_italy_chain_ag_out', 'imp_italy_chains', 'imp_italy_ag_model', 'Imp Italy Chain', 'Melting');
  }

  private function get_indo_tally_chain_ag_out(){
    $this->get_chain_process_group_balance('indo_tally_chain_ag_out', 'indo_tally_chains', 'indo_tally_ag_model', 
                                           'Indo tally Chain', 'Melting');
  }

  private function get_indo_tally_chain_pl_out(){
    $this->get_chain_process_group_balance('indo_tally_chain_pl_out', 'indo_tally_chains', 'indo_tally_pl_model', 'Indo tally Chain', 'Melting');
  }
  //END


  //OUT WEIGHT NOT TRANSFERED TO NEXT DEPARTMENT
  private function get_rope_chain_ag_flatting_out(){
    $this->get_chain_out_balance('rope_chain_ag_flatting_out', 'rope_chains', 'rope_chain_ag_flatting_model', 
                                 'Rope Chain', 'Machine Process', 'Wire Drawing', 'Machine Department');
  }
  
  private function get_machine_chain_ag_out(){
    $this->get_chain_out_balance('machine_chain_ag_out', 'machine_chains', 'machine_chain_ag_model', 
                                 'Machine Chain', 'Machine Process', 'Wire Drawing', 'Machine Department');
  }
  //END

  //DYE PROCESSES
  private function get_hollow_choco_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_dye_process', 'hollow_choco_chains', 'hollow_choco_dye_process_model','Office Outside', 'Hollow Choco Dye Process');
  }

  private function get_imp_italy_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_dye_process', 'imp_italy_chains', 'imp_italy_dye_process_model', 
                                                       'Office Outside', 'Imp Italy Dye Process');
  }
  
 /* private function get_choco_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('choco_chain_dye_process', 'choco_chains', 'choco_chain_dye_process_model', 'Office Outside', 'Choco Chain Dye Process');
  }
  private function get_nawabi_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('nawabi_chain_dye_process', 'nawabi_chains', 'nawabi_dye_process_model', 'Office Outside', 'Nawabi Chain Dye Process');
  }
  private function get_lotus_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('lotus_chain_dye_process', 'lotus_chains', 'lotus_dye_process_model', 'Office Outside', 'Lotus Chain Dye Process');
  }
  private function get_roco_choco_chain_dye_process(){
    $this->get_chain_process_balance_with_process_name('roco_choco_chain_dye_process', 'roco_choco_chains', 'roco_choco_dye_process_model', 'Office Outside', 'Roco Choco Dye Process');
  }
  //END

  //Office Out side for all PROCESSES
  private function get_hollow_choco_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_cutting_pipes', 'hollow_choco_chains', 'hollow_choco_chain_cutting_pipe_model','Office Outside', 'Hollow Choco Cutting Pipe');
  }

  private function get_hollow_bangle_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_bangle_chain_cutting_pipes', 'hollow_bangle_chains', 'hollow_bangle_chain_cutting_pipe_model','Office Outside', 'Hollow Bangle Cutting Pipe');
  }

  private function get_imp_italy_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_cutting_pipes', 'imp_italy_chains', 'imp_italy_chain_cutting_pipe_model','Office Outside', 'Imp Italy Cutting Pipe');
  }
  
  private function get_choco_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('choco_chain_cutting_pipes', 'choco_chains', 'choco_chain_cutting_pipe_model', 'Office Outside', 'Choco Chain Cutting Pipe');

  }
  private function get_nawabi_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('nawabi_chain_cutting_pipes', 'nawabi_chains', 'nawabi_chain_cutting_pipe_model', 'Office Outside', 'Nawabi Chain Cutting Pipe');
  }
  private function get_lopster_making_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('lopster_making_chain_cutting_pipes', 'lopster_making_chains', 'lopster_making_chain_cutting_pipe_model', 'Office Outside', 'Lopster Making Cutting Pipe');
  }
  private function get_lotus_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('lotus_chain_cutting_pipes', 'lotus_chains', 'lotus_chain_cutting_pipe_model', 'Office Outside', 'Lotus Chain Cutting Pipe');
  }
  private function get_roco_choco_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('roco_choco_chain_cutting_pipes', 'roco_choco_chains', 'roco_choco_chain_cutting_pipe_model', 'Office Outside', 'Roco Choco Cutting Pipe');
  }
  private function get_rope_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('rope_chain_cutting_pipes', 'rope_chains', 'rope_chain_cutting_pipe_model', 'Office Outside', 'Rope Chain Cutting Pipe');
  }
  private function get_machine_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('machine_chain_cutting_pipes', 'machine_chains', 'machine_chain_cutting_pipe_model', 'Office Outside', 'Machine Chain Cutting Pipe');
  }
  private function get_sisma_chain_cutting_pipe(){
    $this->get_chain_process_balance_with_process_name('sisma_chain_cutting_pipes', 'sisma_chains', 'sisma_chain_cutting_pipe_model', 'Office Outside', 'Sisma Chain Cutting Pipe');
  }*/
  // private function get_solid_machine_cutting_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_machine_chain_cutting_pipes', 'solid_machine_chains', 'cutting_pipe_model', 'Office Outside', 'Solid Machine Cutting Pipe');
  // }
  // private function get_solid_rope_cutting_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_rope_chain_cutting_pipes', 'solid_rope_chains', 'cutting_pipe_model', 'Office Outside', 'Solid Rope Cutting Pipe');
  // }
  // private function get_hand_made_cutting_pipe(){
  //     $this->get_chain_process_balance_with_process_name('hand_made_chain_cutting_pipes', 'hand_made_chains', 'cutting_pipe_model', 'Office Outside', 'Hand Made Cutting Pipe');
  //   }
  // private function get_indo_tally_cutting_pipe(){
  //     $this->get_chain_process_balance_with_process_name('indo_tally_chain_cutting_pipes', 'indo_tally_chains', 'cutting_pipe_model', 'Office Outside', 'Indo tally Cutting Pipe');
  //   }
  private function get_hollow_choco_hard_wire(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_hard_wires', 'hollow_choco_chains', 'hollow_choco_chain_hard_wire_model','Office Outside', 'Hollow Choco Hard Wire');
  }

  private function get_hollow_bangle_hard_wire(){
    $this->get_chain_process_balance_with_process_name('hollow_bangle_chain_hard_wires', 'hollow_bangle_chains', 'hollow_choco_chain_hard_wire_model','Office Outside', 'Hollow Bangle Hard Wire');
  }

  private function get_imp_italy_hard_wire(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_hard_wires', 'imp_italy_chains', 'imp_italy_chain_hard_wire_model','Office Outside', 'Imp Italy Hard Wire');
  }
  
  private function get_choco_chain_hard_wire(){
    $this->get_chain_process_balance_with_process_name('choco_chain_hard_wires', 'choco_chains', 'choco_chain_hard_wire_model', 'Office Outside', 'Choco Chain Hard Wire');

  }
  // private function get_nawabi_chain_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('nawabi_chain_hard_wires', 'nawabi_chains', 'hard_wire_model', 'Office Outside', 'Nawabi Chain Hard Wire');
  // }
  // private function get_lopster_making_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('lopster_making_chain_hard_wires', 'lopster_making_chains', 'hard_wire_model', 'Office Outside', 'Lopster Making Hard Wire');
  // }
  // private function get_lotus_chain_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('lotus_chain_hard_wires', 'lotus_chains', 'hard_wire_model', 'Office Outside', 'Lotus Chain Hard Wire');
  // }
  // private function get_roco_choco_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('roco_choco_chain_hard_wires', 'roco_choco_chains', 'hard_wire_model', 'Office Outside', 'Roco Choco Hard Wire');
  // }
  private function get_rope_chain_hard_wire(){
    $this->get_chain_process_balance_with_process_name('rope_chain_hard_wires', 'rope_chains', 'rope_chain_hard_wire_model', 'Office Outside', 'Rope Chain Hard Wire');
  }
  private function get_machine_chain_hard_wire(){
    $this->get_chain_process_balance_with_process_name('machine_chain_hard_wires', 'machine_chains', 'machine_chain_hard_wire_model', 'Office Outside', 'Machine Chain Hard Wire');
  }
  private function get_sisma_chain_hard_wire(){
    $this->get_chain_process_balance_with_process_name('sisma_chain_hard_wires', 'sisma_chains', 'sisma_chain_hard_wire_model', 'Office Outside', 'Sisma Chain Hard Wire');
  }
  // private function get_solid_machine_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('solid_machine_chain_hard_wires', 'solid_machine_chains', 'hard_wire_model', 'Office Outside', 'Solid Machine Hard Wire');
  // }private function get_solid_rope_hard_wire(){
  //   $this->get_chain_process_balance_with_process_name('solid_rope_chain_hard_wires', 'solid_rope_chains', 'hard_wire_model', 'Office Outside', 'Solid Rope Hard Wire');
  // }
  // private function get_hand_made_hard_wire(){
  //     $this->get_chain_process_balance_with_process_name('hand_made_chain_hard_wires', 'hand_made_chains', 'hard_wire_model', 'Office Outside', 'Hand Made Hard Wire');
  //   }
  // private function get_indo_tally_hard_wire(){
  //     $this->get_chain_process_balance_with_process_name('indo_tally_chain_hard_wires', 'indo_tally_chains', 'hard_wire_model', 'Office Outside', 'Indo tally Hard Wire');
  //   }
  private function get_hollow_choco_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_hollow_pipes', 'hollow_choco_chains', 'hollow_choco_chain_hollow_pipe_model','Office Outside', 'Hollow Choco Hollow Pipe');
  }

  private function get_hollow_bangle_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_bangle_chain_hollow_pipes', 'hollow_bangle_chains', 'hollow_bangle_chain_hollow_pipe_model','Office Outside', 'Hollow Bangle Hollow Pipe');
  }

  private function get_imp_italy_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_hollow_pipes', 'imp_italy_chains', 'imp_italy_chain_hollow_pipe_model','Office Outside', 'Imp Italy Hollow Pipe');
  }
  
  private function get_choco_chain_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('choco_chain_hollow_pipes', 'choco_chains', 'choco_chain_hollow_pipe_model', 'Office Outside', 'Choco Chain Hollow Pipe');

  }
  // private function get_nawabi_chain_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('nawabi_chain_hollow_pipes', 'nawabi_chains', 'hollow_pipe_model', 'Office Outside', 'Nawabi Chain Hollow Pipe');
  // }
  // private function get_lopster_making_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('lopster_making_chain_hollow_pipes', 'lopster_making_chains', 'hollow_pipe_model', 'Office Outside', 'Lopster Making Hollow Pipe');
  // }
  // private function get_lotus_chain_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('lotus_chain_hollow_pipes', 'lotus_chains', 'hollow_pipe_model', 'Office Outside', 'Lotus Chain Hollow Pipe');
  // }
  // private function get_roco_choco_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('roco_choco_chain_hollow_pipes', 'roco_choco_chains', 'hollow_pipe_model', 'Office Outside', 'Roco Choco Hollow Pipe');
  // }
  private function get_rope_chain_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('rope_chain_hollow_pipes', 'rope_chains', 'rope_chain_hollow_pipe_model', 'Office Outside', 'Rope Chain Hollow Pipe');
  }
  private function get_machine_chain_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('machine_chain_hollow_pipes', 'machine_chains', 'machine_chain_hollow_pipe_model', 'Office Outside', 'Machine Chain Hollow Pipe');
  }
  private function get_sisma_chain_hollow_pipe(){
    $this->get_chain_process_balance_with_process_name('sisma_chain_hollow_pipes', 'sisma_chains', 'sisma_chain_hollow_pipe_model', 'Office Outside', 'Sisma Chain Hollow Pipe');
  }
  // private function get_solid_machine_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_machine_chain_hollow_pipes', 'solid_machine_chains', 'hollow_pipe_model', 'Office Outside', 'Solid Machine Hollow Pipe');
  // }private function get_solid_rope_hollow_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_rope_chain_hollow_pipes', 'solid_rope_chains', 'hollow_pipe_model', 'Office Outside', 'Solid Rope Hollow Pipe');
  // }
  // private function get_hand_made_hollow_pipe(){
  //     $this->get_chain_process_balance_with_process_name('hand_made_chain_hollow_pipes', 'hand_made_chains', 'hollow_pipe_model', 'Office Outside', 'Hand Made Hollow Pipe');
  //   }
  // private function get_indo_tally_hollow_pipe(){
  //     $this->get_chain_process_balance_with_process_name('indo_tally_chain_hollow_pipes', 'indo_tally_chains', 'hollow_pipe_model', 'Office Outside', 'Indo tally Hollow Pipe');
  //   }
  private function get_hollow_choco_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_solid_pipes', 'hollow_choco_chains', 'hollow_choco_chain_solid_pipe_model','Office Outside', 'Hollow Choco Solid Pipe');
  }

  private function get_hollow_bangle_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('hollow_bangle_chain_solid_pipes', 'hollow_bangle_chains', 'hollow_bangle_chain_solid_pipe_model','Office Outside', 'Hollow Bangle Solid Pipe');
  }

  private function get_imp_italy_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_solid_pipes', 'imp_italy_chains', 'imp_italy_chain_solid_pipe_model','Office Outside', 'Imp Italy Solid Pipe');
  }
  
  private function get_choco_chain_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('choco_chain_solid_pipes', 'choco_chains', 'choco_chain_solid_pipe_model', 'Office Outside', 'Choco Chain Solid Pipe');

  }
  // private function get_nawabi_chain_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('nawabi_chain_solid_pipes', 'nawabi_chains', 'solid_pipe_model', 'Office Outside', 'Nawabi Chain Solid Pipe');
  // }
  // private function get_lopster_making_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('lopster_making_chain_solid_pipes', 'lopster_making_chains', 'solid_pipe_model', 'Office Outside', 'Lopster Making Solid Pipe');
  // }
  // private function get_lotus_chain_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('lotus_chain_solid_pipes', 'lotus_chains', 'solid_pipe_model', 'Office Outside', 'Lotus Chain Solid Pipe');
  // }
  // private function get_roco_choco_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('roco_choco_chain_solid_pipes', 'roco_choco_chains', 'solid_pipe_model', 'Office Outside', 'Roco Choco Solid Pipe');
  // }
  private function get_rope_chain_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('rope_chain_solid_pipes', 'rope_chains', 'rope_chain_solid_pipe_model', 'Office Outside', 'Rope Chain Solid Pipe');
  }
  private function get_machine_chain_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('machine_chain_solid_pipes', 'machine_chains', 'machine_chain_solid_pipe_model', 'Office Outside', 'Machine Chain Solid Pipe');
  }
  private function get_sisma_chain_solid_pipe(){
    $this->get_chain_process_balance_with_process_name('sisma_chain_solid_pipes', 'sisma_chains', 'sisma_chain_solid_pipe_model', 'Office Outside', 'Sisma Chain Solid Pipe');
  }
  // private function get_solid_machine_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_machine_chain_solid_pipes', 'solid_machine_chains', 'solid_pipe_model', 'Office Outside', 'Solid Machine Solid Pipe');
  // }private function get_solid_rope_solid_pipe(){
  //   $this->get_chain_process_balance_with_process_name('solid_rope_chain_solid_pipes', 'solid_rope_chains', 'solid_pipe_model', 'Office Outside', 'Solid Rope Solid Pipe');
  // }
  // private function get_hand_made_solid_pipe(){
  //     $this->get_chain_process_balance_with_process_name('hand_made_chain_solid_pipes', 'hand_made_chains', 'solid_pipe_model', 'Office Outside', 'Hand Made Solid Pipe');
  //   }
  // private function get_indo_tally_solid_pipe(){
  //     $this->get_chain_process_balance_with_process_name('indo_tally_chain_solid_pipes', 'indo_tally_chains', 'solid_pipe_model', 'Office Outside', 'Indo tally Solid Pipe');
  //   }
  private function get_hollow_choco_solid_wire(){
    $this->get_chain_process_balance_with_process_name('hollow_choco_chain_solid_wires', 'hollow_choco_chains', 'hollow_choco_chain_solid_wire_model','Office Outside', 'Hollow Choco Solid Wire');
  }

  private function get_hollow_bangle_solid_wire(){
    $this->get_chain_process_balance_with_process_name('hollow_bangle_chain_solid_wires', 'hollow_bangle_chains', 'hollow_bangle_chain_solid_wire_model','Office Outside', 'Hollow Bangle Solid Wire');
  }

  private function get_imp_italy_solid_wire(){
    $this->get_chain_process_balance_with_process_name('imp_italy_chain_solid_wires', 'imp_italy_chains', 'imp_italy_chain_solid_wire_model','Office Outside', 'Imp Italy Solid Wire');
  }
  
  private function get_choco_chain_solid_wire(){
    $this->get_chain_process_balance_with_process_name('choco_chain_solid_wires', 'choco_chains', 'choco_chain_solid_wire_model', 'Office Outside', 'Choco Chain Solid Wire');

  }
  // private function get_nawabi_chain_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('nawabi_chain_solid_wires', 'nawabi_chains', 'solid_wire_model', 'Office Outside', 'Nawabi Chain Solid Wire');
  // }
  // private function get_lopster_making_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('lopster_making_chain_solid_wires', 'lopster_making_chains', 'solid_wire_model', 'Office Outside', 'Lopster Making Solid Wire');
  // }
  // private function get_lotus_chain_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('lotus_chain_solid_wires', 'lotus_chains', 'solid_wire_model', 'Office Outside', 'Lotus Chain Solid Wire');
  // }
  // private function get_roco_choco_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('roco_choco_chain_solid_wires', 'roco_choco_chains', 'solid_wire_model', 'Office Outside', 'Roco Choco Solid Wire');
  //  }
  private function get_rope_chain_solid_wire(){
    $this->get_chain_process_balance_with_process_name('rope_chain_solid_wires', 'rope_chains', 'rope_chain_solid_wire_model', 'Office Outside', 'Rope Chain Solid Wire');
  }
  private function get_machine_chain_solid_wire(){
    $this->get_chain_process_balance_with_process_name('machine_chain_chain_solid_wires', 'machine_chains', 'machine_chain_solid_wire_model', 'Office Outside', 'Machine Chain Solid Wire');
  }
  private function get_sisma_chain_solid_wire(){
    $this->get_chain_process_balance_with_process_name('sisma_chain_chain_solid_wires', 'sisma_chains', 'sisma_chain_solid_wire_model', 'Office Outside', 'Sisma Chain Solid Wire');
  }
  // private function get_solid_machine_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('solid_machine_chain_solid_wires', 'solid_machine_chains', 'solid_wire_model', 'Office Outside', 'Solid Machine Solid Wire');
  // }private function get_solid_rope_solid_wire(){
  //   $this->get_chain_process_balance_with_process_name('solid_rope_chain_solid_wires', 'solid_rope_chains', 'solid_wire_model', 'Office Outside', 'Solid Rope Solid Wire');
  // }
  // private function get_hand_made_solid_wire(){
  //     $this->get_chain_process_balance_with_process_name('hand_made_chain_solid_wires', 'hand_made_chains', 'solid_wire_model', 'Office Outside', 'Hand Made Solid Wire');
  //   }
  // private function get_indo_tally_solid_wire(){
  //     $this->get_chain_process_balance_with_process_name('indo_tally_chain_solid_wires', 'indo_tally_chains', 'solid_wire_model', 'Office Outside', 'Indo tally Solid Wire');
  //   }
  //END


  //KA CHain Pending
  // private function get_ka_chain_pending_process() {
  //   $select['in_out']  = '0 as in_weight,product_name,
  //                         0 as in_weight_gross,
  //                         0 as in_weight_fine,
  //                         0 as out_weight';
  //   $select['balance'] = '0 as balance,
  //                         0 as balance_gross,
  //                         0 as balance_fine';                      
  //   $this->stock_summary_query('ka_chain_pending_process', 'processes', 'process_model', $select, 
  //                                 array('process_name' => array('Box Chain Process',
  //                                                               'Anchor Process',
  //                                                               'Ashish Process',
  //                                                               'Laser Process',
  //                                                               'Vishnu Process',
  //                                                               'Hammering Process',
  //                                                               'Hammering II Process',
  //                                                               'Clipping Process', 
  //                                                               'CNC Process',
  //                                                               'DC Process',
  //                                                               'Round and Ball Chain Process'),
  //                                       'id not in (select parent_id from processes where product_name = "KA Chain")' => NULL));
  // }

  private function get_office_outside() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          sum(out_weight) as out_weight';
    $select['balance'] = 'sum(balance) as balance,
                          sum(balance_gross) as balance_gross,
                          sum(balance_fine) as balance_fine';
    $this->stock_summary_query('office_outside', 'processes', 'process_model', $select, 
                               array('product_name' => 'Office Outside', 
                                     'process_name not like ' => 'Pipe and Para%',
                                     'process_name not' => array(
                                      'Imp Italy Dye Process',
                                      'Hollow Choco Dye Process', 
                                      'Choco Chain Dye Process', 
                                      'Nawabi Chain Dye Process', 
                                      'Lotus Dye Process', 
                                      'Roco Choco Dye Process',
                                      "Indo tally Cutting Pipe","Indo tally Hard Wire","Indo tally Hollow Pipe","Indo tally Solid Pipe","Indo tally Solid Wire",
                                      "Choco Chain Cutting Pipe","Choco Chain Hard Wire","Choco Chain Hollow Pipe","Choco Chain Solid Pipe","Choco Chain Solid Wire",
                                      "Imp Italy Cutting Pipe","Imp Italy Hard Wire","Imp Italy Hollow Pipe","Imp Italy Solid Pipe","Imp Italy Solid Wire",
                                      "Lopster Making Cutting Pipe","Lopster Making Hard Wire","Lopster Making Hollow Pipe","Lopster Making Solid Pipe","Lopster Making Solid Wire",
                                      "Lotus Chain Cutting Pipe","Lotus Chain Hard Wire","Lotus Chain Hollow Pipe","Lotus Chain Solid Pipe","Lotus Chain Solid Wire",
                                      "Hollow Bangle Cutting Pipe","Hollow Bangle Hard Wire","Hollow Bangle Hollow Pipe","Hollow Bangle Solid Pipe","Hollow Bangle Solid Wire",
                                      "Hollow Choco Cutting Pipe","Hollow Choco Hard Wire","Hollow Choco Hollow Pipe","Hollow Choco Solid Pipe","Hollow Choco Solid Wire",
                                      "Machine Chain Cutting Pipe","Machine Chain Hard Wire","Machine Chain Hollow Pipe","Machine Chain Solid Pipe","Machine Chain Solid Wire",
                                      "Rope Chain Cutting Pipe","Rope Chain Hard Wire","Rope Chain Hollow Pipe","Rope Chain Solid Pipe","Rope Chain Solid Wire",
                                      "Nawabi Chain Cutting Pipe","Nawabi Chain Hard Wire","Nawabi Chain Hollow Pipe","Nawabi Chain Solid Pipe","Nawabi Chain Solid Wire",
                                      "Round Box Cutting Pipe","Round Box Hard Wire","Round Box Hollow Pipe","Round Box Solid Pipe","Round Box Solid Wire",
                                      "Sisma Chain Cutting Pipe","Sisma Chain Hard Wire","Sisma Chain Hollow Pipe","Sisma Chain Solid Pipe","Sisma Chain Solid Wire",
                                      "Solid Machine Cutting Pipe","Solid Machine Hard Wire","Solid Machine Hollow Pipe","Solid Machine Solid Pipe","Solid Machine Solid Wire",
                                      "Solid Rope Cutting Pipe","Solid Rope Hard Wire","Solid Rope Hollow Pipe","Solid Rope Solid Pipe","Solid Rope Solid Wire",
                                      "Roco Choco Cutting Pipe","Roco Choco Hard Wire","Roco Choco Hollow Pipe","Roco Choco Solid Pipe","Roco Choco Solid Wire",
                                      "Lopster Making Cutting Pipe","Lopster Making Hard Wire","Lopster Making Hollow Pipe","Lopster Making Solid Pipe","Lopster Making Solid Wire",
                                      "Hand Made Cutting Pipe","Hand Made Hard Wire","Hand Made Hollow Pipe","Hand Made Solid Pipe","Hand Made Solid Wire"),
                                     'balance != ' => 0), $this->process_group_by_fields);
  }

  private function get_office_outside_pipe_and_para() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          sum(out_weight) as out_weight';
    $select['balance'] = 'sum(balance) as balance,
                          sum(balance_gross) as balance_gross,
                          sum(balance_fine) as balance_fine';
    $this->stock_summary_query('office_outside_pipe_and_para', 'processes', 'process_model', $select, 
                               array('product_name' => 'Office Outside', 
                                     'process_name like ' => 'Pipe and Para%',
                                     'balance != ' => 0), $this->process_group_by_fields);
  }

  private function get_karigar_daily_drawer() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(daily_drawer_in_weight - (((hook_in - hook_out)+(sisma_in - sisma_out)) + daily_drawer_out_weight)) as balance,
                          sum((daily_drawer_in_weight - ((hook_in - hook_out)+(sisma_in - sisma_out) + daily_drawer_out_weight))) as balance_gross,
                          sum((daily_drawer_in_weight - ((hook_in - hook_out)+(sisma_in - sisma_out) + daily_drawer_out_weight)) * hook_kdm_purity / 100) as balance_fine';
    $this->stock_summary_query('karigar_daily_drawer', 'processes', 'process_model', $select, array('type != ' => 'GPC Powder'), 'concat(karigar, " - ", round(hook_kdm_purity,2))');    
  }
  private function get_internal_rejected() {
    $issue_department_details=$this->issue_department_detail_model->get('process_id',array('field_name'=>"Export Internal"));

      $internal=array('product_name' => 'Internal', 'rejected != ' => 0);
      if(!empty($issue_department_details)){
        $process_ids=array_column($issue_department_details,'process_id');
        $internal['id not in ('.implode(',',$process_ids).')']=NULL;
      }
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(rejected) as balance,
                          sum(rejected) as balance_gross,
                          sum((rejected) * in_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('internal_rejected', 'processes', 'process_model', $select,$internal);    
  }

  private function get_gpc_powder() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) as balance,
                          sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight))) as balance_gross,
                          sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) * hook_kdm_purity / 100) as balance_fine';
    $this->stock_summary_query('gpc_powder', 'processes', 'process_model', $select, array('type' => 'GPC Powder'));    

    //$this->data['gpc_powder']['out_weight']    += $this->data['issue_gpc_powder']['in_weight'];
    $this->data['gpc_powder']['balance']       -= $this->data['issue_gpc_powder']['in_weight'];
    $this->data['gpc_powder']['balance_gross'] -= $this->data['issue_gpc_powder']['in_weight_gross'];
    $this->data['gpc_powder']['balance_fine']  -= $this->data['issue_gpc_powder']['in_weight_fine'];
  }  

  private function get_issue_gpc_powder() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(in_weight)) as balance,
                          (sum(in_weight)) as balance_gross,
                          (sum(in_weight * in_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_gpc_powder', 'issue_departments', 'issue_department_model', 
                               $select, array('product_name'=> array('GPC Powder')));
  }

  private function get_gpc_out() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_gpc_out) as balance,
                          sum((balance_gpc_out) * out_purity / 100) as balance_gross,
                          sum((balance_gpc_out) * out_purity / 100  * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('gpc_out', 'processes', 'process_model', $select, 
                                  array('product_name not in ("Finished Goods Receipt","Refresh") AND process_name not in ("Refresh Final Process")' => NULL, 'balance_gpc_out != ' => 0), $this->group_by_id);
  }
  private function get_refresh_gpc_out() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_gpc_out) as balance,
                          sum((balance_gpc_out) * out_purity / 100) as balance_gross,
                          sum((balance_gpc_out) * out_purity / 100  * out_lot_purity / 100) as balance_fine';

    $this->stock_summary_query('refresh_gpc_out', 'processes', 'process_model', $select, 
                                  array('product_name in ("Refresh") OR process_name in ("Refresh Final Process")' =>NULL, 'balance_gpc_out != ' => 0), $this->group_by_id);
  }

  private function get_hallmark_out() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_hallmark_out) as balance,
                          sum((balance_hallmark_out) * out_purity / 100) as balance_gross,
                          sum((balance_hallmark_out) * out_purity / 100  * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('hallmark_out', 'processes', 'process_model', $select, 
                                  array('balance_hallmark_out != ' => 0));
  }

  private function get_hallmark_subcontracted() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(issue_hallmark_out - hallmark_in) as balance,
                          sum((issue_hallmark_out - hallmark_in) * out_purity / 100) as balance_gross,
                          sum((issue_hallmark_out - hallmark_in) * out_purity / 100  * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('hallmark_subcontracted', 'processes', 'process_model', $select, 
                                  array('hallmark_out != ' => 0));
  }

  private function get_finished_goods_receipt() {
    $select['in_out']  = 'sum(gpc_out) as in_weight,product_name,
                          sum(gpc_out * in_purity / 100) as in_weight_gross,
                          sum(gpc_out * in_purity / 100  * in_lot_purity / 100) as in_weight_fine,
                          sum(gpc_out) as out_weight';
    $select['balance'] = $this->zero_balance_select;
    $this->stock_summary_query('finished_goods_receipt', 'processes', 'process_model', 
                               $select, array('product_name' => 'Finished Goods Receipt'));
  }

  private function get_stock_finished_goods_receipt() {
    $select['in_out']  = 'sum(gpc_out) as in_weight,product_name,
                          sum(gpc_out * in_purity / 100) as in_weight_gross,
                          sum(gpc_out * in_purity / 100  * in_lot_purity / 100) as in_weight_fine,
                          sum(issue_gpc_out) as out_weight';
    $select['balance'] = 'sum(balance_gpc_out) as balance,
                          sum((balance_gpc_out) * in_purity / 100) as balance_gross,
                          sum((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('stock_finished_goods_receipt', 'processes', 'process_model', 
                               $select, array('product_name' => 'Finished Goods Receipt'));
  }

  private function get_wastage_melting_wastage() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_melting_wastage) as balance,
                          sum(balance_melting_wastage) as balance_gross,
                          sum(balance_melting_wastage * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_melting_wastage', 'processes', 'process_model', $select,
                               array('where_not_in' => array('product_name' => array("'Receipt'", "'Chain Receipt'", "'Hallmark Receipt'","'Rhodium Receipt'")),
                                     'balance_melting_wastage != ' => 0), $this->group_by_id);
  }

  private function get_wastage_refine_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_refine_loss) as balance,
                          sum(balance_refine_loss) as balance_gross,
                          sum(balance_refine_loss * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_refine_loss', 'processes', 'process_model', $select,
                               array('balance_refine_loss != ' => 0,
                                    'product_name != ' => 'Melting Wastage Refine Out'), $this->group_by_id);
    $fire_tounch_loss_fine_parent_ids=$this->process_model->get('parent_id',array('balance_refine_loss != ' => 0,'product_name != ' => 'Melting Wastage Refine Out'));
   //pd($this->data);
    $fire_tounch_loss_fine_parent_ids=array_column($fire_tounch_loss_fine_parent_ids,'parent_id');
    if(!empty($fire_tounch_loss_fine_parent_ids)){

    $fire_tounch_loss_fine=$this->process_model->find('sum(((fire_tounch_in*out_lot_purity)/100)-((fire_tounch_out*fire_tounch_purity)/100)-((fire_tounch_fine*100)/100)) as balance_fine',array('id'=>$fire_tounch_loss_fine_parent_ids));
    }

    $this->data['wastage_refine_loss_fire_tounch_daily_drawer_wastage']['balance_fine']=(!empty($fire_tounch_loss_fine['balance_fine']))?$fire_tounch_loss_fine['balance_fine']:0;

  }

  private function get_melting_wastage_refine_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_refine_loss) as balance,
                          sum(balance_refine_loss) as balance_gross,
                          sum(balance_refine_loss * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('melting_wastage_refine_loss', 'processes', 'process_model', $select,
                               array('balance_refine_loss != ' => 0,
                                     'product_name' => 'Melting Wastage Refine Out'), $this->group_by_id);
  }

  private function get_issue_melting_wastage_refine_loss() {
    $select['in_out']  = 'sum(balance_refine_loss) as in_weight,product_name,
                      sum(balance_refine_loss) as in_weight_gross,
                      0 as in_weight_fine';
    $select['balance'] = 'sum(balance_refine_loss) as balance,
                          sum(balance_refine_loss) as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('issue_melting_wastage_refine_loss', 'processes', 'process_model', $select,
                               array('balance_refine_loss != ' => 0,
                                     'product_name' => 'Melting Wastage Refine Out'));
 }
  private function get_wastage_walnut_hcl_gross_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(hcl_loss) as balance,
                          sum(hcl_loss * (in_purity - 100) / 100) as balance_gross,
                          sum(hcl_loss * (in_purity - 100) / 100 * in_lot_purity / 100)  as balance_fine';
    $this->stock_summary_query('wastage_walnut_hcl_gross_loss', 'processes', 'process_model', $select, array('hcl_loss != ' => 0, 'department_name' => 'Walnut'), $this->wastage_group_by_fields);
  }

  private function get_wastage_hcl_gross_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          sum(balance_hcl_loss) as balance_gross,
                          sum(balance_hcl_loss * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_hcl_gross_loss', 'processes', 'process_model', $select, 
        array('balance_hcl_loss !=' => 0, 
              'department_name != ' => 'Walnut'), $this->wastage_group_by_fields);
  }

  private function get_hcl_gross_loss_issue() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          (-1 * sum(issue_hcl_loss)) as balance_gross,
                          (-1 * sum(issue_hcl_loss * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('hcl_gross_loss_issue', 'processes', 'process_model', $select);
  }

  private function get_wastage_tounch_in() {
    $select['in_out']  = '0 as in_weight,product_name,
                          0 as in_weight_gross,
                          0 as in_weight_fine,  
                          0 as out_weight';
    $select['balance'] = 'sum(tounch_in - tounch_ghiss - tounch_out) as balance,
                          sum(tounch_in - tounch_ghiss - tounch_out) as balance_gross,
                          sum((tounch_in - tounch_ghiss - tounch_out) * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_tounch_in', 'processes', 'process_model', $select, array('tounch_in !='=>0), $this->wastage_group_by_fields);
  }

  private function get_wastage_fire_tounch_in() {
    $select['in_out']  = '0 as in_weight,product_name,
                          0 as in_weight_gross,
                          0 as in_weight_fine,  
                          0 as out_weight';
    $select['balance'] = 'sum(fire_tounch_in - fire_tounch_out - fire_tounch_gross) as balance,
                          sum(fire_tounch_in - fire_tounch_out - fire_tounch_gross) as balance_gross,
                          sum((fire_tounch_in - fire_tounch_out - fire_tounch_gross) * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_fire_tounch_in', 'processes', 'process_model', $select, array('fire_tounch_in !='=>0), $this->wastage_group_by_fields);
  }

  // private function get_fire_tounch_out() {
  //   $select['in_out']  = 'sum(fire_tounch_out) as in_weight,product_name,
  //                         sum(fire_tounch_out) as in_weight_gross,
  //                         sum(fire_tounch_out * wastage_lot_purity / 100) as in_weight_fine,  
  //                         sum(out_fire_tounch_out) as out_weight';
  //   $select['balance'] = 'sum(balance_fire_tounch_out) as balance,
  //                         sum(balance_fire_tounch_out) as balance_gross,
  //                         sum(balance_fire_tounch_out * wastage_lot_purity / 100) as balance_fine';
  //   $this->stock_summary_query('fire_tounch_out', 'processes', 'process_model', $select, array('fire_tounch_out != ' => 0));
  // }

  private function get_gpc_tounch_department_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          sum(balance_tounch_loss_fine) as balance_fine';
    $this->stock_summary_query('gpc_tounch_department_loss', 'processes', 'process_model', $select, 
                                        array('department_name' => array('GPC', 'GPC Or Rodium', 'Bunch GPC', 'Fancy Out'),
                                              'balance_tounch_loss_fine !=' => 0), $this->wastage_group_by_fields);
  }

  private function get_wastage_tounch_department_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          sum(balance_tounch_loss_fine) as balance_fine';
    $this->stock_summary_query('wastage_tounch_department_loss', 'processes', 'process_model', $select, 
                                        array('department_name' => array('Melting', 'Ghiss Melting', 'Daily Drawer Wastage'),
                                              'balance_tounch_loss_fine !=' => 0), $this->wastage_group_by_fields);
  }

  private function get_refine_tounch_department_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '-1 * sum(balance_refine_loss) as balance,
                          -1 * sum(balance_refine_loss) as balance_gross,
                          sum(balance_tounch_loss_fine) as balance_fine';
    $this->stock_summary_query('refine_tounch_department_loss', 'processes', 'process_model', $select, 
                                        array('department_name' => array('Refine Melting'),
                                              'balance_tounch_loss_fine !=' => 0), $this->wastage_group_by_fields);
  }

  private function get_other_tounch_department_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          sum(balance_tounch_loss_fine) as balance_fine';
    $this->stock_summary_query('other_tounch_department_loss', 'processes', 'process_model', $select,
                                    array("department_name not in ('GPC', 'GPC Or Rodium', 'Bunch GPC', 'Fancy Out', 'Melting', 'Ghiss Melting', 'Daily Drawer Wastage', 'Refine Melting')" => NULL,
                                          'balance_tounch_loss_fine !=' => 0), $this->wastage_group_by_fields);
  }

  private function get_wastage_loss() {
    $select['in_out']  =  $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_loss) as balance,
                          sum((balance_loss) * wastage_purity / 100) as balance_gross,
                          sum((balance_loss) * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_loss', 'processes', 'process_model', $select, array('product_name != ' => 'Ghiss Out',
                                                                                            'balance_loss != ' => 0), 'department_name');
                                                                                    //'process_name != ' => 'hcl',
                                                                                    //'where_not_in' => array('department_name' => array("'GPC'", "'Stripping'")),
                                                                                    //'(loss + karigar_loss + pending_loss) != ' => 0));
  }

  private function get_wastage_ghiss_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(balance_loss) as balance,
                          sum(balance_loss * wastage_purity / 100) as balance_gross,
                          sum(balance_loss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('wastage_ghiss_loss', 'processes', 'process_model', $select, array('product_name' => 'Ghiss Out',
                                                                                                  'balance_loss != ' => 0), $this->wastage_group_by_fields);
  }

  private function get_wastage_fire_tounch_gross_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    //$select['balance'] = 'sum(fire_tounch_gross *wastage_lot_purity/100 - fire_tounch_fine) as balance,
     //                     sum(fire_tounch_gross *wastage_lot_purity/100 - fire_tounch_fine) as balance_gross,
      //                    0 as balance_fine';
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          0 as balance_fine';                          
    $this->stock_summary_query('wastage_fire_tounch_gross_loss', 'processes', 'process_model', $select,
                               array('fire_tounch_out != ' => 0), $this->wastage_group_by_fields);
  }

  private function get_copper(){
    $select['in_out']  = 'sum(copper_out) as in_weight,product_name,
                          sum(copper_out) as in_weight_gross,
                          sum((copper_out * in_lot_purity) / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(copper_out) as balance,
                          sum(copper_out) as balance_gross,
                          sum((copper_out * in_lot_purity) / 100) as balance_fine';
    $this->stock_summary_query('copper', 'processes', 'process_model', $select);
  }

  /*private function get_rnd_stock_in_summary() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross, 
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine, 
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('rnd_stock_in_summary', 'rnds', 'rnd_receipt_model', $select);
  }*/

 /* private function get_rnd_stock_out_summary() {
    $select['in_out']  = '0 as in_weight,
                          0 as in_weight_gross, 
                          0 as in_weight_fine, 
                          sum(out_weight) as out_weight';
    $select['balance'] = '-sum(out_weight) as balance,
                          -sum(out_weight) as balance_gross,
                          -sum(out_weight * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('rnd_stock_out_summary', 'rnds', 'rnd_issue_model', $select);
  }*/

  private function get_liquor_stock(){
    $select['in_out']  = 'sum(liquor_in) as in_weight,product_name,
                          sum(liquor_in) as in_weight_gross,
                          0 as in_weight_fine,
                          sum(liquor_out) as out_weight';
    $select['balance'] = 'sum(liquor_in - liquor_out) as balance,
                          0 as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('liquor_stock', 'processes', 'process_model', $select);
  }

  private function get_issue_department() {
    $select['in_out']  = 'sum(issue_gpc_out) as in_weight,product_name,
                          sum(issue_gpc_out) as in_weight_gross,
                          sum(issue_gpc_out * out_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_gpc_out)) as balance,
                          (sum(issue_gpc_out)) as balance_gross,
                          (sum(issue_gpc_out * out_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_department', 'processes', 'process_model', $select);
  }

  private function get_issue_department_gpc_out() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_gpc_out', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'GPC Out'));
  }

  private function get_issue_department_hallmark_out() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_hallmark_out', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Hallmark Out'));
  }

  private function get_extra_packing_slip() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = 'sum(packing_slip_balance) as balance,
                          sum(packing_slip_balance * wastage_purity / 100) as balance_gross,
                          sum(packing_slip_balance * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('extra_packing_slip', 'processes', 'process_model', $select, array('product_name' => 'Internal','packing_slip_balance <' => 0));
}
  private function get_issue_department_packing_slip() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_packing_slip', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Packing Slip'));
  }private function get_issue_department_qc_out() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_qc_out', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'QC Out'));
  }
  private function get_issue_department_export_internal() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_export_internal', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Export Internal'));
  }private function get_issue_department_domestic_internal() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_domestic_internal', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Domestic Internal'));
  }
  private function get_issue_department_hu_id() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_hu_id', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Huid'));
  }private function get_issue_department_hallmark_receipt() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_hallmark_receipt', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Hallmark Receipt'));
  }

  private function get_issue_department_finish_good() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(in_weight) as balance,
                          sum(in_weight) as balance_gross,
                          sum(in_weight * in_purity / 100) as balance_fine';
    $this->stock_summary_query('issue_department_finish_good', 'issue_departments', 'issue_department_model', $select, array('product_name' => 'Finish Good'));
  }

  private function get_issue_department_melting_wastage() {
    $select['in_out']  = 'sum(issue_melting_wastage) as in_weight,product_name,
                          sum(issue_melting_wastage) as in_weight_gross,
                          sum(issue_melting_wastage * wastage_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_melting_wastage)) as balance,
                          (sum(issue_melting_wastage)) as balance_gross,
                          (sum(issue_melting_wastage * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_department_melting_wastage', 'processes', 'process_model', $select);

  }private function get_issue_department_refine_loss() {
    $select['in_out']  = 'sum(issue_refine_loss) as in_weight,product_name,
                          sum(issue_refine_loss) as in_weight_gross,
                          sum(issue_refine_loss * wastage_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_refine_loss)) as balance,
                          (sum(issue_refine_loss)) as balance_gross,
                          (sum(issue_refine_loss * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_department_refine_loss', 'processes', 'process_model', $select);
  }

  private function get_issue_department_daily_drawer_wastage() {
    $select['in_out']  = 'sum(issue_daily_drawer_wastage) as in_weight,product_name,
                          sum(issue_daily_drawer_wastage) as in_weight_gross,
                          sum(issue_daily_drawer_wastage * wastage_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_daily_drawer_wastage)) as balance,
                          (sum(issue_daily_drawer_wastage)) as balance_gross,
                          (sum(issue_daily_drawer_wastage * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_department_daily_drawer_wastage', 'processes', 'process_model', $select);
  }

  private function get_issue_hcl_loss() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          (sum(issue_hcl_loss)) as balance_gross,
                          (sum(issue_hcl_loss * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_hcl_loss', 'processes', 'process_model', $select);
  }

  private function get_issue_tounch_loss_fine() {
    $select['in_out']  = $this->zero_in_out_select;
    $select['balance'] = '0 as balance,
                          0 as balance_gross,
                          sum(issue_tounch_loss_fine) as balance_fine';
    $this->stock_summary_query('issue_tounch_loss_fine', 'processes', 'process_model', $select);
  }

  private function get_issue_ghiss() {
    $select['in_out']  = 'sum(issue_ghiss) as in_weight,product_name,
                          sum(issue_ghiss) as in_weight_gross,
                          sum(issue_ghiss * wastage_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_ghiss)) as balance,
                          (sum(issue_ghiss)) as balance_gross,
                          (sum(issue_ghiss * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_ghiss', 'processes', 'process_model', $select);
  }

  private function get_issue_daily_drawer() {
    $select['in_out']  = 'sum(in_weight) as in_weight,
                          sum(in_weight) as in_weight_gross,
                          sum(in_weight * in_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(in_weight)) as balance,
                          (sum(in_weight)) as balance_gross,
                          (sum(in_weight * in_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_daily_drawer', 'daily_drawers', 'daily_drawer_issue_department_model', $select);
  }

  /*private function get_refresh_rnd_issue() {
    $select['in_out']  = 'sum(out_weight) as in_weight,product_name,
                          sum(out_weight) as in_weight_gross, 
                          sum(out_weight * out_lot_purity / 100) as in_weight_fine, 
                          0 as out_weight';
    $select['balance'] = 'sum(out_weight) as balance,
                          sum(out_weight) as balance_gross,
                          sum(out_weight * out_lot_purity / 100) as balance_fine';
    $this->stock_summary_query('refresh_rnd_issue', 'rnds', 'rnd_issue_model', $select);
  }*/

  private function get_issue_liquor() {
    $select['in_out']  = 'sum(liquor_out) as in_weight,product_name,
                          sum(liquor_out) as in_weight_gross,
                          0 as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = 'sum(liquor_out) as balance,
                          sum(liquor_out) as balance_gross,
                          0 as balance_fine';
    $this->stock_summary_query('issue_liquor', 'processes', 'process_model', $select);
  }

  private function get_issue_loss() {
    $select['in_out']  = 'sum(issue_loss) as in_weight,product_name,
                          sum(issue_loss * wastage_purity / 100) as in_weight_gross,
                          sum(issue_loss * wastage_purity / 100 * wastage_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(issue_loss)) as balance,
                          (sum(issue_loss * wastage_purity / 100)) as balance_gross,
                          (sum(issue_loss * wastage_purity / 100 * wastage_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_loss', 'processes', 'process_model', $select);
  }

  private function get_issue_loss_melting() {
    $select['in_out']  = 'sum(in_weight) as in_weight,product_name,
                          sum(in_weight * in_purity / 100) as in_weight_gross,
                          sum(in_weight * in_purity / 100 * in_lot_purity / 100) as in_weight_fine,
                          0 as out_weight';
    $select['balance'] = '(sum(in_weight)) as balance,
                          (sum(in_weight * in_purity / 100)) as balance_gross,
                          (sum(in_weight * in_purity / 100 * in_lot_purity / 100)) as balance_fine';
    $this->stock_summary_query('issue_loss_melting', 'processes', 'process_model', $select, array('department_name' => 'Loss Transfer'));
  }

  private function get_adjustment_summary() {
    $select['in_out']  = '0 as in_weight, 0 as in_weight_gross, 0 as in_weight_fine, 0 as out_weight';
    $select['balance'] = 'sum(balance) as balance,
                          sum(balance_gross) as balance_gross,
                          sum(balance_fine) as balance_fine';
    $this->stock_summary_query('adjustment_summary', 'stock_summary_reports', 'adjustment_record_model', $select);
  }
} 
  
