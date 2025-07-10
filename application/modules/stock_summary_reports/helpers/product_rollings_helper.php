<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Product Rollings',
    'primary_table'       => 'product_rollings',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'product_rollings.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'product_rollings',
    'add_title'           => 'Add Product Rollings',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
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
    array("Chain Name", "chain_name", TRUE, "chain_name", TRUE, TRUE, 'chain_name'),
     array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE, 'balance_gross'),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['product_rollings'] = array(
    'id'           => array('ID', '', false, '', FALSE),
    'chain_name' => array('Chain Name', 'Select Chain name', TRUE, '', FALSE),
    'balance_gross' => array('Balance Gross', 'Enter Balance Gross', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/product_rollings';
  $actions["Edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green');
  $actions["Delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete?",
                             'class' => 'btn_red');
  return $actions;
}