<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'GPC Powder Issue List',
    'primary_table'       => 'issue_departments',
    'default_column'      => 'id',
    'table'               => ['issue_departments'],
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => 'product_name="GPC Powder"',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'issue_departments.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'gpc_powder_issues',
    'add_title'           => 'Add GPC Powder Issue',
    'export_title'        => '',
    'clear_filter'        => true,
    'edit'                => ''
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
  7 => module name
  8 => exact match(true or false) not like query == match
  9 => filter(autocomplete,select,statis,multiselect etc.)
  10 => array('table name', 'field name')
*/

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Account Name", "account_name", TRUE, "account_name", TRUE, TRUE, 'account_id as account_name'),
    array("Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("Melting", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Date", "issue_departments.created_at", TRUE, "issue_departments.created_at", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
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

  $attributes['gpc_powder_issues'] = array(
    'id' => array('', '', TRUE, '', TRUE),
    'product_name' => array('Product Name', 'Select Product', TRUE, '', TRUE),
    'account_id'    => array('Account Type', 'Select Account Type', FALSE, '', TRUE),
    'in_weight'  => array('Weight', '', TRUE, '', TRUE),
    'in_purity'  => array('Melting', '', TRUE, '', TRUE),
    'description'  => array('Description', '', TRUE, '', TRUE),
    'company_name' => array('Company Name', '', FALSE, '', TRUE),
    
      );

  

  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'issue_departments/issue_departments/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  return $actions;
}

