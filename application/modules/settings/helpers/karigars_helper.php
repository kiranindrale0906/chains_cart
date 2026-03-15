<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Karigars',
    'primary_table'       => 'karigar_masters',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'karigar_masters',
    'add_title'           => 'Add Karigar',
    'export_title'        => '',
    'import_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'custom_table_header' => false,
    
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'karigar_masters.id', 'karigars', FALSE,'autocomplete',''),
    array("Chain name", "chain_name", TRUE, "chain_name", TRUE, TRUE, 'chain_name', 'karigars', FALSE,'autocomplete',array('karigar_masters','chain_name')),
    array("Karigar name", "karigar_name", TRUE, "karigar_name", TRUE, TRUE, 'karigar_name', 'karigars', FALSE,'autocomplete',array('karigar_masters','karigar_name')),
    array("Hook Kdm Purity", "hook_kdm_purity", TRUE, "hook_kdm_purity", TRUE, TRUE, 'hook_kdm_purity', 'hook_kdm_purity', FALSE,'autocomplete',array('karigar_masters','hook_kdm_purity')),
  
    array("Action", "action", FALSE, "action", FALSE, FALSE),
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
  $attributes['karigars'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'karigar_name'    => array('Karigar name', 'Enter Karigar name', TRUE, '', FALSE),
    'chain_name'    => array('Chain name', 'Select Chain name', TRUE, '', FALSE),
    'hook_kdm_purity'    => array('Hook KDM Purity', 'Select Hook KDM Purity', TRUE, '', FALSE),
    );
  
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $page_no='';
  $page_no = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if(!empty($page_no)){
      $page_no='?1=1&page_no='.$page_no;
    }
  $controller = 'settings/karigars';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'].$page_no,
                           'confirm_message' => "",
                           'class' => 'green');
  $actions["Delete"] = array('request' => "js",
                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'].$page_no,
                              'confirm_message' => "Do you want to delete",
                              'js_function' => "",
                              'class' => 'text-danger');
  return $actions;
}