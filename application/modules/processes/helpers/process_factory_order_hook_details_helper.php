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
    $attributes["process_factory_order_hook_details"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "customer_out"   => array("Out Weight", "", FALSE, "", TRUE),
      "process_id"   => array("", "", FALSE, "", TRUE),
      "parent_id"   => array("", "", FALSE, "", TRUE),
      "order_id"   => array("", "", FALSE, "", TRUE),
      "balance"   => array("Balance", "", FALSE, "", TRUE),
    );
    $attributes["factory_order_details"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "process_id"  => array("", "", FALSE, "", TRUE),
      "customer_out"   => array("", "", FALSE, "", TRUE),
      "wt_in_18_inch"   => array("", "", FALSE, "", TRUE),
      "wt_in_24_inch"   => array("", "", FALSE, "", TRUE),
      "wt_per_inch"   => array("", "", FALSE, "", TRUE),
      "due_date"   => array("", "", FALSE, "", TRUE),
      "factory_order_detail_id"   => array("", "", FALSE, "", TRUE),
      'customer_name' => array('', '', true, '', FALSE),
      'ka_chain_factory_order_id'=> array('', '', true, '', FALSE),
      '14_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '15_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '16_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '17_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '18_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '19_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '20_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '21_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '22_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '23_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '24_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '25_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '26_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '27_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '28_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '29_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '30_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '31_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '32_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '33_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '34_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '35_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '36_inch_qty_ready'     => array('', '', TRUE, '', TRUE),
      '14_inch_qty'     => array('', '', TRUE, '', TRUE),
      '15_inch_qty'     => array('', '', TRUE, '', TRUE),
      '16_inch_qty'     => array('', '', TRUE, '', TRUE),
      '17_inch_qty'     => array('', '', TRUE, '', TRUE),
      '18_inch_qty'     => array('', '', TRUE, '', TRUE),
      '19_inch_qty'     => array('', '', TRUE, '', TRUE),
      '20_inch_qty'     => array('', '', TRUE, '', TRUE),
      '21_inch_qty'     => array('', '', TRUE, '', TRUE),
      '22_inch_qty'     => array('', '', TRUE, '', TRUE),
      '23_inch_qty'     => array('', '', TRUE, '', TRUE),
      '24_inch_qty'     => array('', '', TRUE, '', TRUE),
      '25_inch_qty'     => array('', '', TRUE, '', TRUE),
      '26_inch_qty'     => array('', '', TRUE, '', TRUE),
      '27_inch_qty'     => array('', '', TRUE, '', TRUE),
      '28_inch_qty'     => array('', '', TRUE, '', TRUE),
      '29_inch_qty'     => array('', '', TRUE, '', TRUE),
      '30_inch_qty'     => array('', '', TRUE, '', TRUE),
      '31_inch_qty'     => array('', '', TRUE, '', TRUE),
      '32_inch_qty'     => array('', '', TRUE, '', TRUE),
      '33_inch_qty'     => array('', '', TRUE, '', TRUE),
      '34_inch_qty'     => array('', '', TRUE, '', TRUE),
      '35_inch_qty'     => array('', '', TRUE, '', TRUE),
      '36_inch_qty'     => array('', '', TRUE, '', TRUE),
    );
    return $attributes[$table][$field];
  }

?>