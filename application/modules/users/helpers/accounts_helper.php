<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Account List',
    'primary_table'       => 'accounts',
    'default_column'      => 'id',
    'table'               => 'accounts',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'accounts',
    'add_title'           => 'Add Accounts',
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
    array("Name", "name", TRUE, "name", FALSE, TRUE, "name as name"),
    array("Email", "email", TRUE, "email", TRUE, TRUE),
    array("Phone No.", "phone_number", TRUE, "  phone_number", TRUE, TRUE),
    array("Address.", "address", TRUE, "address", TRUE, TRUE),
    array("GST No.", "gst_no", TRUE, "gst_no", TRUE, TRUE),
    array("License No.", "license_no", TRUE, "license_no", TRUE, TRUE),
    array("License Validity Date.", "license_validity_date", TRUE, "license_validity_date", TRUE, TRUE),
    // array("Status", "status", TRUE, "status", FALSE, TRUE),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
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
    'name'     => array('Name', 'Enter Name.', TRUE, '', TRUE),
    'email'    => array('User Email ID ', 'Enter Email ID', TRUE, '', TRUE),
    'phone_number'  => array('Phone number', 'Enter Phone number', TRUE, '', TRUE),
    'address'  => array('Address', 'Enter Address', TRUE, '', TRUE),
    'gst_no'  => array('GST NO', 'Enter GST NO', TRUE, '', TRUE),
    'license_no'  => array('License no', 'Enter License No', TRUE, '', TRUE),
    'license_validity_date'  => array('License Validity Date', 'Enter License Validity Date', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'users/accounts';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  $actions["Delete"] = array('request' => "http",
                            'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                            'class' => 'red',
                            'confirm_message' => "Do you want to delete",
                            'data_title' => "Delete",
                            'i_class' => 'far fa-trash-alt font20');
  return $actions;
}