<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Loss Receipt List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',//array('product_name="Stone Receipt" AND archive=0'=>NULL),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'loss_receipts',
    'add_title'           => 'Add Loss Receipt',
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
    array("Date", "created_at", TRUE, "created_at", FALSE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          '','in_weight',true),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'in_lot_purity','','',
          'range','in_lot_purity',true),
    array("Out WT", "out_weight", TRUE, "out_weight", TRUE, TRUE,
          'out_weight','','','','out_weight',true),
    array("Loss", "loss", TRUE, "loss", TRUE, TRUE,
          'loss','','','','loss',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE,
          '(balance) as balance','','','','',true),
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
    'account'    => array('Account', '', FALSE, '', TRUE),
    'out_weight'  => array('Out Weight', 'Enter Out Weight', TRUE, '', TRUE),
    'loss'  => array('Loss', 'Enter Loss', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', '', FALSE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  $controller = 'receipt_departments/loss_receipts';
    $actions["Delete"] = array('request' => "http",
                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                              'class' => 'red',
                              'confirm_message' => "Do you want to delete",
                              'data_title' => "Delete",
                              'i_class' => 'far fa-trash-alt font20');
  
  return $actions;
}