<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Tounch Report List',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           =>'',
    'where'               => 'tounch_in != (tounch_out+tounch_ghiss)',
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "receipt_department_list",
    "add_title"           => "",
    "export_title"        => "",
    'select_column'       => true,                // Can user select columns on the table
    'arrange_column'      => true,                // Can user arrange columns on the table  
    'clear_filter'        => true,                // To be removed 
    "edit"
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
               array("Tounch No","tounch_no",false,"tounch_no",false,false,'ROUND(tounch_no,0) as tounch_no'),
               array("Department","department_name",false,"department_name",false),
               array("In","tounch_in",false,"tounch_in",false,TRUE,'tounch_in','','','range','',true),
               array("Out Weight","out_weight",false,"out_weight",false,TRUE,'out_weight','','','range','',true),
               array("Out Lot Purity","out_lot_purity",false,"out_lot_purity",false,false,
                     'FORMAT(out_lot_purity,4) as out_lot_purity'),
               array("Design Code","design_code",false,"design_code",false,false),                           
               array("Melting Lot No","lot_no",false,"lot_no",false,false),                           
               array("Out","tounch_out",false,"tounch_out",false,TRUE,'tounch_out','','',
                     'range','',true),                           
               array("Tounch Ghiss","tounch_ghiss",false,"tounch_ghiss",false,TRUE,'tounch_ghiss','','',
                     'range','',true),                           
               array(" Tounch Purity %","tounch_purity",false,"tounch_purity",false,false,
                     'FORMAT(tounch_purity,4) as tounch_purity'), 
               array(" Tounch Loss Fine","tounch_loss_fine",false,"tounch_loss_fine",false,false,
                     'tounch_loss_fine','','','range','',true),                          
               array("Action","action",false,"action",false,false),                                             );
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
  $attributes = array(
    'id'            => array('', '', TRUE, '', TRUE),
    'tounch_in'       => array('Tounch In', '', TRUE, '', TRUE),
    'out_weight'       => array('Out Weight', '', TRUE, '', TRUE),
    'out_lot_purity'       => array('Out Lot Purity', '', TRUE, '', TRUE),
    'tounch_ghiss'       => array('Tounch Ghiss', '', TRUE, '', TRUE),
    'tounch_out'       => array('Out', '', TRUE, '', TRUE),
    'tounch_purity'       => array('Purity', '', TRUE, '', TRUE),
    'page_no'       => array('', '', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'tounch_outs/tounch_reports';
  if($row['tounch_out']==0){
  $actions["Edit"] = array('request' => "http",
                            'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'].'?page_no='.@$_GET['page_no'],
                            'confirm_message' => "",
                            'target'=>'',
                            'class' =>'blue',
                            'data_title' =>'Logs',
                            'attributes'=>array('i_class'=>'fal fa-history font20',
                                                'data_title' =>'Logs'),
                            'data-target'=>'#ajax-modal',
                            'modal_class' =>'modal-lg');

 }
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  return $actions;
}




