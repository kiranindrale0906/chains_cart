<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'All Communication Templates',
    'primary_table'       => 'library_communication_templates',
    'default_column'      => 'id',
    'table'               => 'library_communication_templates',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id,sentemails,pushtext,smstext,webpushtext',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'Templates',
    'add_title'           => 'Add Communication Templates',
    'export_title'        => '',
    'edit'                => '',
    'add_method'          => '',
    'is_reload'           => true,
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
      array("Name", "name", true, "name", true, false,'name'),
  );
}

/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => Class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/ 
function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['templates'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'template_code'  => array('Template Code', 'e.g. 40', FALSE, '', FALSE),
    'name'  => array('Name', 'e.g. Template 1', TRUE, '', ''),
    'sampledata'  => array('Sample Data', 'Place your Sample data', FALSE, '', FALSE),
    'emailcomment'  => array('Comment', '', FALSE, '', ''),
    'fromemail'  => array('Name', 'e.g info@website.com', FALSE, '', FALSE),
    'fromname'  => array('From Name', 'e.g Website',FALSE, '', FALSE),
    'cc'  => array('CC', 'e.g dev@website.com,tester@website.com',FALSE, '',FALSE),
    'bcc'  => array('Bcc', 'e.g managers@website.com',FALSE, '', FALSE),
    'emailto'  => array('To', 'e.g managers@website.com',FALSE, '',FALSE),
    'emailsubject'  => array('Subject', 'e.g Expenses Approve',FALSE, '',FALSE),
    'emailbody'  => array('Body', '',TRUE, '',FALSE),
    'pushto'  => array('To', '',FALSE, '',FALSE),
    'pushtext'  => array('Notification Message', '',FALSE, '',FALSE),
    'pushurl'  => array('Url', '',FALSE, '',FALSE),
    'pushimage'  => array('Image', '',FALSE, '',FALSE),
    'smsto'  => array('To', '',FALSE, '',FALSE),
    'webpushto'  => array('To', '',FALSE, '',FALSE),
    'webpushtext'  => array('Notification Message', '',FALSE, '',FALSE),
    'webpushurl'  => array('Url', '',FALSE, '',FALSE),
    'webpushimage'  => array('Image', '',FALSE, '',FALSE),
    'smsto'  => array('To', '',FALSE, '',FALSE),
    'smstext'  => array('Text Message', '',FALSE, '',FALSE),
    'communication_type'  => array('Communication Type', '',FALSE, '',FALSE),
    'user_type'  => array('User Type', '',FALSE, '',FALSE),
  );
  return $attributes[$table][$field];
}

function user_types(){
  return array(
    array('name'=>'Admin',
          'id'=>'0'),
    array('name'=>'Professional',
          'id'=>'1'),
    array('name'=>'Business/Customer',
          'id'=>'2'),
    array('name'=>'Service Partner',
          'id'=>'3'));
}

function communication_types(){
  return array(
    array('name'=>'Transactional',
          'id'=>'0'),
    array('name'=>'Marketing',
          'id'=>'1'));
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
  $controller = 'communications/templates';
  $url='';
  $actions["Edit"] = array('request' => "http", 
                           'url' => base_url().$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'd-block bold btn_green ajax');
  $actions["Preview Email"] = array('request' => "http", 
                           'url' => base_url().'communications/preview_emails/create/'.$row['id'],
                           'confirm_message' => "",
                           'class' => ' btn_green');
  if(!empty($row['smstext'])){
    $actions["Preview SMS"] = array('request' => "http", 
                           'url' => base_url().'communications/preview_smservices/create/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green');
  }
  if(!empty($row['pushtext'])){
   $actions["Preview Notification"] = array('request' => "http", 
                           'url' => base_url().'communications/preview_pushnotifications/create/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green'); 
  }

  if(!empty($row['webpushtext'])){
   $actions["Preview Web Notification"] = array('request' => "http", 
                           'url' => base_url().'communications/preview_web_pushnotifications/create/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green'); 
  }
  
  $actions["Delete"] = array('request' => "js",
                             'url' => base_url().$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');
  return $actions;
}