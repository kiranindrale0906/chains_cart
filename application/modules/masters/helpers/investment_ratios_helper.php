<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Investment Ratios',
    'primary_table'       => 'investment_ratios',
    'default_column'      => 'id',
    'table'               => 'investment_ratios',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'investment_ratios',
    'add_title'           => 'Add Investment Ratios',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Colour", "colour", TRUE, "colour", TRUE, TRUE),
    array("Purity ", "purity ", FALSE, "purity ", FALSE, TRUE),
    array("Ratio ", "ratio", FALSE, "ratio", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/investment_ratios/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['investment_ratios'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'colour'  => array('Colour', 'Select', TRUE, '', TRUE),
    'purity'  => array('Purity', 'Select Purity', TRUE, '', TRUE),
    'ratio'  => array('Ratio', 'Select Ratio', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}