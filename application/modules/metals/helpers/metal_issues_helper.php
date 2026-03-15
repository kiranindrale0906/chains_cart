<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Metal Issue List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="Metal Issue"',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'metal_issues',
    'add_title'           => 'Add Metal Issue',
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
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
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
    'in_weight'  => array('In Wt', 'Enter In Wt', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
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
  
  return $actions;
}


