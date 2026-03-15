<?php defined('BASEPATH') OR exit('No direct script access allowed.');

  function getTableSettings() {
    return array(
      'page_title'          => '',
      'primary_table'       => 'processes',
      'default_column'      => 'id',
      'table'               => 'processes',
      'join_columns'        => '',
      'join_type'           => '',
      'where'               => '',
      'where_ids'           => '',
      'order_by'            => 'id desc',
      'limit'               => "20",
      'extra_select_column' => 'id',
      'actionFunction'      => '',
      'headingFunction'     => 'list_settings',
      'search_url'          => '',
      'add_title'           => '',
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
    return array();
  }

  function get_row_actions($row, $url, $select_url, $filter) {
    $actions = array();
    return $actions;
  }

  function get_field_attribute($table, $field) {
    $attributes = array();
    $attributes["process_factory_order_details"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "out_weight"   => array("Out Weight", "", FALSE, "", TRUE),
      "category_name"   => array("Category name", "", FALSE, "", TRUE),
      "design_name"   => array("Design name", "", FALSE, "", TRUE),
      "market_design_name"   => array("Market design name", "", FALSE, "", TRUE),
      "gauge"   => array("Gauge", "", FALSE, "", TRUE),
      "balance"   => array("Balance", "", FALSE, "", TRUE),
      "line"   => array("Line", "", FALSE, "", TRUE),
      "out_weight"   => array("Out Weight", "", FALSE, "", TRUE),
      "process_id"   => array("", "", FALSE, "", TRUE),
    );
    $attributes["process_fields"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "process_id"  => array("", "", FALSE, "", TRUE),
       "out_weight"   => array("Out Weight", "", FALSE, "", TRUE),
       "factory_order_detail_id"   => array("", "", FALSE, "", TRUE),
       "field_name"   => array("", "", FALSE, "", TRUE),
       "product_name"   => array("", "", FALSE, "", TRUE),
       "process_name"   => array("", "", FALSE, "", TRUE),
    );
    $attributes["factory_order_details"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "process_id"  => array("", "", FALSE, "", TRUE),
       "out_weight"   => array("Out Weight", "", FALSE, "", TRUE),
       "factory_order_detail_id"   => array("", "", FALSE, "", TRUE),
       
    );

    return $attributes[$table][$field];
  }

?>