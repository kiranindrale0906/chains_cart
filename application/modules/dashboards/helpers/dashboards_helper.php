<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array();
}

function get_dashboard_url(){
    $chains =  array(
      // array('name'=>'Hollow Chain','id' =>'Hollow Chain'),
      'ropechain@argold.com'    => 'rope_chains/dashboards',
      'machinechain@argold.com' => 'machine_chains/dashboards',
      'chocochain@argold.com'        =>'choco_chains/dashboards',
      'roundboxchain@argold.com'     =>'round_box_chains/dashboards',
      'sismachain@argold.com' =>'sisma_chains/dashboards',
      'impitalychain@argold.com' =>'imp_italy_chains/dashboards', 
      'indotallychain@argold.com' =>'indo_tally_chains/dashboards', 
      'hollowchocochain@argold.com' =>'hollow_choco_chains/dashboards', 
      'fancychain@argold.com' =>'fancy_chains/dashboards',
      'refreshchain@argold.com' =>'melting_lots/melting_lots',
      'dailydrawerchain@argold.com' =>'melting_lots/melting_lots',
      'admin@argold.com' =>'dashboards/common_dashboards',
      'backup_admin@argold.com' =>'dashboards/common_dashboards',
      'swarnshilp@arf.com' =>'ka_chains/ka_chain_uncut_list',
      'factoryorder@swarnshilp.com' =>'ka_chains/ka_chain_factory_order_masters',
      'market_order@arf.com' =>'ka_chains/ka_chain_factory_order_masters',
      'projet@arc.com' =>'arc_orders/project_processes',
      'projet@arc.com' =>'arc_orders/project_processes',
      'wax@arc.com' =>'arc_orders/wax_processes',
      'waxsetting@arc.com' =>'arc_orders/wax_setting_processes',
    
    );
    if(HOST == 'ARC'){
      if(isset($chains[$_SESSION['email_id']])){
       return $chains[$_SESSION['email_id']];
      }elseif($_SESSION['name']=="dilkhush1"){
       return 'stock_summary_reports/stock_summary_reports';
      }elseif($_SESSION['name']=="dashboard"){
       return 'dashboards/process_dashboards';
      }else{
        return 'melting_lots/melting_lots';
      }
    }
    if(HOST == 'Export') return 'export_internals/export_internal_receipts';
    if(HOST == 'Domestic') return 'domestic_internals/domestic_internal_receipts';
    if(HOST == 'Hallmark') return 'hallmarking/hallmark_receipt_processes';
    if(HOST == 'AR Gold Internal') return 'melting_lots/melting_lots';
    if(in_array('departments/melting', $_SESSION['controller_list'])){
      $redirect_string='departments/melting';
    }elseif(in_array('departments/melting', $_SESSION['controller_list'])){
      $redirect_string='departments/melting';
    }elseif($_SESSION['name']=="Room"){
      $redirect_string='processes/processes';
    }elseif($_SESSION['name']=="GPC HOLD"){
      $redirect_string='gpc_outs/gpc_out_hold_processes';
    }else{
      $redirect_string='melting_lots/melting_lots';
    }
    return isset($chains[$_SESSION['email_id']]) ? $chains[$_SESSION['email_id']] : $redirect_string;
}
