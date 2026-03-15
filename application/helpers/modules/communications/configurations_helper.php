<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Configuration',
    'primary_table'       => 'library_communication_configurations',
    'default_column'      => 'id',
    'table'               => 'library_communication_configurations',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => '',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'arrange_column'      => true,
    'custom_table_header' => false,
    'clear_filter'        => true,
    'save_dashboard'      => false,
  );
}

function list_settings(){
  
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
  $attributes['configurations'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'hostname'  => array('Host Name', 'e.g. smtp.sendgrid.net', FALSE, '', FALSE),
    'username'  => array('User Name', 'e.g. ABCD', FALSE, '', FALSE),
    'password'  => array('Password', 'Enter Password', FALSE, '', FALSE),
    'smtpsecure'  => array('Smpt Secure', 'e.g tls', FALSE, '', FALSE),
    'port'  => array('Port', 'e.g. 587', FALSE, '', FALSE),
    'fromemail'  => array('From', 'e.g info@e.website.com', FALSE, '', FALSE),
    'fromname'  => array('From Name', 'e.g ABCD', FALSE, '', FALSE),
    'cc'  => array('CC', 'e.g dev@website.com,tester@website.com', FALSE, '', FALSE),
    'bcc'  => array('Bcc', 'e.g managers@website.com', FALSE, '', FALSE),
    'sengrid_api_key'  => array('SendGrid Api Key', 'e.g xx-xxxxxxx', FALSE, '', FALSE),
    'pushtoken'  => array('Access Token', 'e.g Enter Access Token', FALSE, '', FALSE),
    'webpushtoken'  => array('Web Access Token', 'e.g Enter Web Access Token', FALSE, '', FALSE),
    'webauthdomain'  => array('Auth Domain', 'e.g Enter Auth Domain', FALSE, '', FALSE),
    'webdatabaseurl'  => array('DataBase URL', 'e.g Enter DataBase URL', FALSE, '', FALSE),
    'webprojectid'  => array('ProjectId', 'e.g Enter ProjectId', FALSE, '', FALSE),
    'webstoragebucket'  => array('Storage Bucket', 'e.g Enter Storage Bucket', FALSE, '', FALSE),
    'webmessagingsenderid'  => array('Messaging SenderId', 'e.g Messaging SenderId', FALSE, '', FALSE),
    'webappid'  => array('AppId', 'e.g AppId', FALSE, '', FALSE),
    'webmeasurementid'  => array('MeasurementId', 'e.g Enter MeasurementId', FALSE, '', FALSE),
    'smsusername'  => array('Username', 'e.g Enter Username', FALSE, '', FALSE),
    'smspassword'  => array('Password', 'e.g Enter Password', FALSE, '', FALSE),
    'twilio_sid'  => array('Twilio SID', 'Enter Twilio SID', FALSE, '', FALSE),
    'twilio_auth_token'  => array('Auth Token', 'Enter Twilio Auth token', FALSE, '', FALSE),
    'twilio_phone_number'  => array('Phone Number', 'Enter Phone number', FALSE, '', FALSE),
    'twilio_twiml_bin_url'  => array('TwiML Bin Url', 'Enter TwiML Bin URL', FALSE, '', FALSE),
  );
   return $attributes[$table][$field];
}