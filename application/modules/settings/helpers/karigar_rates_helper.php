<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Karigar rates',
    'primary_table'       => 'karigar_rates',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'karigar_rates',
    'add_title'           => 'Add Karigar rates',
    'export_title'        => 'Export',
    'edit'                => '',
    'select_column'       => true,
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'karigar_rates.id', 'karigar_rates', FALSE,'autocomplete',''),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','product_name')),
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','process_name')),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','department_name')),
    array("Karigar name", "karigar_name", TRUE, "karigar_name", TRUE, TRUE, 'karigar_name', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','karigar_name')),
    array("Design Code", "design_code", TRUE, "design_code", TRUE, TRUE, 'design_code'),
    array("Rate", "rate", TRUE, "rate", TRUE, TRUE, 'rate', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','rate')),
    array("No of Worker", "no_of_workers", TRUE, "no_of_workers", TRUE, TRUE, 'no_of_workers', 'karigar_rates', FALSE,'autocomplete',array('karigar_rates','no_of_workers')),
    array("Purity", "purity", TRUE, "purity", TRUE, TRUE, 'purity'),
    array("Check Field", "check_field", TRUE, "check_field", TRUE, TRUE, 'check_field'),
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

  $attributes['karigar_rates'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'page_no'              => array('page_no', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Select Product name', TRUE, '', FALSE),
    'process_name'    => array('Process name', 'Select Process name', TRUE, '', FALSE),
    'department_name' => array('Department name', 'Select Department name', TRUE, '', FALSE),
    'karigar_name'    => array('Karigar name', 'Select Karigar name', TRUE, '', FALSE),
    'category'        => array('Category', 'Select Category', FALSE, '', FALSE),
    'code'            => array('Code', 'Select Code', FALSE, '', FALSE),
    'wire_size'       => array('Wire Size', 'Select Wire Size', FALSE, '', FALSE),
    'design_code'     => array('Design Code/Concept', 'Select Design Code', FALSE, '', FALSE),
    'purity'          => array('Purity', 'Select purity', FALSE, '', FALSE),
    'rate'            => array('Rate', 'Enter Rate', TRUE, '', FALSE),
    'no_of_workers'            => array('No Of Worker', 'Enter No Of Worker', TRUE, '', FALSE),
    'check_field'     => array('Check Field', 'Select Check Field', TRUE, '', FALSE),
  );
  $attributes['karigar_rate_worker_details'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'date'            => array('Date', '', false, '', FALSE),
    'no_of_workers'   => array('No Of Workers', '', false, '', FALSE),
    'delete'   => array('', '', false, '', FALSE),
     );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $page_no='';
  $page_no = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if(!empty($page_no)){
      $page_no='?1=1&page_no='.$page_no;
    }
  $controller = 'settings/karigar_rates';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'].$page_no,
                           'confirm_message' => "",
                           'class' => 'green');
  $actions["Delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'].$page_no,
                           'confirm_message' => "Are you sure to delete record?",
                           'class' => 'red');
  return $actions;
}