<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Department List',
    'primary_table'       => 'departments',
    'default_column'      => 'id',
    'table'               => 'departments',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'departments',
    'add_title'           => 'Add Department',
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
  7 => exect match.
  8 => 
  9 => filter type  //static_dropdonw, dynamic_dropdown,static_multiselect,dynamic_multiselect, 
                     range,daterange,date,autocomplete, this parameter is also used to show image pass image
  10 => filter type array //if static set value need to show array(1,2,3).
        if dynamic filter write query as we do before make alias what we taken on 1st index. if image set path of image.
  11 => for default image full path                      
*/

function list_settings() {
  return array(
    // array("ID", "id", TRUE, "id", TRUE, FALSE, "id", "ID", FALSE,"text"),
    array("Name", "name", TRUE, "name", TRUE, FALSE, "name", "Name", "departments","autocomplete", 
          array("departments","name")),
    array("Karigar Name", "karigar_name", TRUE, "karigar_name", TRUE, FALSE, "karigar_name", "Karigar Name", "departments","autocomplete", 
          array("departments","karigar_name")),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['departments'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'name'  => array('Department Name', 'Select Department Name ', TRUE, '', TRUE),
    'other_departments'  => array('Other Departments', 'Enter Other Departments', FALSE, '', TRUE),
    'karigar_name'  => array('Karigar Name', 'Select Karigar Name ', FALSE, '', TRUE),
    'check_field' => array('Check Field','',FALSE, '', TRUE),
    'department_process_value' => array('Process','',TRUE,'',TRUE)
  );

  $attributes['department_workers'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'date'  => array('Date', '', false, '', FALSE),
    'worker_count' => array('No Of Workers', '', false, '', FALSE),
    'delete'  => array('', '', false, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'settings/departments/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green');
  return $actions;
}