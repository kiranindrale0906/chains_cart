<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array();
}

function get_field_attribute($table, $field) {
    $attributes = array();
    $attributes = array(
      'id' => array('', '', TRUE, '', TRUE),
      'customer_name' => array('Customer Name', 'Select Customer Name', FALSE, '', TRUE),
      'order_no' => array('Order No', 'Select Order No', FALSE, '', TRUE),
      );
    return $attributes[$field];
  }
