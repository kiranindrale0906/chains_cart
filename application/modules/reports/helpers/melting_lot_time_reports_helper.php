<?php 
function getTableSettings() {
 return  array(
    'page_title' => 'In Process Melting Report',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'product_name'    => array('Product Name', 'Select product name', FALSE, '', TRUE),
    'genarate_lot_no'    => array('Genarate Lot No', 'Select Genarate Lot No', FALSE, '', TRUE),
    'customer_name'    => array('Customer Name', 'Select Customer name', FALSE, '', TRUE),
    'order_type'    => array('Order Type', 'Select Order Type', FALSE, '', TRUE),
    );

  return $attributes[$field];
}

?>