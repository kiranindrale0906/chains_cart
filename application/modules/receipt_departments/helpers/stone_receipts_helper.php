<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Stone Receipt List',
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
    'search_url'          => 'stone_receipts',
    'add_title'           => 'Add Stone Receipt',
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
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          '','in_weight',true),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'in_lot_purity','','',
          'range','in_lot_purity',true),
    array("Out WT", "out_stone_vatav", TRUE, "out_stone_vatav", TRUE, TRUE,
          'out_stone_vatav','','','','out_stone_vatav',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE,
          '(balance) as balance','','','','',true),

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
    'account'    => array('Account', '', FALSE, '', TRUE),
    'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', '', FALSE, '', TRUE),
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
  // $controller = 'receipt_departments/stone_receipts';
  // if($row['in_weight']==$row['balance']){
  //   $actions["Delete"] = array('request' => "http",
  //                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
  //                             'class' => 'red',
  //                             'confirm_message' => "Do you want to delete",
  //                             'data_title' => "Delete",
  //                             'i_class' => 'far fa-trash-alt font20');

  // }
  
  return $actions;
}