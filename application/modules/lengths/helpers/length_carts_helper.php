<?php
function getTableSettings() {
  return array(
    'page_title'          => 'Length_carts',
    'primary_table'       => 'length_cart_details',
    'default_column'      => 'id',
    'table'               => 'length_cart_details',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'length_carts',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter' => true,
  );
}