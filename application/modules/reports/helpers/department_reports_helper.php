<?php

function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'product_name'    => array('Product Name', 'Select product name', FALSE, '', TRUE),
    'from_date'       => array('From date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'hours'         => array('Hours', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', 'Select Department', FALSE, '', TRUE),
    'karigar_name' => array('Karigar Name', 'Select Karigar', FALSE, '', TRUE),
    'process_name' 		=> array('Process Name', 'Select Process', FALSE, '', TRUE),
  );

  return $attributes[$field];
}