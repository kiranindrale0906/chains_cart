<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Generate Lot Tagging',
    'primary_table'       => 'generate_lot_taggings',
    'default_column'      => 'generate_lot_taggings.id',
    'table'               => array(),
    'join_conditions'     => array(),
    'join_type'           => 'LEFT',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "10",
    'filter'              => ' ',
    'extra_select_column' => 'generate_lot_taggings.id',
    'actionFunction'      => '',
    'search_url'          => 'generate_lot_taggings',
    'add_title'           => '',
    'export_title'        => 'EXPORT',
    'import_title'        => '',
    'custom_table_header' => true,
  );
}

function list_settings() {
  return array(
    array("Lot no", "generate_lot_taggings.lot_no", TRUE, "generate_lot_taggings.lot_no", TRUE, TRUE),
    array("Lot weight", "generate_lot_taggings.lot_weight", TRUE, "generate_lot_taggings.lot_weight", TRUE, TRUE),
    array("Lot Quantity", "generate_lot_taggings.lot_quantity", TRUE, "generate_lot_taggings.lot_quantity", TRUE, TRUE),
    array("Process Name", "generate_lot_taggings.process_name", TRUE, "generate_lot_taggings.process_name", TRUE, TRUE),
    array("Order date", "generate_lot_taggings.order_date", TRUE, "generate_lot_taggings.order_date", TRUE, TRUE),
    array("Due date", "generate_lot_taggings.due_date", TRUE, "generate_lot_taggings.due_date", TRUE, TRUE),
    array("Color", "generate_lot_taggings.color", TRUE, "generate_lot_taggings.color", TRUE, TRUE),
    array("Purity", "generate_lot_taggings.purity", TRUE, "generate_lot_taggings.purity", TRUE, TRUE),
    array("Date", "created_date", TRUE, "generate_lot_taggings.created_at", false, TRUE,'DATE_FORMAT(generate_lot_taggings.created_at,"%d-%m-%Y") as created_date','','','date'),
    array("Desgin Code", "generate_lot_taggings.design_code", TRUE, "generate_lot_taggings.design_code", TRUE, TRUE),
    array("Percentage", "generate_lot_taggings.percentage", TRUE, "generate_lot_taggings.percentage", TRUE, TRUE),
    array("Total Gross weight", "total_weight", TRUE, "total_weight", 
          TRUE, TRUE, '(select FORMAT(sum(weight),4) from generate_lot_tagging_details where generate_lot_tagging_id = generate_lot_taggings.id) as total_weight'),

    array("Total Net weight", "total_net_weight", TRUE, "total_net_weight", 
          TRUE, TRUE, '(select FORMAT(sum(net_weight),4) from generate_lot_tagging_details where generate_lot_tagging_id = generate_lot_taggings.id) as total_net_weight'),

    array("Total Less", "total_less", TRUE, "total_net_weight", 
          TRUE, TRUE, '(select FORMAT(sum(less),4) from generate_lot_tagging_details where generate_lot_tagging_id = generate_lot_taggings.id) as total_less'), 

    array("No of pieces", "no_of_pieces", TRUE, "no_of_pieces", 
          TRUE, TRUE, '(select sum(quantity) from generate_lot_tagging_details where generate_lot_tagging_id = generate_lot_taggings.id) as no_of_pieces'),

    array("Action", "action", FALSE, "action", FALSE, FALSE)
  );
}
function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["generate_lot_taggings"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "lot_no" => array("Lot No", "", FALSE, "", FALSE),
    "lot_weight" => array("Lot weight", "", FALSE, "", FALSE),
    "lot_quantity" => array("Lot Quantity", "", FALSE, "", FALSE),
    "process_name" => array("Process Name", "", FALSE, "", FALSE),
    "color" => array("Color", "", FALSE, "", FALSE),
    "order_date" => array("Order date", "", FALSE, "", FALSE),
    "due_date" => array("Due date", "", FALSE, "", FALSE),
    "purity" => array("Purity", "", FALSE, "", FALSE),
    "design_code" => array("Design Code", "", FALSE, "", FALSE),
    "percentage" => array("Percentage", "", FALSE, "", FALSE),
    "generate_lot_id" => array("generate_lot_id", "", FALSE, "", FALSE),
  );
  $attributes["generate_lot_tagging_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "item_code" => array("", "", FALSE, "", FALSE),
    "hu_id"  => array("", "", FALSE, "", TRUE),
    "weight"  => array("", "", FALSE, "", TRUE),
    "design_code"  => array("", "", FALSE, "", TRUE),
    "net_weight"  => array("", "", FALSE, "", TRUE),
    "percentage"  => array("", "", FALSE, "", TRUE),
    "less"  => array("", "", FALSE, "", TRUE),
    "total_stone"  => array("", "", FALSE, "", TRUE),
    "stone_count"  => array("", "", FALSE, "", TRUE),
    "length"  => array("", "", FALSE, "", TRUE),
    "purity"  => array("", "", FALSE, "", TRUE),
    "image"  => array("", "", FALSE, "", TRUE),
    "quantity"  => array("", "", FALSE, "", TRUE),
    "order_quantity"  => array("", "", FALSE, "", TRUE),
    "order_id"  => array("", "", FALSE, "", TRUE),
    "total_quantity"  => array("", "", FALSE, "", TRUE),
    "delete"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
 /* $actions["Multiple QR Code"] = array('request' => "http",
                                       'url' => ADMIN_PATH.'qr_codes/generate_lot_taggings/view/'.$row['id'],
                                       'confirm_message' => "",
                                       'class' => 'btn btn_light_red');
  */$actions["View"] = array('request' => "http",
                                     'url' => ADMIN_PATH.'qr_codes/generate_lot_taggings/view/'.$row['id'].'?type=single',
                                     'confirm_message' => "",
                                     'class' => 'btn btn_light_red');
  $actions["Generate Qr Code"] = array('request' => "http",
                           'url' => ADMIN_PATH.'qr_codes/generate_lot_qr_codes/create?generate_lot_tagging_id='.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn btn_light_red');
  $actions["Delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.'qr_codes/generate_lot_taggings/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn red');
  return $actions;
}
