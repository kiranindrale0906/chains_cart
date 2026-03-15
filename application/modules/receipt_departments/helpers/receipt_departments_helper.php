<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='product_name="Receipt"';
  else $where='product_name="Receipt" AND archive=0';
  
  return array(
    'page_title'          => 'Receipt Department List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => $where, //AND archive=0
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'receipt_departments',
    'add_title'           => 'Add Receipt',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => true
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
    array("Date", "created_at", TRUE, "created_at", FALSE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Out WT", "out_melting_wastage", TRUE, "out_melting_wastage", TRUE, TRUE,
          'out_melting_wastage','','','range','out_melting_wastage',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE,
          '(in_weight - out_melting_wastage) as balance','','','','',true),

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
    'id'       => array('', '', TRUE, '', TRUE),
    'type'     => array('Type', '', FALSE, '', TRUE),
    'account'    => array('Account', '', FALSE, '', TRUE),
    'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'receipt_departments/receipt_departments';
  if($row['in_weight']==$row['balance']){
    $actions["Delete"] = array('request' => "http",
                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                              'class' => 'red',
                              'confirm_message' => "Do you want to delete",
                              'data_title' => "Delete",
                              'i_class' => 'far fa-trash-alt font20');

  }
  $controller = 'processes/processes';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn-sm green',
                           'data_title' =>'View',
                           'i_class'=>'btn-sm green');
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  
  return $actions;
}