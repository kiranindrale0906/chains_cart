<?php

function getTableSettings() {
  return array(
    'page_title'          => 'Lock Dispatched Reports',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'city'    => array('City', 'Select City', FALSE, '', TRUE),
    'from_date'       => array('From date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'lock_no' => array('Lock No', 'Select Lock No', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Select Melting', FALSE, '', TRUE),
     );

  return $attributes[$field];
}
