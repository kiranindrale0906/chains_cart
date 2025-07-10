<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "REPORT PROCESS",
    "primary_table"       => "processes",
    "default_column"      => "id",
    "table"               => "processes",
    "join_columns"        => "",
    "join_type"           => "",
    "where"               => "",
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "processes",
    "add_title"           => "",
    "export_title"        => "",
    "edit"                => "",
  );
}


/*
  0 => column title
  1 => column name
  2 => order flag
  3 => order column
  4 => filter flag
  5 => expand text flag
  6 => select column
*/
  
function list_settings() {
  return array(
    array("ID", "id", TRUE, "id", TRUE, TRUE),
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("Melting No", "melting_lot_id", TRUE, "melting_lot_id", TRUE, TRUE),
    array("Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
    array("FE In", "fe_in", TRUE, "fe_in", TRUE, TRUE),
    array("FE Out", "fe_out", TRUE, "fe_out", TRUE, TRUE),
    array("TOUNCH", "tounch", TRUE, "tounch", TRUE, TRUE),
    // array("TOUNCH GROSS", "tounch_gross", TRUE, "tounch_gross", TRUE, TRUE),
    array("TOUNCH No", "tounch_no", TRUE, "tounch_no", TRUE, TRUE),
    array("Ghiss", "ghiss", TRUE, "ghiss", TRUE, TRUE),
    //array("Ghiss Gross", "ghiss_gross", TRUE, "ghiss_gross", TRUE, TRUE),
    array("Ghiss Fine", "ghiss_fine", TRUE, "ghiss_fine", TRUE, TRUE),
    array("Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Purity(%)", "gold_purity", TRUE, "gold_purity", TRUE, TRUE),
    array("Expected Out", "expected_out_weight", TRUE, "expected_out_weight", TRUE, TRUE),
    array("Loss", "loss", TRUE, "loss", TRUE, TRUE),
    array("Loss Gross", "loss_gross", TRUE, "loss_gross", TRUE, TRUE),
    array("Loss Fine", "loss_fine", TRUE, "loss_fine", TRUE, TRUE),
    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("IN", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("Hook In", "hook_in", TRUE, "hook_in", TRUE, TRUE),
    array("Hook Out", "hook_out", TRUE, "hook_out", TRUE, TRUE),
    array("Sisma In", "sisma_in", TRUE, "sisma_in", TRUE, TRUE),
    array("Sisma Out", "sisma_out", TRUE, "sisma_out", TRUE, TRUE),
    array("Spring In", "spring_in", TRUE, "spring_in", TRUE, TRUE),
    array("Spring Out", "spring_out", TRUE, "spring_out", TRUE, TRUE),
    array("Wastage", "wastage", TRUE, "wastage", TRUE, TRUE),
    array("Wastage GROSS", "wastage_gross", TRUE, "wastage_gross", TRUE, TRUE),
    // array("Wastage GOLD", "wastage_gold", TRUE, "wastage_gold", TRUE, TRUE),
    // array("Wastage GOLD FINE", "wastage_gold_fine", TRUE, "wastage_gold_fine", TRUE, TRUE),
    array("Wastage FE", "wastage_fe", TRUE, "wastage_fe", TRUE, TRUE),
    array("Wastage AU FE", "wastage_au_fe", TRUE, "wastage_au_fe", TRUE, TRUE),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE),
    array("Balance GROSS", "balance_gross", TRUE, "balance_gross", TRUE, TRUE));
}
function get_process_structures_for_room($room_name='') {
//pd($room_name);  
if($room_name=='Melting Room'){
    $process_name='arc_melting_common';
    return array(
      'Melting' => melting_structure($process_name),
      );
  }elseif($room_name=='Stone Setting Room'){
    $process_name='common_arc';
    return array(
      'Stone Setting' => stone_setting_structure($process_name),
      );
  }elseif($room_name=='Walnut Room'){
    $process_name='common_walnut';
    return array(
      'Walnut' => walnut_structure($process_name),
      );
  }elseif($room_name=="Filing Room"){
    $process_name='pendent_set_common';
    return array(
      'Filing' => filing_structure($process_name),
      );
  }elseif($room_name=='Round and Ball Chain Room'){
    $process_name='round_and_ball_chain_common';
    return array(
      'Round and Ball Chain' => round_and_ball_chain_structure($process_name),
      );
  }elseif($room_name=='CNC Process Room'){
    $process_name='cnc_department_common';
    return array(
      'CNC Department' => cnc_department_structure($process_name),
      );
  }elseif($room_name=='DC Process Room'){
    $process_name='dc_department_common';
    return array(
      'DC Department' => dc_department_structure($process_name),

      );
  }elseif($room_name=='GPC Room'){
    $process_name='gpc_common';
    return array(
      'GPC' => gpc_structure($process_name),

      );
  }elseif($room_name=='Refiling Room'){
    $process_name='refiling_common';
    return array(
      'Refiling' => refiling_structure($process_name),

      );
  }elseif($room_name=='Buffing Refresh Room'){
    $process_name='buffing_refresh_common';
    return array(
      'Buffing Refresh' => buffing_refresh_structure($process_name),

      );
  }elseif($room_name=='Pre Polish Room'){
    $process_name='pre_polish_common';
    return array(
      'Pre Polish' => pre_polish_structure($process_name),

      );
  }elseif($room_name=='Buffing I Room'){
    $process_name='buffing_i_common';
    return array(
      'Buffing I' => buffing_structure($process_name),

      );
  }else{
    $process_name='arc_buffing_common';
    return array(
      'Buffing' => buffing_structure($process_name),
      );
    }
}

if (!function_exists('get_field_attribute')) {
  function get_field_attribute($table, $field) {
    return process_field_attributes($table, $field);
  }
}
/*
  | [0] => Label
  | [1] => Placeholder  
  | [2] => Mandatory/Not Mandatory
  | [3] => Class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

// function get_field_attribute($table, $field) {
//   $attributes = array();
//   $attributes["hcl_processes"] = array(
//     "id" => array("", "", FALSE, "", FALSE),
//     "product_name" => array("Product Name", "", FALSE, "", TRUE),
//     "process_name"  => array("Process Name", "", TRUE, "", TRUE),
//     "department_name"  => array("Department Name", "", FALSE, "", TRUE),
//     "lot_no" => array("Lot No", "", FALSE, "", TRUE),
//     "process_date"  => array("Date", "", FALSE, "", TRUE),
//     "in_weight"  => array("IN Weight", "", FALSE, "", TRUE),
//     "in_purity"  => array("IN Purity", "", FALSE, "", TRUE),
//   );
//   return $attributes[$table][$field];
// }


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = "processes/processes";
  $actions["Edit"] = array("request" => "http",
                           "url" => ADMIN_PATH.$controller."/edit/".$row["id"],
                           "confirm_message" => "",
                           "class" => "btn_green",
                           "data_title" =>"View",
                            "i_class"=>"fal fa-file-alt font20");

  $actions["Delete"] = array("request" => "http",
                             "url" => ADMIN_PATH.$controller."/delete/".$row["id"],
                             "class" => "btn_red",
                             "confirm_message" => "Do you want to delete",
                             "data_title" => "Delete",
                             "i_class" => "far fa-trash-alt font20");
  return $actions;
}

function get_row_id($row_id, $department_name) {
  return strtolower(str_replace(' ', '_', $row_id.' '.str_replace('+', '_', $department_name)));
}

function get_record_groups($product_name='') {
  //if(!empty($product_name)&&  $product_name=='KA Chain'){
  $product=array('Basic'                => array('srno','product_name','process_name','department_name','description','melting_lot_chain_name','melting_lot_category_one','melting_lot_category_two','status', 'row_id'));
  //}elseif(!empty($product_name)&&  $product_name=='Sisma Chain'){
  //  $product=array('Basic'                => array('srno','product_name','process_name','department_name','description','melting_lot_chain_name','melting_lot_category_one','status'));
  //}else{
  //  $product=array('Basic'=> array('srno','product_name','process_name','department_name','description','chain_name','melting_lot_category_one','status'));
 // }
 $record_groups= array_merge($product,array(
    'Parent Lot'           => array('parent_lot_id','parent_lot_name'),  
    'Melting lot'          => array('melting_lot_id','lot_no'),
    'Description'          => array('karigar','machine_size','design_code','customer_name'),
    
    'In Weight'            => array('in_weight','in_purity','in_lot_purity'),
    'Fe'                   => array('fe_in','fe_out','wastage_fe'),
    'Copper'               => array('copper_in','copper_out'),
    'Alloy'                => array('alloy_weight','out_alloy_weight'),
    'Solder'               => array('solder_wastage','out_solder_wastage','balance_solder_wastage'),
    'Liquor'               => array('liquor_in','liquor_out'),
    'Hook'                 => array('hook_kdm_purity', 'hook_in','hook_out'),
    'Office Outside'       => array('daily_drawer_in_weight','daily_drawer_out_weight'),
    
    'Out Weight'           => array('out_weight', 'factory_out', 'customer_out', 'bounch_out', 'recutting_out', 'out_purity', 'out_lot_purity', 'wastage_purity', 'wastage_lot_purity', 'quantity'),
    
    'Melting Wastage'      => array('melting_wastage', 'in_melting_wastage', 'out_melting_wastage', 'out_opening_melting_wastage', 'issue_melting_wastage', 'balance_melting_wastage'),
    'Daily Drawer Wastage' => array('daily_drawer_wastage','out_daily_drawer_wastage','issue_daily_drawer_wastage','balance_daily_drawer_wastage'),
    'CZ Wastage' => array('cz_wastage','out_cz_wastage','issue_cz_wastage','balance_cz_wastage'),
    'HCL Wastage'          => array('hcl_wastage','out_hcl_wastage','balance_hcl_wastage'),
    
    'Ghiss'                => array('ghiss','out_ghiss', 'issue_ghiss', 'balance_ghiss'),
    'Pending Ghiss'        => array('pending_ghiss', 'out_pending_ghiss', 'balance_pending_ghiss'),
    'HCL Ghiss'            => array('hcl_ghiss','out_hcl_ghiss','balance_hcl_ghiss'),
    
    'Loss'                 => array('loss', 'refine_loss', 'out_loss', 'issue_loss', 'balance_loss'),
    'MIN /MAX HCL Loss'    => array('max_hcl_loss','min_hcl_loss'),
    'HCL Loss'             => array('refine_loss','issue_refine_loss','balance_refine_loss'),
    'Refine Loss'             => array('hcl_loss','issue_hcl_loss','balance_hcl_loss'),
    'Tounch Loss Fine'     => array('tounch_loss_fine','issue_tounch_loss_fine','balance_tounch_loss_fine'),
    
    'Tounch In'            => array('tounch_no', 'tounch_in', 'tounch_purity'),
    'Tounch Out'           => array('tounch_out', 'out_tounch_out', 'balance_tounch_out'),
    'Tounch Ghiss'         => array('tounch_ghiss','out_tounch_ghiss','balance_tounch_ghiss'), 

    'Fire Tounch In'       => array('tounch_no', 'fire_tounch_in', 'fire_tounch_purity'),
    'Fire Tounch Out'      => array('fire_tounch_out'),
    'Fire Tounch Fine'     => array('fire_tounch_fine', 'fire_tounch_gross'), 
    
    'GPC'                  => array('gpc_out', 'issue_gpc_out','balance_gpc_out'),
    'Repair out'           => array('repair_out','repair_out_quantity'),
    
    'Balance'              => array('balance','balance_gross','balance_fine'),
    
    'Created'              => array('created_at', 'created_by'),
    'Updated'              => array('updated_at', 'updated_by'),

    /* custom columns */
    'Links'                => array('previous_process', 'next_processes'),
    'Process Information'  => array('process_information'),
  ));
  return $record_groups;
}

