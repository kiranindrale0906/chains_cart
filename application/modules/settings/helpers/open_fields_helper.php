<?php
function getTableSettings() {
  return array(
    'page_title'          => 'Open Fields',
    'primary_table'       => 'open_fields',
    'default_column'      => 'id',
    'table'               => 'open_fields',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'open_fields',
    'add_title'           => 'Add Open Field',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter' => true,
  );
}

function list_settings() {
  return array(
    array("In", "in", TRUE, "in", FALSE, FALSE, 'in', 'Settings', FALSE,FALSE),
    array("Out", "out", TRUE, "out", FALSE, FALSE, 'out', 'settings', FALSE,FALSE),
    array("Description", "description", TRUE, "description", FALSE, FALSE, 'description', 'settings', FALSE,FALSE),
    array("Purity", "purity", TRUE, "purity", FALSE, FALSE, 'purity', 'purity', FALSE,FALSE),
    array("Action", "action", FALSE, "action", FALSE, FALSE)
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions['edit'] = array('request' => 'http',
                            'url' => ADMIN_PATH.'settings/open_fields/edit/'.$row['id'],
                            'confirm_message' => '',
                            'class' => 'btn_green'
                      );
  $actions['delete'] = array('request'=>'http',
                              'url'=>ADMIN_PATH.'settings/open_fields/delete/'.$row['id'],
                              'confirm_message'=>'',
                              'class'=>'btn_red'
                       );
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['open_fields'] = array(
                                'id'=>array('','',FALSE,'',FALSE),
                                'in'=>array('IN Weight','Enter In weitght',TRUE,'',TRUE),
                                'out'=>array('OUT Weight','Enter Out weitght','','',TRUE),
                                'description'=>array('Description','Enter Description',TRUE,'',TRUE),
                                'purity'=>array('Purity','Enter Purity',TRUE,'',TRUE)
                               );
  return $attributes[$table][$field];
}