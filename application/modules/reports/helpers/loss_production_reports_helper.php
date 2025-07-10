<?php
function getTableSettings() {
  return array(
    'page_title'          => 'Loss Production Reports',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'   => array('', '', FALSE, '', TRUE),
    'from_date' => array('Start Date', '', FALSE, '', TRUE),
    'to_date' => array('End Date', '', FALSE, '', TRUE),
    'karigar_name' => array('Karigar Name', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', '', FALSE, '', TRUE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'in_lot_purity' => array('Purity', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}