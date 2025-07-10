<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  $data = array(
    'page_title'          => 'Export Internal Issue List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="Export Internal" AND process_name="Export Internal Issue"',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'export_internal_issues',
    'export_title'        => '',
    'add_title'           => 'Issue Export Internal',
    'edit'                => '',
  );
  return $data;
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
    array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Out WT", "out_weight", TRUE, "out_weight", TRUE, TRUE,
          'out_weight','','','range','out_weight',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE,
          'balance','','','range','balance',true),
    array("Action", "action", FALSE, "action", FALSE, FALSE)
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'id'       => array('', '', TRUE, '', TRUE),
    'account'    => array('Account', '', FALSE, '', TRUE),
    'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
  );

  return $attributes[$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'receipt_departments/receipt_departments';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  return $actions;
}
