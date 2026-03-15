<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Product Worker Report',
  );
}

function get_field_attribute($table, $field) {
  $attributes = array(
    'from_date' => array('From date', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}
