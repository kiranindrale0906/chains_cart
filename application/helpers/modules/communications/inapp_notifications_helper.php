<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'inapp NotificationList',
    'primary_table'       => 'inapp_notification_logs',
    'default_column'      => 'id',
    'table'               => 'inapp_notification_logs',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'inapp_notifications',
    'add_title'           => 'add',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'arrange_column'      => true,
    'custom_table_header' => false,
    'clear_filter'        => true,
    'save_dashboard'      => false,
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
      array("Action", "action", false, "action", false, false),
      array("User id", "user_id", true, "user_id", true, false,'user_id'),
      array("Message", "message", true, "message", true, false,'message'),
      array("Link", "link", true, "link", true, false,'link'),
  );
}

/*
Key-value options neccessary for below request's
1. http
  [0] => 'request'
  [1] => 'url'
  [2] => 'confirm_message'
  [3] => 'class'

2. js
  [0] => 'request'
  [1] => 'confirm_message'
  [2] => 'url'
  [3] => 'js_function'
  [4] => 'class'

3. ajax
  [0] => 'request'
  [1] => 'url'
  [2] => 'class'

3. ajax_post
  [0] => 'request'
  [1] => 'url'
  [2] => 'post_data'
  [3] => 'class'  
*/
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'communications/inapp_notifications';
  $actions["Delete"] = array('request' => "js",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['inapp_notifications'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'user_id' => array('', 'Enter user id', FALSE, '', FALSE),
    'link'  => array('', 'Enter eg.www.example.com', FALSE, '', FALSE),
    'message'  => array('', 'Enter Inapp Notification Message', FALSE, '', FALSE),
  );
   return $attributes[$table][$field];
}