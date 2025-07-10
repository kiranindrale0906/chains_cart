<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Monthly Targets',
    'primary_table'       => 'monthly_targets',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'monthly_targets',
    'add_title'           => 'Add Monthly Targets',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Month", "month", TRUE, "month", TRUE, TRUE, 'month', 'month', FALSE,'autocomplete',''),
    array("Year", "year", TRUE, "year", TRUE, TRUE, 'year', 'year', FALSE,'autocomplete',''),
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'product_name', FALSE,'autocomplete',''),
    array("Target Production", "target_production", TRUE, "target_production", TRUE, TRUE, 'target_production', 'target_production', FALSE,'autocomplete',''),
    array("Target Rolling", "target_rolling", TRUE, "target_rolling", TRUE, TRUE, 'target_rolling', 'target_rolling', FALSE,'autocomplete',''),
    array("Target Gross Stock", "target_gross_stock", TRUE, "target_gross_stock", TRUE, TRUE, 'target_gross_stock', 'target_gross_stock', FALSE,'autocomplete',''),
    array("Daily Production", "daily_production", TRUE, "daily_production", TRUE, TRUE, 'daily_production', 'daily_production', FALSE,'autocomplete',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['monthly_targets'] = array(
    'id'                  => array('ID', '', false, '', FALSE),
    'month'               => array('Month', 'Select Month', TRUE, '', FALSE),
    'year'                => array('Year', 'Select Year', TRUE, '', FALSE),
    'product_name'        => array('Product Name', 'Enter Product name', TRUE, '', FALSE),
    'target_production'   => array('Target Production', 'Enter Target Production', TRUE, '', FALSE),
    'target_rolling'      => array('Target Rolling', 'Enter Target Rolling', TRUE, '', FALSE),
    'target_gross_stock'  => array('Target Gross Stock', 'Enter Target Gross Stock', TRUE, '', FALSE),
    'daily_production'    => array('Daily Production', 'Enter Daily Production', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/monthly_targets';
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