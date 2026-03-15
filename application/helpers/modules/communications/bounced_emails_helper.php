<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Bounced Email List',
    'primary_table'       => 'library_bounced_emails',
    'default_column'      => 'id',
    'table'               => 'library_bounced_emails',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'Bounced_emails',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'arrange_column'      => true,
    'custom_table_header' => false,
    'clear_filter'        => true,
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
      array("ID", "id", true, "id", true, false,'id'),
      array("Email", "email_address", true, "email_address", true, false),
      array("Created At", "created_at", true, "created_at", true, true,"created_at",'','date','date'),  
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
  $controller = 'communications/bounced_emails';
  $actions["Delete"] = array('request' => "js",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');
  return $actions;
}