<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Email Logs',
    'primary_table'       => 'library_email_logs',
    'default_column'      => 'id',
    'table'               => 'library_email_logs',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id,hostname',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'Email_logs',
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
  7 => if contain url
  8 => filter type matched, date
  9 => search type text, dropdown,etc
  10 => search popup field
  11 => Table Name
  12 => column
*/

function list_settings() {
  return array(
      array("Action", "action", false, "action", false, false),

      array("Email Status", "status", true, "status", true, false,'status','Email_logs',false,'dropdown',"dropDownList","library_email_logs",'status'),
      array("Template Name", "template_name", true, "template_name", true, false,'template_name'),
      array("Hostname", "hostname", true, "hostname", true, false,'hostname'),
      array("Subject", "subject", true, "subject", true, false,'subject'),
      array("Recipient", "toemail", true, "toemail", true, false,'toemail'),
      array("From Name", "fromname", true, "fromname", true, false,'fromname'),
      array("From email", "fromemail", true, "fromemail", true, false,'fromemail'),
      array("Open time", "opened_at", true, "opened_at", true, false,'opened_at','','date','date'),
      array("Openemail", "openemail", true, "openemail", true, false,'if(openemail=1,"Yes","No") as  openemail'),
      array("Sent time", "delivered_at", true, "delivered_at", true, false,'delivered_at'),
      array("Created time", "created_at", true, "created_at", true, false,'created_at','','date','date'),
      array("Clicked time", "clicked_at", true, "clicked_at", true, false,'  clicked_at','','date','date'),
      array("Bounced time", "bounced_at", true, "bounced_at", true, false,'  bounced_at','','date','date'),
      array("Unscribed time", "unsubscribe_at", true, "unsubscribe_at", true, false,'  unsubscribe_at','','date','date'),
      array("Sendgrid Status", "sendgrid_status", true, "sendgrid_status", true, false,' sendgrid_status'),
      array("CC && BCC", "additiona_email_ids", true, "additiona_email_ids", true, false,'additiona_email_ids'),
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
  $controller = 'communications/email_logs';
  $url = ADMIN_PATH.$controller.'/view/'.$row['id'];
  $actions["View"] = array('request' => "http", 
                           'url' => $url,
                           'confirm_message' => "",
                           'class' => 'btn_green');
  return $actions;
}


function dropDownList($controller,$field,$table) {
  return get_filters($controller,$field,$table);
}

if (!function_exists('log_event')) {
  function log_event($msg, $file_path='') {
    if(empty($file_path)){
      $file_path = FCPATH.'common_log.txt';
    }
    $perfix = '['.datetime().'] '; //add current date time
    $msg = $perfix.$msg."\r\n"; //create new line
    error_log($msg,3, $file_path);
  }
}
