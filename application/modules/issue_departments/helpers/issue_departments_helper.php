<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='';
  else $where='issue_departments.status=0';
  return array(
    'page_title'          => 'Issue Department List',
    'primary_table'       => 'issue_departments',
    'default_column'      => 'id',
    'table'               => ['issue_departments','users'],
    'join_conditions'     => ['users.id=issue_departments.created_by'],
    'join_type'           => '',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'issue_departments.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'issue_departments',
    'add_title'           => 'Add Issue Department',
    'export_title'        => '',
    'clear_filter'        => true,
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
  7 => module name
  8 => exact match(true or false) not like query == match
  9 => filter(autocomplete,select,statis,multiselect etc.)
  10 => array('table name', 'field name')
*/

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Account Name", "account_id", TRUE, "account_id", TRUE, TRUE, 'account_id'),
    array("Packet No", "packet_no", TRUE, "packet_no", TRUE, TRUE),
    array("Issue Type", "issue_type", TRUE, "issue_type", TRUE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Customer Name", "customer_name", TRUE, "customer_name", TRUE, TRUE),
    array("Total WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','','range','',true),
    array("Melting", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("Fine", "in_fine", TRUE, "in_fine", TRUE, TRUE,'in_fine','','','range','',true),
    array("Issue Melting", "out_purity", TRUE, "out_purity", TRUE, TRUE),
    array("Wastage", "wastage_percentage", TRUE, "wastage_percentage", TRUE, TRUE),
    array("Wastage Percentage", "wastage", TRUE, "wastage", TRUE, TRUE,"ROUND((in_weight*out_purity/100),4) as wastage",'','','range','',true),
    array("Issue Fine", "out_fine", TRUE, "out_fine", TRUE, TRUE,'out_fine','','','range',''),
    array("Internal Wastage", "internal_wastage", TRUE, "internal_wastage", TRUE, TRUE,'internal_wastage'),
    array("Date", "issue_departments.created_at", TRUE, "issue_departments.created_at", FALSE, TRUE),
    array("Created by", "name", TRUE, "name", TRUE, TRUE, 'users.name name', 'users', FALSE,'autocomplete'),
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

  $attributes['issue_departments'] = array(
    'id' => array('', '', TRUE, '', TRUE),
    'product_name' => array('Product Name', 'Select Product', TRUE, '', TRUE),
    'account_id'    => array('Account Name', 'Select Account Type', FALSE, '', TRUE),
    'issue_type'    => array('Issue Type', 'Select Issue Type', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'in_weight'  => array('Total Weight', '', TRUE, '', TRUE),
    'in_purity'  => array('Melting', '', TRUE, '', TRUE),
    'in_fine'  => array('Fine', '', TRUE, '', TRUE),
    'out_purity'  => array('Issue Melting', 'Enter Issue Melting', TRUE, '', TRUE),
    'wastage_percentage'  => array('Customer Wastage', 'Enter Customer Wastage', TRUE, '', TRUE),
    'internal_wastage'  => array('Internal Wastage', 'Select Wastage', TRUE, '', TRUE),
    'out_fine'  => array('Issue Fine', '', TRUE, '', TRUE),
    'field_name' => array('', '', TRUE, '', TRUE),
    'company_name' => array('Company Name', '', FALSE, '', TRUE),
    'chain_name' => array('Issue Chain Name', '', FALSE, '', TRUE),
    'chain_purity' => array('Chain Purity', '', FALSE, '', TRUE),
    'hook_kdm_purity' => array('Hook KDM Purity', '', FALSE, '', TRUE),
    'chain_margin' => array('Chain Margin', '', FALSE, '', TRUE),
    'category_one' => array('Category One', '', FALSE, '', TRUE),
    'department_name' => array('Department', '', FALSE, '', TRUE),
    'parent_lot_name' => array('Parent lot name', '', FALSE, '', TRUE),
    'wastage_fine' => array('Wastage Fine', '', FALSE, '', TRUE),
    'customer_name' => array('Customer Name', '', FALSE, '', TRUE),
    'quantity' => array('Quantity', '', FALSE, '', TRUE),

  );

  $attributes['issue_department_details'] = array(
    'process_id' => array('', '', TRUE, '', TRUE),
    'out_weight' => array('', '', TRUE, '', TRUE),
    'quantity' => array('', '', TRUE, '', TRUE),
    'design_chitti_name' => array('', '', TRUE, '', TRUE),
    /*'lot_no' => array('', '', TRUE, '', TRUE),
    'design_code' => array('', '', TRUE, '', TRUE),
    'description' => array('', '', TRUE, '', TRUE),
    'out_weight' => array('', '', TRUE, '', TRUE),
    'out_purity' => array('', '', TRUE, '', TRUE),
    'fine' => array('', '', TRUE, '', TRUE),*/
  );
  $attributes['issue_department_chitti_details'] = array(
    'chitti_id' => array('', '', TRUE, '', TRUE),
    'out_weight' => array('', '', TRUE, '', TRUE),
    /*'lot_no' => array('', '', TRUE, '', TRUE),
    'design_code' => array('', '', TRUE, '', TRUE),
    'description' => array('', '', TRUE, '', TRUE),
    'out_weight' => array('', '', TRUE, '', TRUE),
    'out_purity' => array('', '', TRUE, '', TRUE),
    'fine' => array('', '', TRUE, '', TRUE),*/
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
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'issue_departments/issue_departments/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');

  return $actions;
}

