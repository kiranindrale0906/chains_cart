<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Machine Masters',
    'primary_table'       => 'machine_masters',
    'default_column'      => 'id',
    'table'               => 'machine_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'product_name, process_name, department_name, machine_name',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'machine_masters',
    'add_title'           => 'Add Machine',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("Machine Size", "machine_size", TRUE, "machine_size", TRUE, TRUE),
    array("Design Code", "design_code", TRUE, "design_code", TRUE, TRUE),
    array("Category one", "category_one", TRUE, "category_one", TRUE, TRUE),
    array("Category two", "category_two", TRUE, "category_two", TRUE, TRUE),
    array("Category three", "category_three", TRUE, "category_three", TRUE, TRUE),
    array("Category four", "category_four", TRUE, "category_four", TRUE, TRUE),
    array("Machine Name", "machine_name", TRUE, "machine_name", TRUE, TRUE),
    array("Machine Count", "machine_count", TRUE, "machine_count", TRUE, TRUE),
    // array("Oprational Time", "oprational_time", TRUE, "oprational_time", TRUE, TRUE),
    array("Out Capacity", "out_capacity", TRUE, "out_capacity", TRUE, TRUE),
    // array("In Capacity", "in_capacity", TRUE, "in_capacity", TRUE, TRUE),
    // array("Time From Melting Lot", "time_from_melting_lot", TRUE, "time_from_melting_lot", TRUE, TRUE),
    // array("Maintenance", "maintenance", TRUE, "maintenance", TRUE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/machine_masters/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "js",
                             'url' => ADMIN_PATH.'masters/machine_masters/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');

  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['machine_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name'  => array('Product Name', 'Enter Product Name', TRUE, '', TRUE),
    'process_name'  => array('Process Name', 'Enter Process Name', TRUE, '', TRUE),
    'department_name'  => array('Department Name', 'Enter Department Name', TRUE, '', TRUE),
    'machine_size'  => array('Machine Size', 'Enter Machine Size', TRUE, '', TRUE),
    'design_code'  => array('Design Code', 'Enter Design Code', TRUE, '', TRUE),
    'machine_name'  => array('Machine Name', 'Enter Machine Name', FALSE, '', TRUE),
    'machine_count'  => array('Machine Count', 'Enter Machine Count', FALSE, '', TRUE),
    'category_one'  => array('Category One', 'Enter Category One', TRUE, '', TRUE),
    'category_two'  => array('Category Two', 'Enter Category Two', TRUE, '', TRUE),
    'category_three'  => array('Category Three', 'Enter Category Three', TRUE, '', TRUE),
    'category_four'  => array('Category Four', 'Enter Category Four', FALSE, '', TRUE),
    'oprational_time'  => array('Oprational Time', 'Enter Oprational Time', FALSE, '', TRUE),
    'out_capacity'  => array('Out Capacity Wt (per day)', 'Enter Out Capacity', FALSE, '', TRUE),
    'in_capacity'  => array('In Capacity', 'Enter In Capacity', FALSE, '', TRUE),
    'time_from_melting_lot'  => array('Time From Melting Lot', 'Enter Time From Melting Lot', FALSE, '', TRUE),
    'maintenance'  => array('Maintenance', 'Enter Maintenance', FALSE, '', TRUE),
    );
  return $attributes[$table][$field];
}