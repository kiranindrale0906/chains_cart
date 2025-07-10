<?php 
function getTableSettings() {
 return  array(
    'page_title' => 'Complete Melting Report',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'product_name'    => array('Product Name', 'Select product name', FALSE, '', TRUE),
    );

  return $attributes[$field];
}

?>