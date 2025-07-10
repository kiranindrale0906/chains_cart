<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Domestic Category Masters',
    'primary_table'       => 'domestic_category_masters',
    'default_column'      => 'id',
    'table'               => 'domestic_category_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'domestic_category_masters',
    'add_title'           => 'Add Domestic Category',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Product Name", "product_name", FALSE, "product_name", FALSE, TRUE),
    array("Design Code", "design_code", FALSE, "design_code", FALSE, TRUE),
    array("Rete Per Gram", "rate_per_gram", FALSE, "rate_per_gram", FALSE, TRUE),
    array("Account Name", "account_name", FALSE, "account_name", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/domestic_category_masters/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["view"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/domestic_category_masters/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.'masters/domestic_category_masters/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-danger');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['domestic_category_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name'  => array('Product Name', 'Select Product Name', TRUE, '', TRUE),
    'account_name'  => array('Account Name', 'Enter Account Name', TRUE, '', TRUE),
    'design_code'  => array('Design Code', 'Enter Design Code', TRUE, '', TRUE),
    'rate_per_gram'  => array('Rate Per Gram', 'Enter Rate Per Gram', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}