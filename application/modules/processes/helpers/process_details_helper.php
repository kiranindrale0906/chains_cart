<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "PROCESS DETAIL",
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


function get_row_id($melting_lot_id, $department_name) {
  return strtolower(str_replace(' ', '_', $melting_lot_id.' '.str_replace('+', '_', $department_name)));
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["processes"] = array(
    "hcl_wastage" => array("HCL Wastage", "", FALSE, "", TRUE),
    "hcl_loss" => array("HCL Loss", "", FALSE, "", TRUE),
    "out_hcl_wastage" => array("Out HCL Wastage", "", FALSE, "", TRUE),
    "balance_hcl_wastage" => array("Out HCL Wastage", "", FALSE, "", TRUE),
    "out_hcl_ghiss" => array("Out HCL Ghiss", "", FALSE, "", TRUE),
    "balance_hcl_ghiss" => array("Balance HCL Ghiss", "", FALSE, "", TRUE),
    "hcl_ghiss" => array("HCL Ghiss", "", FALSE, "", TRUE),
    'gemstone_in' => array('Gemstone In', '', FALSE, '', FALSE),
    'gemstone_out' => array('Gemstone Out', '', FALSE, '', FALSE),
    


    "melting_wastage" => array("Melting Wastage", "", FALSE, "", TRUE),
    "balance_melting_wastage" => array("Balance Melting Wastage", "", FALSE, "", TRUE),
    "melting_lot_id" => array("Melting Lot Id", "", FALSE, "", TRUE),
    "out_melting_wastage" => array("Out Melting Wastage", "", FALSE, "", TRUE),


    "daily_drawer_wastage" => array("Daily Drawer Wastage", "", FALSE, "", TRUE),
    "balance_daily_drawer_wastage" => array("Balance Daily Drawer Wastage", "", FALSE, "", TRUE),
    "out_daily_drawer_wastage" => array("Out Daily Drawer Wastage", "", FALSE, "", TRUE),
    "cz_wastage" => array("CZ Wastage", "", FALSE, "", TRUE),
    "balance_cz_wastage" => array("Balance CZ Wastage", "", FALSE, "", TRUE),
    "out_cz_wastage" => array("Out CZ Wastage", "", FALSE, "", TRUE),
    "daily_drawer_out_weight" => array("Daily Drawer Out Weight", "", FALSE, "", TRUE),
    "daily_drawer_in_weight" => array("Daily Drawer In Weight", "", FALSE, "", TRUE),


    "tounch_purity" => array("Tounch Purity", "", FALSE, "", TRUE),
    "tounch_no" => array("Tounch No", "", FALSE, "", TRUE),
    "tounch_in" => array("Tounch In", "", FALSE, "", TRUE),
    "fire_tounch_in" => array("Fire Tounch In", "", FALSE, "", TRUE),
    "tounch_out" => array("Tounch Out", "", FALSE, "", TRUE),
    "tounch_ghiss" => array("Tounch Ghiss", "", FALSE, "", TRUE),
    "tounch_loss_fine" => array("Tounch Loss Fine", "", FALSE, "", TRUE),
    "out_tounch_ghiss" => array("Out Tounch Ghiss", "", FALSE, "", TRUE),
    "out_tounch_out" => array("Out Tounch Out", "", FALSE, "", TRUE),
    "balance_tounch_out" => array("Balance Tounch Out", "", FALSE, "", TRUE),
    "balance_tounch_ghiss" => array("Balance Tounch Ghiss", "", FALSE, "", TRUE),

    "hook_in" => array("Hook In", "", FALSE, "", TRUE),
    "hook_out" => array("Hook Out", "", FALSE, "", TRUE),
    "sisma_in" => array("sisma In", "", FALSE, "", TRUE),
    "sisma_out" => array("sisma Out", "", FALSE, "", TRUE),
    
    "id" => array("", "", FALSE, "", FALSE),
    "bar_code" => array("", "", FALSE, "", FALSE),
    "parent_id" => array("Parent Id", "", FALSE, "", TRUE),
    "row_id" => array("Row Id", "", FALSE, "", TRUE),
    "account" => array("Account", "", FALSE, "", TRUE),
    "karigar" => array("Karigar", "", FALSE, "", TRUE),
    "machine_size" => array("Machine Size", "", FALSE, "", TRUE),
    "length" => array("Length", "", FALSE, "", TRUE),
    "remark" => array("Remark", "", FALSE, "", TRUE),
    "no_of_bunch" => array("Number Of Bunch", "", FALSE, "", TRUE),
    "type" => array("Type", "", FALSE, "", TRUE),
    "product_name" => array("Product Name", "", FALSE, "", TRUE),
    "process_name" => array("Process Name", "", FALSE, "", TRUE),
    "department_name" => array("Department Name", "", FALSE, "", TRUE),
    "description" => array("Description", "", FALSE, "", TRUE),
    "process_sequence" => array("Process Sequence", "", FALSE, "", TRUE),
    "design_code" => array("Design Code", "", FALSE, "", TRUE),
    "lot_no" => array("Lot No.", "", FALSE, "", TRUE),
    "in_weight" => array("In weight", "", FALSE, "", TRUE),
    "out_weight" => array("Out Weight", "", FALSE, "", TRUE),
    "balance" => array("Balance", "", FALSE, "", TRUE),
    "balance_gross" => array("Balance Gross", "", FALSE, "", TRUE),
    "balance_fine" => array("Balance Fine", "", FALSE, "", TRUE),
    "fe_in" => array("FE IN", "", FALSE, "", TRUE),
    "fe_out" => array("FE OUT", "", FALSE, "", TRUE),
    "wastage_fe" => array("Wastage FE", "", FALSE, "", TRUE),
    "in_purity" => array("In Purity", "", FALSE, "", TRUE),
    "out_lot_purity" => array("Out Lot Purity", "", FALSE, "", TRUE),
    "out_purity" => array("Out Purity", "", FALSE, "", TRUE),
    "in_lot_purity" => array("In Lot Purity", "", FALSE, "", TRUE),
    "ghiss" => array("Ghiss", "", FALSE, "", TRUE),
    "loss" => array("Loss", "", FALSE, "", TRUE),
    "micro_coating" => array("Micro Coating", "", FALSE, "", TRUE),
    "expected_out_weight" => array("Expected Out Weight", "", FALSE, "", TRUE),
    "copper_in" => array("Copper In", "", FALSE, "", TRUE),
    "copper_out" => array("Copper Out", "", FALSE, "", TRUE),
    "solder_in" => array("Solder In", "", FALSE, "", TRUE),
    "balance_ghiss" => array("Balance Ghiss", "", FALSE, "", TRUE),
    "out_ghiss" => array("Out Ghiss", "", FALSE, "", TRUE),
    "out_loss" => array("Out Loss", "", FALSE, "", TRUE),
    "balance_loss" => array("Balance Loss", "", FALSE, "", TRUE),
    "quantity" => array("Quantity", "", FALSE, "", TRUE),
    "skip_department" => array("Skip Department", "", FALSE, "", TRUE),
    "refine_loss" => array("Refine Loss", "", FALSE, "", TRUE),
    "alloy_weight" => array("Alloy Weight", "", FALSE, "", TRUE),
    "parent_lot_name" => array("Parent Lot Name", "", FALSE, "", TRUE),
    "created_at" => array("Created At", "", FALSE, "", TRUE),
    "created_by" => array("Created By", "", FALSE, "", TRUE),
    "updated_by" => array("Updated By", "", FALSE, "", TRUE),
    "next_department_name" => array("Next Department Name", "", FALSE, "", TRUE),
    "next_department_wastage" => array("Next Department Wastage", "", FALSE, "", TRUE),
    "rnd_process" => array("RND Process", "", FALSE, "", TRUE),
    "row_id" => array("", "", FALSE, "", TRUE),
    'srno'  => array('Uniqe code', '', FALSE, '', TRUE),
    "department_name" => array("Department Name", "", FALSE, "", TRUE),
    'next_department_karigar'  => array('Next Department Karigar', '', FALSE, '', TRUE),
    'customer_out'  => array('Customer Out', '', FALSE, '', TRUE),
    'customer_name'  => array('Customer name', '', FALSE, '', TRUE),
    'bounch_out'  => array('Bounch Out', '', FALSE, '', TRUE),
    'next_department_karigar'  => array('Next Department Karigar', '', FALSE, '', TRUE),
    'stone_vatav'  => array('', '', FALSE, '', TRUE),
    'out_stone_vatav'  => array('', '', FALSE, '', TRUE),
    "stone_in"   => array("", "", FALSE, "", TRUE),
    "stone_out"   => array("", "", FALSE, "", TRUE),
    "spring_in"   => array("", "", FALSE, "", TRUE),
    "spring_out"   => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}


function get_process_structure_fields($process_name) {
  $fields = array();
  if($process_name == 'rope_chain_ag'){  
    $fields =  array(
      'Start'=>start_structure($process_name),
      'AG Melting' => melting_structure($process_name));
  }elseif($process_name == 'rope_chain_final_process'){
    $fields = array(
    'Start' => start_structure($process_name),
    'Joining Department' => joining_department_structure($process_name),
    'Walnut Shampoo'=> walnut_shampoo_structure($process_name),
    'HCL'=>hcl_structure($process_name),
    'Castic Process' => castic_process_structure($process_name),
    'Hook' =>hook_structure($process_name),
    'Polish' => polish_structure($process_name),
    'GPC' => gpc_structure($process_name));
  }
  return $fields;
}