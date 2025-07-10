<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Parent Lots List',
    'primary_table'       => 'parent_lots',
    'default_column'      => 'parent_lots.id',
    'table'               => array('parent_lots'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'parent_lots.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'parent_lots',
    'add_title'           => 'Add Parent Lot',
    'view_title'           => 'Parent Lot View',
    'export_title'        => '',
    'import_title'        => ''
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
    array("Name", "name", false, "name", TRUE, TRUE),
    array("Process", "process_name", false, "process_name", TRUE, TRUE),
    array("Melting", "lot_purity", false, "lot_purity", TRUE, TRUE),
    array("Date", "created_at", false, "created_at", TRUE, TRUE),
     array("", "", false, "status", false, false,'parent_lots.status as status','','','',),
    array("", "action", FALSE, "action", FALSE, FALSE),
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
  $attributes= array(
    'id' => array('', '', FALSE, '', TRUE),
    'name' => array(' Name', '', TRUE, '', TRUE),
    'process_name'  => array('Process', '', TRUE, '', TRUE),
    'lot_purity'  => array('Melting', '', TRUE, '', TRUE),
    'hook_kdm_purity'  => array('Hook Kdm Purity', '', TRUE, '', TRUE),
    'input_type'  => array('Input Type', '', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'melting_lots/parent_lots';
  if(isset($row['status']) && $row['status']==1){
    $actions["Open"] = array('request' => "ajax_post",
                               'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                               'post_data' => array("parent_lots[id]" => $row['id'],
                                                    "parent_lots[status]" => 0,
                                                    "submittype" => 'json'
                                                   ),
                               'class' => 'text-success',
                               'success_function' => '');
  }else{
    $actions["Close"] = array('request' => "ajax_post",
                                'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                                'post_data' => array("parent_lots[id]" => $row['id'],
                                                     "parent_lots[status]" => 1,
                                                     "submittype" => 'json'
                                                    ),
                                'class' => ' text-warning',
                                'success_function' => '');
  }
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');


  return $actions;
}




