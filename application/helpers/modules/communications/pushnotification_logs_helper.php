<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Push Notifications Logs',
    'primary_table'       => 'library_pushnotification_logs',
    'default_column'      => 'id',
    'table'               => 'library_pushnotification_logs',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'Pushnotification_logs',
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
    array("Title", "title", true, "title", true, true,'title'),
    array("Message", "msg", true, "msg", true, true,'msg'),
    array("Url", "url", true, "url", true, true,'url'),
    array("Image", "image", true, "image", true, true,'image'),
    array("Device tokens", "device_token", true, "device_token", true, true,'device_token'),
    array("FCM Response", "fcm_response", true, "fcm_response", true, true,'fcm_response'),
    array("Send Time", "created_at", true, "created_at", true, true,'created_at','','date','date')); 
}