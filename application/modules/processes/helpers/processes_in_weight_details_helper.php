<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "",
    "primary_table"       => "process_details",
    "default_column"      => "id",
    "table"               => "",
    "join_conditions"     => "",
    "join_type"           => "",
    "where"               => "",
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "process_fields",
    "add_title"           => "",
    "export_title"        => "",
    "edit"                => "",
    'clear_filter'        => true
  );
}



function get_row_id($melting_lot_id, $department_name) {
  return strtolower(str_replace(' ', '_', $melting_lot_id.' '.str_replace('+', '_', $department_name)));
}

        
function list_settings() {
  return array(
    array("Lot No", "lot_no", false, "lot_no", false, TRUE,'processes.lot_no as lot_no'),
    array("Date", "created_at", false, "created_at", false, TRUE,'processes.created_at as created_at'),
    array("Product name", "product_name", false, "product_name", TRUE, TRUE,'processes.product_name as product_name'),
    array("Process name", "process_name", false, "process_name", TRUE, TRUE,'processes.process_name as process_name'),
    array("Department name", "department_name", false, "department_name", TRUE, TRUE,'processes.department_name as department_name'),
    // array("", "action", FALSE, "action", FALSE, FALSE),
  );
}


