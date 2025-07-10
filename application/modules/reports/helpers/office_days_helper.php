<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Office Days',
    'primary_table'       => 'view_calendars',
    'default_column'      => 'id',
    'table'               => 'view_calendars',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('selected_date BETWEEN "'.date('Y-m-d').'" AND'=>date("Y").'-12-31'),
    'where_ids'           => '',
    'order_by'            => 'id asc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'view_calendars',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
  );
}

/*
  0 => column title
  1 => column name
  2 => order flag
  3 => order column
  4 => filter flag
  5 => expand text flag
  6 => select column
*/

function list_settings() {
  return array(
    array("Id", "id", TRUE, "id", TRUE, TRUE),
    array("Date", "selected_date", TRUE, "selected_date", TRUE, TRUE),
    array("Day", "day", TRUE, "day", TRUE, TRUE),
    array("Open Time", "open_time", TRUE, "open_time", TRUE, TRUE),
    array("Close Time", "close_time", TRUE, "close_time", TRUE, TRUE),
    array("Office Status", "is_closed", TRUE, "is_closed", TRUE, TRUE),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
 
  );
}


function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'id'       => array('', '', TRUE, '', TRUE),
    'selected_date'  => array('Date', 'Date', TRUE, '', TRUE),
    'day'  => array('Day', 'Day', TRUE, '', TRUE),
    'open_time'  => array('Office Open Time', 'Office Open Time', TRUE, '', TRUE),
    'close_time'  => array('Office Close Time', 'Office Close Time', TRUE, '', TRUE),
    'is_closed'  => array('Office Status', 'Office Status', TRUE, '', TRUE),
    
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'reports/office_days';
  $actions["edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  return $actions;
}

?>