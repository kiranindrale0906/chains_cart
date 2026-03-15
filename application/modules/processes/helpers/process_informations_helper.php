<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "",
    "primary_table"       => "process_informations",
    "default_column"      => "id",
    "table"               => "",
    "join_conditions"     => "",
    "join_type"           => "",
    "where"               => "",
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "process_informations",
    "add_title"           => "",
    "export_title"        => "",
    "edit"                => "",
    'clear_filter'        => true
  );
}



        
function list_settings() {
  return array();
}
function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'id'       => array('', '', false, '', TRUE),
    'process_id'       => array('process_id', '', false, '', TRUE),
    'in_weight'       => array('In Weight', '', TRUE, '', TRUE),
    'out_weight'       => array('Out Weight', '', false, '', TRUE),
    'wastage'       => array('Wastage', '', false, '', TRUE),
    'loss'       => array('Loss', '', false, '', TRUE),
    'stone_vatav'       => array('Stone Vatav', '', false, '', TRUE),
    );

  return $attributes[$field];
}



