<?php 
function getTableSettings() {
  return  array(
    'page_title' => 'Customer order Out Weight Report',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'customer_name'    => array('Customer Name', 'Select Customer name', FALSE, '', TRUE),
    'from_date'       => array('From date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', '', FALSE, '', TRUE),
    'karigar_name' 		=> array('Karigar Name', 'Select Karigar', FALSE, '', TRUE),
    'account' 		=> array('Account', 'Select account', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

?>