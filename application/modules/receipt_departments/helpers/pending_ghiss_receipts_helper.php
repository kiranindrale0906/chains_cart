<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='product_name="Pending Ghiss Receipt"';
  else $where='product_name="Pending Ghiss Receipt" AND archive=0';
  return array(
    'page_title'          => 'Pending Ghiss Receipt List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'pending_ghiss_receipts',
    'add_title'           => 'Add Pending Ghiss Receipt',
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
    array("Date", "created_at", TRUE, "created_at", FALSE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("In WT", "pending_ghiss", TRUE, "pending_ghiss", TRUE, TRUE,'pending_ghiss','','',
          'range','pending_ghiss',true),
    array("Melting", "wastage_lot_purity", TRUE, "wastage_lot_purity", TRUE, TRUE,'wastage_lot_purity','','',
          'range','wastage_lot_purity'),
    array("Out WT", "out_pending_ghiss", TRUE, "out_pending_ghiss", TRUE, TRUE,
          'out_pending_ghiss','','','range','out_pending_ghiss',true),
    array("Balance WT", "balance", TRUE, "balance", TRUE, TRUE,
          'balance_pending_ghiss as balance','','','','',true),

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
    'in_lot_purity'  => array('Melting', 'Enter Melting', FALSE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'processes/processes';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => '',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  if(empty($_GET)) {
    $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  }
  
  if ($row['balance'] != 0)
    $actions["Edit Department"] = array('request' => "http",
                             'url' => ADMIN_PATH.'processes/process_departments/edit/'.$row['id'],
                             'confirm_message' => "",
                             'class' => '',
                             'data_title' =>'View',
                             'i_class'=>'fal fa-file-alt font20');
  return $actions;
}