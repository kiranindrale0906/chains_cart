<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array();
} 
function get_field_attribute($table, $field) {
  $attributes = array(
    'item_code'   => array('Item Code', '', FALSE, '', TRUE),
    'customer_name'   => array('Customer Name', 'Select', FALSE, '', TRUE),
    'purity'   => array('Purity', 'Select', FALSE, '', TRUE),
    'from_date' => array('From date', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

?>
