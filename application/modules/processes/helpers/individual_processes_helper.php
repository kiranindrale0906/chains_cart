<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "Individual Process",
    "primary_table"       => "processes",
    "default_column"      => "id",
    "table"               => "processes",
    "join_columns"        => "",
    "join_type"           => "",
    "where"               => "",
    "where_ids"           => "",
    "order_by"            => "id desc",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "processes",
    "add_title"           => "Add Process Manually",
    "add_title_with_json" => "Add Process",
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
    array("Parent ID", "parent_id", TRUE, "parent_id", TRUE, TRUE),
    array("Row ID", "row_id", TRUE, "row_id", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Parent Lot No", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Melting No", "melting_lot_id", TRUE, "melting_lot_id", TRUE, TRUE),
    array("Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("Hook KDM Purity", "hook_kdm_purity", TRUE, "hook_kdm_purity", TRUE, TRUE),
    array("IN Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("Out Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
    array("Daily Drawer IN Weight", "daily_drawer_in_weight", TRUE, "daily_drawer_in_weight", TRUE, TRUE),
    array("Melting Wastage", "melting_wastage", TRUE, "melting_wastage", TRUE, TRUE),
    array("Out Opening Melting Wastage", "out_opening_melting_wastage", TRUE, "out_opening_melting_wastage", TRUE, TRUE),
    array("Daily Drawer Wastage", "daily_drawer_wastage", TRUE, "daily_drawer_wastage", TRUE, TRUE),
    array("Hcl wastage", "hcl_wastage", TRUE, "hcl_wastage", TRUE, TRUE),
    array("Wastage Fe", "wastage_fe", TRUE, "wastage_fe", TRUE, TRUE),
    array("Fe In", "fe_in", TRUE, "fe_in", TRUE, TRUE),
    array("Fe Out", "fe_out", TRUE, "fe_out", TRUE, TRUE),
    array("Copper in", "copper_in", TRUE, "copper_in", TRUE, TRUE),
    array("Tounch No", "tounch_no", TRUE, "tounch_no", TRUE, TRUE),
    array("Tounch", "tounch_in", TRUE, "tounch_in", TRUE, TRUE),
    array("Solder In", "solder_in", TRUE, "solder_in", TRUE, TRUE),
    array("Fire Tounch No", "fire_tounch_no", TRUE, "fire_tounch_no", TRUE, TRUE),
    array("Fire Tounch", "fire_tounch_in", TRUE, "fire_tounch_in", TRUE, TRUE),
    array("Ghiss", "ghiss", TRUE, "ghiss", TRUE, TRUE),
    array("Hcl Ghiss", "hcl_ghiss", TRUE, "hcl_ghiss", TRUE, TRUE),
    array("Pending Ghiss", "pending_ghiss", TRUE, "pending_ghiss", TRUE, TRUE),
    array("Loss", "loss", TRUE, "loss", TRUE, TRUE),
    array("Pending Loss", "pending_loss", TRUE, "pending_loss", TRUE, TRUE),
    array("GPC Out", "gpc_out", TRUE, "gpc_out", TRUE, TRUE),
    array("Micro Coating", "micro_coating", TRUE, "micro_coating", TRUE, TRUE),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE),
    array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE),
    array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE),
    array("Status", "status", TRUE, "status", TRUE, TRUE),
    array("", "action", TRUE, "action", TRUE, TRUE),
    );
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

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes[$table] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', '', FALSE, '', TRUE),
    'lot_no' => array('', 'Lot No', FALSE, '', TRUE),
    'parent_lot_name' => array('Parent Lot No', '', FALSE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
    'process_sequence'  => array('Process Sequence', '', FALSE, '', TRUE),
    'melting_lot_id'  => array('Melting Lot ID', '', FALSE , '', TRUE),
    'in_lot_purity'  => array('In Lot Purity', '', FALSE, '', TRUE),
    'out_lot_purity'  => array('Out Lot Purity', '', FALSE, '', TRUE),
    'in_weight'  => array('IN Weight', '', FALSE, '', TRUE),
    'in_purity'  => array('IN Purity', '', FALSE, '', TRUE),
    'fe_in'  => array(' FE IN', '', FALSE, '', TRUE),
    'fe_out'  => array('FE OUT', '', FALSE, '', TRUE),
    'hook_in' => array('Hook In', '', FALSE, '', FALSE),
    'hook_out' => array('Hook Out', '', FALSE, '', FALSE),
    'gemstone_in' => array('Gemstone In', '', FALSE, '', FALSE),
    'gemstone_out' => array('Gemstone Out', '', FALSE, '', FALSE),
    'copper_in' => array('Copper In', '', FALSE, '', FALSE),
    'copper_out' => array('Copper Out', '', FALSE, '', FALSE),
    'melting_wastage'  => array('Melting Wastage', '', FALSE, '', TRUE),
    'wastage_gross'  => array('Wastage Purity', '', FALSE, '', TRUE),
    'wastage_fe'  => array('Wastage FE', '', FALSE, '', TRUE),
    'wastage_au_fe'  => array('Wastage AU+Fe', '', FALSE, '', TRUE),
    'tounch_in'  => array('Tounch', '', FALSE, '', TRUE),
    'tounch_no'  => array('Tounch No', '', FALSE, '', TRUE),
    'tounch_purity'  => array('Tounch Purity', '', FALSE, '', TRUE),
    'fire_tounch_no'  => array('Fire Tounch No', '', FALSE, '', TRUE),
    'ghiss'  => array('Ghiss', '', FALSE, '', TRUE),
    'hcl_ghiss'  => array('HCL Ghiss', '', FALSE, '', TRUE),
    'loss'  => array('Loss', '', FALSE, '', TRUE),
    'loss_gross'  => array('Loss Purity', '', FALSE, '', TRUE),
    'loss_fine'  => array('Loss Fine', '', FALSE, '', TRUE),
    'au_out'  => array('AU Out', '', FALSE, '', TRUE),
    'au_out_fine'  => array('AU Out Fine', '', FALSE, '', TRUE),
    'gold'  => array('Gold', '', FALSE, '', TRUE),
    'iron'  => array('Iron', '', FALSE, '', TRUE),
    'total'  => array('Total', '', FALSE, '', TRUE),
    'out_weight'  => array('Out Weight', '', FALSE, '', TRUE),
    'length'  => array('Length', '', FALSE, '', TRUE),
    'out_purity'  => array('Out Purity', '', FALSE, '', TRUE),
    'micro_coating'  => array('Micro Coating', '', FALSE, '', TRUE),
    'balance'  => array('Balance', '', FALSE, '', TRUE),
    'balance_gross'  => array('Balance Gross', '', FALSE, '', TRUE),
    'balance_fine'  => array('Balance Fine', '', FALSE, '', TRUE),
    'expected_out_weight'  => array('Expected Out Weight', '', FALSE, '', TRUE),
    'daily_drawer_wastage'  => array('Daily Drawer Wastage', '', FALSE, '', TRUE),
    'hcl_wastage'  => array('HCL Wastage', '', FALSE, '', TRUE),
    'hcl_loss'  => array('HCL Loss', '', FALSE, '', TRUE),
    'description'  => array('Description', '', FALSE, '', TRUE),
    'created_at'  => array('Created by', '', FALSE, '', TRUE),
    'created_by'  => array('Created by', '', FALSE, '', TRUE),
    'updated_by'  => array('Updated by', '', FALSE, '', TRUE),
    'melting_lots'  => array('Melting Lots', '', false, '', TRUE),
    'solder_in'  => array('Solder Powder', '', false, '', TRUE),
    'solder_wastage'  => array('Solder Wastage', '', false, '', TRUE),
    'pending_ghiss'  => array('Pending Ghiss', '', false, '', TRUE),
    'updated_at'  => array('Updated At', '', false, '', TRUE),
    'design_code' => array('Design Code', '', false, '', TRUE),
    'machine_size' => array('Machine Size', '', false, '', TRUE),
    'karigar' => array('Karigar', 'Select', false, '', TRUE),
    'skip_department' => array('Skip Department', '', false, '', TRUE),
    'quantity' => array('Quantity', '', false, '', TRUE),
    'daily_drawer_in_weight' => array('Daily Drawer In Weight', '', false, '', TRUE),
    'next_department_name' => array('Next Department Name', '', false, '', TRUE),
    'next_department_wastage' => array('Next Department Wastage', '', false, '', TRUE),
    'rnd_process' => array('RND Process', '', false, '', TRUE),
    'strip_cutting_process_id' => array('Strip Cutting Process ID', '', false, '', TRUE),
    'hook_kdm_purity' => array('Hook KDM Purity', '', false, '', TRUE),
    'length'  => array('Length', '', false, '', TRUE),
    'gpc_out' => array('GPC Out', '', false, '', TRUE),
    'repair_out' => array('Repair Out', '', false, '', TRUE),
    'flash_wire' => array('Flash Wire', '', false, '', TRUE),
    'alloy_weight' => array('Solder In', '', false, '', TRUE),
    'repair_out_quantity' => array('Repair Out Qualtity', '', false, '', TRUE),
    'concept' => array('Concept', '', false, '', TRUE),
    'liquor_in' => array('Liquor In', '', false, '', TRUE),
    'liquor_out' => array('Liquor Out', '', false, '', TRUE),
    'stone_vatav' => array('Stone Vatav', '', false, '', TRUE),
    'in_melting_wastage' => array('In Melting Wastage', '', false, '', TRUE),
    'factory_karigar' => array('Factory / Karigar', '', FALSE, '', TRUE),
    'is_outside' => array('Outside', '', FALSE, '', TRUE),
    'meena_quantity' => array('Meena Quantity', '', false, '', TRUE),
    'in_rod' => array('Rod In', '', false, '', TRUE),
    'out_rod' => array('Rod Out', '', false, '', TRUE),
    'in_machine_gold' => array('IN Machine Gold', '', false, '', TRUE),
    'out_machine_gold' => array('Out Machine Gold', '', false, '', TRUE),
    'in_plain_rod' => array('IN Plain Rod', '', false, '', TRUE),
    'completed_at'  => array('Completed At', '', FALSE, '', TRUE),
    'bounch_out'  => array('Bounch Out', '', FALSE, '', TRUE),
    'factory_out'  => array('Factory Out', '', FALSE, '', TRUE),
    'fire_tounch_in'  => array('Fire Tounch In', '', FALSE, '', TRUE),
    'fire_tounch_purity'  => array('Fire Tounch Purity', '', FALSE, '', TRUE),
    'archive'  => array('Archive', '', FALSE, '', TRUE),
    'melting_lot_category_one'  => array('Category One', '', FALSE, '', TRUE),
    'melting_lot_category_two'  => array('Category Two', '', FALSE, '', TRUE),
    'melting_lot_category_three'  => array('Category Three', '', FALSE, '', TRUE),
    'melting_lot_category_four'  => array('Category Four', '', FALSE, '', TRUE),
    'melting_lot_chain_name'  => array('Chain Name', '', FALSE, '', TRUE),
    'customer_out'  => array('Customer Out', '', FALSE, '', TRUE),
    'customer_name'  => array('Customer Name', '', FALSE, '', TRUE),
    'recutting_out'  => array('Recutting out', '', FALSE, '', TRUE),
    'row_id' => array('Row ID', '', FALSE, '', TRUE),
    'srno'  => array('Uniqe code', '', FALSE, '', TRUE),
    'pending_loss'  => array('Pending Loss', '', FALSE, '', TRUE),
    'tone' => array('Tone', '', false, '', TRUE),
    'rhodium_in' => array('Rhodium In', '', false, '', TRUE),
    'machine_no' => array('Machine No', '', false, '', TRUE),
    'parent_lot_no' => array('', 'Parent Lot No', false, '', TRUE),
    'jsoncode' => array('Code', 'Enter Code', false, '', TRUE),
    'order_id' => array('Order ID', 'Enter Order ID', false, '', TRUE),
    'order_detail_id' => array('Order Detail ID', 'Enter Order Detail ID', false, '', TRUE),
  );
  //print_r($attributes[$table][$field]);
  return $attributes[$table][$field];
}



function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = "processes/individual_processes";
  // $actions["Edit"] = array("request" => "http",
  //                          "url" => ADMIN_PATH.$controller."/edit/".$row["id"],
  //                          "confirm_message" => "",
  //                          "class" => "blue",
  //                          "data_title" =>"View",
  //                           "i_class"=>"fal fa-file-alt font20");

  $actions["Delete"] = array("request" => "http",
                             "url" => ADMIN_PATH.$controller."/delete/".$row["id"],
                             "class" => "red",
                             "confirm_message" => "Do you want to delete",
                             "data_title" => "Delete",
                             "i_class" => "far fa-trash-alt font20");
  $actions["View"] = array("request" => "http",
                             "url" => ADMIN_PATH.'processes/processes'."/view/".$row["id"],
                             "class" => "green",
                             "confirm_message" => "",
                             "data_title" => "View",
                             "i_class" => "far fa-trash-alt font20");
  return $actions;
}
