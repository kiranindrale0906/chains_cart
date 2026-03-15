<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Yellow Qr Code',
    'primary_table'       => 'yellow_qr_codes',
    'default_column'      => 'yellow_qr_codes.id',
    'table'               => array(),
    'join_conditions'     => array(),
    'join_type'           => 'LEFT',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "10",
    'filter'              => ' ',
    'extra_select_column' => 'yellow_qr_codes.id',
    'actionFunction'      => '',
    'search_url'          => 'yellow_qr_codes',
    'add_title'           => 'Add Yellow QR CODE',
    'export_title'        => 'EXPORT',
    'import_title'        => ''
  );
}

function list_settings() {
  return array(
    array("Purity", "yellow_qr_codes.purity", TRUE, "yellow_qr_codes.purity", TRUE, TRUE),
    array("Date", "created_date", TRUE, "yellow_qr_codes.created_at", false, TRUE,'DATE_FORMAT(yellow_qr_codes.created_at,"%d-%m-%Y") as created_date','','','date'),
    array("Desgin Code", "yellow_qr_codes.design_code", TRUE, "yellow_qr_codes.design_code", TRUE, TRUE),
    array("Percentage", "yellow_qr_codes.percentage", TRUE, "yellow_qr_codes.percentage", TRUE, TRUE),
    array("Total Gross weight", "total_weight", TRUE, "total_weight", 
          TRUE, TRUE, '(select FORMAT(sum(weight),4) from yellow_qr_code_details where yellow_qr_code_id = yellow_qr_codes.id) as total_weight'),

    array("Total Net weight", "total_net_weight", TRUE, "total_net_weight", 
          TRUE, TRUE, '(select FORMAT(sum(net_weight),4) from yellow_qr_code_details where yellow_qr_code_id = yellow_qr_codes.id) as total_net_weight'),

    // array("Total Less", "total_less", TRUE, "total_net_weight", 
    //       TRUE, TRUE, '(select FORMAT(sum(less),4) from qr_code_details where qr_code_id = yellow_qr_codes.id) as total_less'), 

    array("No of pieces", "no_of_pieces", TRUE, "no_of_pieces", 
          TRUE, TRUE, '(select count(id) from yellow_qr_code_details where yellow_qr_code_id = yellow_qr_codes.id) as no_of_pieces'),

    array("Action", "action", FALSE, "action", FALSE, FALSE)
  );
}
function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["yellow_qr_codes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "purity" => array("Purity", "", FALSE, "", FALSE),
    "design_code" => array("Design Code", "", FALSE, "", FALSE),
    "percentage" => array("Percentage", "", FALSE, "", FALSE),
  );
  $attributes["yellow_qr_code_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "hu_id"  => array("", "", FALSE, "", TRUE),
    "weight"  => array("", "", FALSE, "", TRUE),
    "item_code"  => array("", "", FALSE, "", TRUE),
    "design_code"  => array("", "", FALSE, "", TRUE),
    "net_weight"  => array("", "", FALSE, "", TRUE),
    "dispatch_weight"  => array("", "", FALSE, "", TRUE),
    "stone_weight"  => array("", "", FALSE, "", TRUE),
    "percentage"  => array("", "", FALSE, "", TRUE),
    "less"  => array("", "", FALSE, "", TRUE),
    "total_stone"  => array("", "", FALSE, "", TRUE),
    "stone_count"  => array("", "", FALSE, "", TRUE),
    "length"  => array("", "", FALSE, "", TRUE),
    "purity"  => array("", "", FALSE, "", TRUE),
    "image"  => array("", "", FALSE, "", TRUE),
    "other_stone"  => array("", "", FALSE, "", TRUE),
    "km"  => array("", "", FALSE, "", TRUE),
    "delete"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.'qr_codes/yellow_qr_codes/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn green');
  $actions["Multiple QR Code"] = array('request' => "http",
                                       'url' => ADMIN_PATH.'qr_codes/yellow_qr_codes/view/'.$row['id'],
                                       'confirm_message' => "",
                                       'class' => 'btn btn_light_red');
  $actions["Single QR Code"] = array('request' => "http",
                                     'url' => ADMIN_PATH.'qr_codes/yellow_qr_codes/view/'.$row['id'].'?type=single',
                                     'confirm_message' => "",
                                     'class' => 'btn btn_light_red');
  $actions["Delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.'qr_codes/yellow_qr_codes/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn red');
  return $actions;
}