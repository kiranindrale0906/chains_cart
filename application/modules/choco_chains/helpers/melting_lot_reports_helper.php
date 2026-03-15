<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Melting Lots List',
    'primary_table'       => 'melting_lots',
    'default_column'      => 'melting_lots.id',
    'table'               => array('melting_lots'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => 'gross_weight > 0',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'melting_lots.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'melting_lots',
    'add_title'           => 'Add Melting Lot',
    'view_title'          => 'Melting Lot View',
    'export_title'        => '',
    'import_title'        => '',
    'clear_filter'        => true
  );
}
?>
