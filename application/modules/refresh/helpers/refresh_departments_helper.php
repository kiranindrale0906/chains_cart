<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Refresh Department List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="Refresh" and department_name = "Refresh Hold"',
    'where_ids'           => '',
    'order_by'            => 'created_at desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'refresh_departments',
    'add_title'           => 'Add Refresh',
    'export_title'        => '',
    'edit'                => '',
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
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Account Name", "account", TRUE, "account", TRUE, TRUE),
    array("Gross WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','','range','',true),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("Quantity", "quantity", TRUE, "quantity", TRUE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Date", "created_at", TRUE, "  created_at", TRUE, TRUE),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
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

  $attributes = array(
    'id'       => array('', '', TRUE, '', TRUE),
    'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'quantity'  => array('Quantity', 'Enter Quantity', FALSE, '', TRUE),
    'account'  => array('Account', 'Enter Account', FALSE, '', TRUE),
    'lot_no'  => array('Lot Name', 'Enter Lot Name', FALSE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
    'hook_kdm_purity'  => array('Hook Kdm Purity', 'Select', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'refresh/refresh_departments';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  // $actions["Delete"] = array('request' => "http",
  //                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
  //                           'class' => 'btn_red',
  //                           'confirm_message' => "Do you want to delete",
  //                           'data_title' => "Delete",
  //                           'i_class' => 'far fa-trash-alt font20');
  return $actions;
}