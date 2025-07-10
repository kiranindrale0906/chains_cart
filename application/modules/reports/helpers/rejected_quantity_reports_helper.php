<?php 
function getTableSettings() {
  return  array(
    'page_title' => 'Rejected Quantity Report',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'product_name'    => array('Product Name', 'Select product name', FALSE, '', TRUE),
    'from_date'       => array('From date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', '', FALSE, '', TRUE),
    'karigar_name' 		=> array('Karigar Name', 'Select Karigar', FALSE, '', TRUE),
    'account' 		=> array('Account', 'Select account', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

?>