function get_columns_with_table() {
  return array('out_melting_wastage', 'issue_melting_wastage', 'issue_daily_drawer_wastage','issue_cz_wastage', 'issue_hcl_loss', 'issue_tounch_loss_fine', 'issue_gpc_out','out_solder_wastage', 'out_daily_drawer_wastage',  'out_cz_wastage', 'out_hcl_wastage', 'out_ghiss', 'out_pending_ghiss', 'out_hcl_ghiss', 'out_loss', 'out_tounch_out', 'out_tounch_ghiss', 'out_weight', 'daily_drawer_wastage','cz_wastage', 'melting_wastage', 'hcl_wastage', 'ghiss', 'hook_in', 'hook_out', 'spring_in', 'spring_out', 'tounch_in', 'hcl_ghiss', 'quantity', 'daily_drawer_out_weight', 'pending_ghiss', 'loss', 'in_weight', 'previous_process', 'next_processes','process_information'); 
}

function get_columns_per_model() {
  return array(
    'melting_lot_detail_model' => array(
      '_common_data' => array(
        'columns'        => array('required_weight', 'created_at', 'lot_no', 'melting_lot_id'),
        'custom_headers' => array('melting_lot_id' => 'melting_lot'),
        'joins'          => array(array('melting_lots', 'melting_lots.id = melting_lot_details.melting_lot_id')),
        'select_columns' => array('required_weight', 'melting_lot_details.created_at', 'lot_no', 'melting_lot_id'),
      ),
      'out_melting_wastage' => array('conditions'         => array('greater_than_zero'),
                                     'columns_with_total' => array('required_weight')),
    ),
    'issue_department_detail_model' => array(
      '_common_data' => array(
        'same_model'         => true,
        'columns'            => array('out_weight', 'field_name', 'created_at', 'issue_department_id'),
        'custom_headers'     => array('issue_department_id' => 'issue_department'),
        'columns_with_total' => array('out_weight')
      ),

      'issue_melting_wastage'      => array('conditions' => array('field_name' => 'Melting Wastage')),
      'issue_daily_drawer_wastage' => array('conditions' => array('field_name' => 'Daily Drawer Wastage')),
      'issue_cz_wastage' => array('conditions' => array('field_name' => 'CZ Wastage')),
      'issue_hcl_loss'             => array('conditions' => array('field_name' => 'HCL Loss')),
      'issue_loss'                 => array('conditions' => array('field_name' => 'Castic Loss')),
      'issue_ghiss'                => array('conditions' => array('field_name' => array('Cutting Ghiss', 'Ice Cutting Ghiss'))),
      'issue_tounch_loss_fine'     => array('conditions' => array('field_name' => 'Tounch Loss Fine')),
      'issue_gpc_out' => array(
        'dynamic_condition' => true,
        'field'             => 'field_name',
        'dynamic_value'     => 'product_name',
        'conditions'        => array('field_name' => '{product_name}'),
      ),
    ),
    'process_out_wastage_detail_model' => array(
      '_common_data' => array(
        'columns'            => array('out_weight', 'field_name', 'created_at', 'lot_no', 'parent_id'),
        'custom_headers'     => array('parent_id' => 'parent_process'),
        'same_model'         => true,
        'joins'              => array(array('processes', 'processes.id = process_out_wastage_details.parent_id')),
        'select_columns'     => array('process_out_wastage_details.out_weight', 'field_name', 'process_out_wastage_details.created_at', 'lot_no', 'process_out_wastage_details.parent_id'),
        'columns_with_total' => array('out_weight'),
      ),
      'out_solder_wastage'       => array('conditions' => array('field_name' => 'Solder Wastage')),
      'out_daily_drawer_wastage' => array('conditions' => array('field_name' => 'Daily Drawer Wastage')),
      'out_cz_wastage' => array('conditions' => array('field_name' => 'CZ Wastage')),
      'out_hcl_wastage'          => array('conditions' => array('field_name' => 'HCL Wastage')),
      'out_ghiss'                => array('conditions' => array('field_name' => 'Ghiss Out')),
      'out_pending_ghiss'        => array('conditions' => array('field_name' => 'Pending Ghiss Out')),
      'out_hcl_ghiss'            => array('conditions' => array('field_name' => 'Hcl Ghiss Out')),
      'out_loss'                 => array('conditions' => array('field_name' => 'Loss Out')),
      'out_tounch_out'           => array('conditions' => array('field_name' => 'Tounch Out')),
      'out_tounch_out'           => array('conditions' => array('field_name' => 'Tounch Out')),
      'fire_tounch_out'          => array('conditions' => array('field_name' => 'Fire Tounch Out')),
      'out_tounch_ghiss'         => array('conditions' => array('field_name' => 'Tounch Ghiss Out')),
      'in_weight'                => array('dynamic_condition'          => true,
                                          'field'                      => 'process_out_wastage_details.parent_id',
                                          'dynamic_value'              => 'id',
                                          'conditions'                 => array('process_out_wastage_details.parent_id' => '{parent_id}'),
                                          'override_default_condition' => true,
                                          'columns_override'           => array('out_weight', 'wastage_purity', 'wastage_lot_purity', 'field_name', 'created_at', 'lot_no', 'process_id'),
                                          'custom_headers'             => array('process_id' => 'process'),
                                          'select_columns'             => array('process_out_wastage_details.out_weight', 'wastage_purity', 'wastage_lot_purity', 'field_name', 'process_out_wastage_details.created_at', 'lot_no', 'process_out_wastage_details.parent_id', 'process_id'),
                                          'joins'                      => array(array('processes', 'processes.id = process_out_wastage_details.process_id')),
                                          'columns_with_wt_avg'        => array('wastage_purity' => 'out_weight', 'wastage_lot_purity' => 'out_weight'),
                                          )
    ),
    'process_field_model' => array(
      '_common_data' => array(
        'same_model'     => true,
        'columns'        => array('id', 'created_at'),
        'custom_headers' => array('melting_lot_id' => 'melting_lot'),
      ),
      'melting_wastage'         => array('conditions' => array('melting_wastage !=' => 0),
                                         'columns' => array('melting_wastage'),
                                         'columns_with_total' => array('melting_wastage')),
      
      'out_weight'              => array('conditions' => array('out_weight !=' => 0),
                                         'columns' => array('out_weight'),
                                         'columns_with_total' => array('out_weight')),
      'daily_drawer_wastage'    => array('conditions' => array('daily_drawer_wastage !=' => 0),
                                         'columns' => array('daily_drawer_wastage')),
      'cz_wastage'    => array('conditions' => array('cz_wastage !=' => 0),
                                         'columns' => array('cz_wastage')),
      'hcl_wastage'             => array('conditions' => array('hcl_wastage !=' => 0),
                                         'columns' => array('hcl_wastage'),
                                         'columns_with_total' => array('hcl_wastage')),
      'ghiss'                   => array('conditions' => array('ghiss !=' => 0),
                                         'columns' => array('ghiss'),
                                         'columns_with_total' => array('ghiss')),
      'hook_in'                 => array('conditions' => array('hook_in !=' => 0),
                                         'columns' => array('hook_in', 'hook_kdm_purity', 'daily_drawer_type', 'karigar'),
                                         'columns_with_total' => array('hook_in')),
      'hook_out'                => array('conditions' => array('hook_out !=' => 0),
                                         'columns' => array('hook_out', 'hook_kdm_purity', 'daily_drawer_type', 'karigar'),
                                         'columns_with_total' => array('hook_out')),
      'tounch_in'               => array('conditions' => array('tounch_in !=' => 0),
                                         'columns' => array('tounch_in')),
      'hcl_ghiss'               => array('conditions' => array('hcl_ghiss !=' => 0),
                                         'columns' => array('hcl_ghiss'),
                                         'columns_with_total' => array('hcl_ghiss')),
      'quantity'                => array('conditions' => array('quantity !=' => 0),
                                         'columns' => array('quantity')),
      //'daily_drawer_in_weight'  => array('conditions' => array('daily_drawer_in_weight !=' => 0),
      //                                   'columns' => array('daily_drawer_in_weight')),
      'daily_drawer_out_weight' => array('conditions' => array('daily_drawer_out_weight !=' => 0),
                                         'columns' => array('daily_drawer_out_weight')),
      'pending_ghiss'           => array('conditions' => array('pending_ghiss !=' => 0),
                                         'columns' => array('pending_ghiss')),
      'loss'                    => array('conditions' => array('loss !=' => 0),
                                         'columns' => array('loss')),
    ),
    'process_group_model' => array(
      '_common_data' => array(
        'same_model'         => true,
        'only_for'           => array('products' => array('Rope Chain', 'Indo tally Chain', 'Hollow Choco Chain')),
        'columns'            => array('out_weight', 'lot_no', 'created_at'),
        'columns_with_total' => array('out_weight'),
      ),
      'in_weight' => array('columns_at_end'             => array('process_id'),
                           'custom_headers'             => array('process_id' => 'process'),
                           'dynamic_condition'          => true,
                           'field'                      => 'process_groups.parent_id',
                           'dynamic_value'              => 'id',
                           'conditions'                 => array('process_groups.parent_id' => '{parent_id}'),
                           'override_default_condition' => true,
                           'select_columns'             => array('out_weight', 'lot_no', 'processes.created_at', 'process_id'),
                           'joins'                      => array(array('processes', 'processes.id = process_groups.process_id'))),
    ),
    'process_model' => array(
      '_common_data' => array(
          'same_model'         => true,
          'only_for'           =>array('products' => array('Indo tally Chain'), 'departments' => array('Spring')),
          'columns'            => array('out_weight', 'lot_no', 'created_at', 'id'),
          'columns_with_total' => array('out_weight'),
      ),
      'in_weight' => array('custom_headers'             => array('id' => 'process'),
                           'override_default_condition' => true,
                           'dynamic_condition'          => true,
                           'field'                      => 'parent_lot_id',
                           'dynamic_value'              => 'parent_lot_id',
                           'conditions'                 => array('parent_lot_id' => '{parent_lot_id}', 'department_name' => 'Wire Drawing', 'status' => 'Complete')),
    ),
    
  );
}

