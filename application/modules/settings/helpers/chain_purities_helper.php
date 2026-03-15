<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Chain Purities',
    'primary_table'       => 'chain_purities',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'product_name, lot_purity desc',
    'limit'               => "20",
    'extra_select_column' => 'chain_purities.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'chain_purities',
    'add_title'           => 'Add Chain Purity',
    'export_title'        => 'Export',
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
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'chain_purities', FALSE,'autocomplete',array('chain_purities','product_name')),
    array("Purity in KT", "purity_in_kt", TRUE, "purity_in_kt", TRUE, TRUE, 'purity_in_kt', 'chain_purities', FALSE,'autocomplete',array('chain_purities','purity_in_kt')),
    array("Lot purity", "lot_purity", TRUE, "lot_purity", TRUE, TRUE, 'lot_purity', 'chain_purities', FALSE,'autocomplete',array('chain_purities','lot_purity')),
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

  $attributes['chain_purities'] = array(
    'id'           => array('ID', '', false, '', FALSE),
    'product_name' => array('Product name', 'Select Product name', TRUE, '', FALSE),
    'lot_purity'   => array('Lot purity', 'Enter lot purity', TRUE, '', FALSE),
    'purity_in_kt'   => array('Purity In KT', 'Enter Purity In KT', FALSE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/chain_purities';
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