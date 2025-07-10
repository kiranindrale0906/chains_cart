<?php 
function getTableSettings() {
  return  array(
    'page_title' => 'Process Remark Report',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'from_date'       => array('From date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'department_name' => array('Department Name', '', FALSE, '', TRUE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity' => array('Lot Purity', '', FALSE, '', TRUE),
    'remark'     => array('Remark', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

?>