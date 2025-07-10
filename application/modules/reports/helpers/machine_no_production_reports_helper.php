<?php
function getTableSettings() {
  return array(
    'page_title'          => 'Machine No Production Reports',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'from_date'       => array('From Date', '', FALSE, '', TRUE),
    'process_name'       => array('Process Name', '', FALSE, '', TRUE),
    'product_name'       => array('Product Name', '', FALSE, '', TRUE),
    'department_name'       => array('Department Name', '', FALSE, '', TRUE),
    'machine_no'         => array('Machine No', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
    'under_utilization' => array('Under Utilization', '', FALSE, '', TRUE),
    'group_by' => array('Group By', '', FALSE, '', TRUE),
   );

  return $attributes[$field];
}