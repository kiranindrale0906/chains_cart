<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Person Production List',
    'primary_table'       => 'person_productions',
    'default_column'      => 'id',
    'table'               => array('person_productions'),
    'join_conditions'     => array(),
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'created_at DESC',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'person_productions',
    'add_title'           => 'Add Person Production',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'process_name', FALSE,'',''),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'department_name', FALSE,'',''),
    array("Karigar Name", "karigar", TRUE, "karigar", TRUE, TRUE, 'karigar', 'karigar', FALSE,'',''),
    array("No Of Person", "no_of_person", TRUE, "no_of_person", TRUE, TRUE, 'no_of_person', 'no_of_person', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['person_productions'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'karigar'            => array('Karigar Name', 'Enter Karigar  name', TRUE, '', FALSE),
    'process_name'          => array('Process Name', 'Enter Process Name', TRUE, '', FALSE),
    'department_name'          => array('Department Name', 'Enter Department Name', TRUE, '', FALSE),
    'no_of_person'          => array('No of Person', 'Enter No Of Person', TRUE, '', FALSE),
   
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/person_productions';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}