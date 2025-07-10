<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Internal Wastage Ledger',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'internal_ledgers',
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
    array("Account", "account", TRUE, "account", FALSE, TRUE, "account as account"),
    array("Type", "type", TRUE, "type", TRUE, TRUE),
    array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Action", "action", FALSE, "action", FALSE, FALSE)
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
    'id' => array('', '', TRUE, '', TRUE),
    'row_id' => array('', '', TRUE, '', TRUE),
    'type' => array('Type', '', FALSE, '', TRUE),
    'account' => array('Account', '', FALSE, '', TRUE),
    'in_weight' => array('Weight', 'Enter Weight', TRUE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'karigar' => array('Karigar', 'Enter Karigar', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Select Melting', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'daily_drawer_issue_departments/daily_drawer_issue_departments';
  // $actions["Edit"] = array('request' => "http",
  //                          'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
  //                          'confirm_message' => "",
  //                          'class' => 'btn_green',
  //                          'data_title' =>'View',
  //                           'i_class'=>'fal fa-file-alt font20');
  $actions["Delete"] = array('request' => "http",
                            'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                            'class' => 'btn_red',
                            'confirm_message' => "Do you want to delete",
                            'data_title' => "Delete",
                            'i_class' => 'far fa-trash-alt font20');
  return $actions;
}