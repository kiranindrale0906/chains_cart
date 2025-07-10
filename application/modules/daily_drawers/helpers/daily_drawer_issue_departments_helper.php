<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
   $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
    if($show=='yes') $where='product_name="Issue" and karigar = "Factory"';
    else $where='product_name="Issue" and karigar = "Factory" and archive=0';
    
  return array(
    'page_title'          => 'Daily Drawer Issue Department List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => ['processes','users'],
    'join_conditions'     => ['users.id=processes.created_by'],
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'processes.id desc',
    'limit'               => "20",
    'extra_select_column' => 'processes.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'daily_drawer_issue_departments',
    'add_title'           => 'Issue Daily Drawer',
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
    // array("Account", "account", TRUE, "account", FALSE, TRUE, "account as account"),
    array("Type", "type", TRUE, "type", TRUE, TRUE),
    array("Date", "processes.created_at", TRUE, "processes.created_at", FALSE, TRUE),
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Created by", "name", TRUE, "name", TRUE, TRUE, 'users.name name', 'users', FALSE,'autocomplete'),
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
    'type' => array('Type', '', TRUE, '', TRUE),
    'account' => array('Account', '', TRUE, '', TRUE),
    'in_weight' => array('Weight', 'Enter Weight', TRUE, '', TRUE),
    'process_name' => array('Process Name', '', TRUE, '', TRUE),
    'karigar' => array('Issue from Factory to Karigar', 'Select Karigar', TRUE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Select Melting', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
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


