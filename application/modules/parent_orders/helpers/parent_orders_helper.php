<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Parent orders',
    'primary_table'       => 'parent_orders',
    'default_column'      => 'parent_orders.id',
    'table'               => array('parent_orders'),
    'join_conditions'     => array(),
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => '20',
    'filter'              => '',
    'extra_select_column' => 'parent_orders.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'parent_orders',
    'add_title'           => 'Add Parent order',
    'view_title'          => 'Parent order View',
    'export_title'        => '',
    'import_title'        => ''
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
    array("Name", "name", false, "name", TRUE, TRUE),
    array("Chain", "chain_name", false, "chain_name", TRUE, TRUE),
    array("Melting", "melting", false, "melting", TRUE, TRUE),
    array("Person Name", "person_name", false, "person_name", TRUE, TRUE),
    array("Date", "created_at", false, "created_at", TRUE, TRUE),
    array("Status", "status", false, "status", false, false,'status'),
    array("", "action", FALSE, "action", FALSE, FALSE),
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
  $attributes= array(
    'id'          => array('', '', FALSE, '', FALSE),
    'chain_name'  => array('Chain', 'Select chain', TRUE, '', FALSE),
    'melting'     => array('Melting', 'Select melting', TRUE, '', FALSE),
    'person_name' => array('Person name', 'Enter person name', TRUE, '', FALSE),
    'name'        => array('Name', '', TRUE, '', FALSE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'parent_orders/parent_orders';
  if(isset($row['status']) && $row['status'] == 'Closed'){
    $actions["Open"] = array('request'          => 'ajax_post',
                             'url'              => ADMIN_PATH.$controller.'/update/'.$row['id'],
                             'post_data'        => array('parent_orders[id]'     => $row['id'],
                                                         'parent_orders[status]' => 'Open',
                                                         'submittype'            => 'json'
                                                        ),
                             'class'            => 'text-success',
                             'success_function' => '');
  } else {
    $actions['Close'] = array('request'          => 'ajax_post',
                              'url'              => ADMIN_PATH.$controller.'/update/'.$row['id'],
                              'post_data'        => array('parent_orders[id]' => $row['id'],
                                                          'parent_orders[status]' => 'Closed',
                                                          'submittype' => 'json'
                                                         ),
                              'class'            => 'text-warning',
                              'success_function' => '');
  }
  $actions['Edit'] = array('request'         => 'http',
                           'url'             => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => '',
                           'class'           => 'green',
                           'data_title'      => 'View',
                           'i_class'         => 'fal fa-file-alt font20');
  return $actions;
}

function get_parent_order_meltings() {

  return array(array('id' => '92', 'name' => '92'),
               array('id' => '83', 'name' => '83'),
               array('id' => '75', 'name' => '75'));
}

function get_parent_order_chain_name() {
  return array(array('id'=> 'Imp Italy Chain', 'name' => 'Imp Italy Chain'),
               array('id'=> 'Indo tally Chain', 'name' => 'Indo tally Chain'));
}

