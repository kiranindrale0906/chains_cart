<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Internal Wastages',
  );
}

function get_field_attribute($table, $field) {
  $attributes = array(
    'from_date' => array('Month', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
    'product_name'   => array('Product Name', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}
