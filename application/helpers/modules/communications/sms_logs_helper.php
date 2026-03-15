<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Sms Logs',
    'primary_table'       => 'library_sms_logs',
    'default_column'      => 'id',
    'table'               => 'library_sms_logs',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'Sms_logs',
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
      array("Sms Status", "status", true, "status", true, false,'status','Sms_logs',false,'dropdown',"dropDownList","library_sms_logs",'status'),
      array("Recipient", "smsto", true, "smsto", true, false,'smsto'),
      array("From", "smsfrom", true, "smsfrom", true, false,'smsfrom'),
      array("SMS Text", "smstext", true, "smstext", true, false,'smstext'),
      array("Send Time", "created_at", true, "created_at", true, false,'created_at','','date','date'),
      array("Twillio Response", "curlresponse", true, "curlresponse", false, false,'curlresponse'),
  ); 
}

function dropDownList($controller,$field,$table) {
  return get_filters($controller,$field,$table);
}