<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Item Code',
    'primary_table'       => 'item_code_masters',
    'default_column'      => 'id',
    'table'               => 'item_code_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'item_code_masters',
    'add_title'           => 'Add Item Code',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Category", "design_name", FALSE, "design_name", FALSE, TRUE),
    array("Item Code", "item_code", FALSE, "item_code", FALSE, TRUE),
    array("Melting", "melting", FALSE, "melting", FALSE, TRUE),
    array("Melting Lot Category One", "melting_lot_category_one", FALSE, "melting_lot_category_one", FALSE, TRUE),
    array("Machine Size", "machine_size", FALSE, "machine_size", FALSE, TRUE),
    array("Tone", "tone", FALSE, "tone", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/item_code_masters/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/item_code_masters/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-danger');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['item_code_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name'  => array('Product Name', 'Select Product Name', TRUE, '', TRUE),
    'design_name'  => array('Category', 'Select Category', TRUE, '', TRUE),
    'item_code'  => array('Item Code', 'Item Code', TRUE, '', TRUE),
    'melting'  => array('Melting', 'Melting', true, '', true),
    'melting_lot_category_one'  => array('Melting Lot Category One', 'Melting Lot Category One', false, '', false),
    'machine_size'  => array('Machine Size', 'Machine Size', false, '', false),
    'tone'  => array('Tone', 'Tone', false, '', false),
  );
  return $attributes[$table][$field];
}