function get_groups_to_hide_if_zero() {
  return array('Parent Lot', 'Fe', 'Copper', 'Alloy', 'Solder', 'Liquor', 'Hook', 'Office Outside', 'Melting Wastage', 'Daily Drawer Wastage', 'HCL Wastage','Ghiss', 'Pending Ghiss', 'HCL Ghiss', 'Loss', 'HCL Loss', 'Tounch Loss Fine', 'Tounch In', 'Tounch Out', 'Tounch Ghiss', 'GPC', 'Repair out');
}

function get_columns_to_disply_right() {
  return array('out_melting_wastage', 'issue_melting_wastage', 'issue_daily_drawer_wastage','issue_cz_wastage', 'issue_hcl_loss', 'issue_tounch_loss_fine', 'issue_gpc_out', 'out_solder_wastage', 'out_daily_drawer_wastage','out_cz_wastage', 'out_hcl_wastage', 'out_ghiss', 'out_hcl_ghiss', 'out_loss', 'out_tounch_out', 'out_tounch_ghiss', 'next_processes'); 
}

function get_groups_to_check_for_two_column_view() {
  return array('Solder', 'Melting Wastage', 'Daily Drawer Wastage','CZ Wastage', 'HCL Wastage', 'Ghiss', 'Pending Ghiss', 'HCL Ghiss', 'Loss', 'HCL Loss', 'Tounch Loss Fine', 'Tounch Out', 'Tounch Ghiss', 'GPC', 'Repair out', 'Hook', 'Office Outside','Out Weight','Tounch In', 'In Weight', 'Links');
}
