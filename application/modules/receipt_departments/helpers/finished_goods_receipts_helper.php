<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Finished Goods Receipt List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="Finished Goods Receipt" and archive=0',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'finished_goods_receipts',
    'add_title'           => 'Add Finished Goods Receipt',
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
    array("Date", "created_at", TRUE, "created_at", FALSE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE, 'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','', 'range','in_weight',true),
    array("Out WT", "issue_gpc_out", TRUE, "out_melting_wastage", TRUE, TRUE, 'issue_gpc_out','','','range','issue_gpc_out',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE, '(in_weight - issue_gpc_out) as balance','','','','',true),
    //array("Gross WT", "balance_melting_wastage", TRUE, "balance_melting_wastage", TRUE, TRUE),
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
    'id'            => array('', '', TRUE, '', TRUE),
    'account'       => array('Account', '', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Enter Melting', TRUE, '', TRUE),
    'in_weight'     => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'description'   => array('Description', 'Enter Description', FALSE, '', TRUE),
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
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  return $actions;
}