<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "Process Master",
    "primary_table"       => "processes",
    "default_column"      => "id",
    "table"               => "processes",
    "join_conditions"     => '',
    "join_type"           => "",
    "where"               => array('balance !='=>0),
    "where_ids"           => "",
    "order_by"            => "",
    "group_by"            => "product_name,process_name,karigar,in_lot_purity,design_code",
    "limit"               => "20",
    "extra_select_column" => "",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "process_masters",
    "add_title"           => "",
    "export_title"        => "",
    "edit"                => "",
    'clear_filter'        => true
  );
}

        
function list_settings() {
  return array(
    array("Product Name", "product_name", true, "product_name", true, TRUE,'processes.product_name as product_name'),
    array("Process Name", "process_name", true, "process_name", true, TRUE,'processes.process_name as process_name'),

    array("Karigar Name", "karigar", true, "karigar", true, TRUE,'processes.karigar as karigar'),
    array("Design Code", "design_code", true, "design_code", true, TRUE,'processes.design_code as design_code'),

    array("Purity", "in_lot_purity", true, "in_lot_purity", true, TRUE,'processes.in_lot_purity as in_lot_purity'),

    array("Balance", "balance", true, "balance", true, TRUE,'SUM(balance) as balance','','','','',true),
    // array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

/*function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes = array(
    'in_lot_purity' => array('In Lot Purity')
  );
  return $attributes[$field];
}*/