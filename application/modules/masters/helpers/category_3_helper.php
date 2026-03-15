<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Category 3',
    'primary_table'       => 'category_3',
    'default_column'      => 'id',
    'table'               => 'category_3',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'category_3',
    'add_title'           => 'Add category 3',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Category Name", "category_name", TRUE, "category_name", TRUE, TRUE),
    array("Chain Name", "chain_name", FALSE, "chain_name", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/category_3/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['category_3'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'category_name'  => array('Category Name', 'Enter Category Name', TRUE, '', TRUE),
    'chain_name'  => array('Chain Name', 'Select Chain Name', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}