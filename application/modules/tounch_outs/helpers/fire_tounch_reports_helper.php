<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  // if (HOST=='ARF')
  //   $where = 'fire_tounch_in != 0';
  // else
    $where = 'fire_tounch_in != 0 and fire_tounch_out = 0';
  return  array(
    'page_title'          => 'Fire Tounch Report List',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           =>'',
    'where'               => $where,
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "fire_tounch_report_lists",
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
                array("Fire Tounch No","fire_tounch_no",false,"fire_tounch_no",false,false,'ROUND(fire_tounch_no,0) as fire_tounch_no'),
                array("In","fire_tounch_in",false,"fire_tounch_in",false,TRUE,'fire_tounch_in','','','range','',true),
                array("Out Weight","out_weight",false,"out_weight",false,TRUE,'out_weight','','','range','',true),
                array("Out Lot Purity","out_lot_purity",false,"out_lot_purity",false,false,'FORMAT(out_lot_purity,4) as out_lot_purity'),
                array("Design Code","design_code",false,"design_code",false,false),                           
                array("Melting Lot No","lot_no",false,"lot_no",false,false),                           
                array("Out","fire_tounch_out",false,"fire_tounch_out",false,TRUE,'fire_tounch_out','','','range','',true),                           
                array("Expexted Fire Tounch Fine","fire_tounch_gross",false,"fire_tounch_gross",false,TRUE,'fire_tounch_gross','','','range','',true), 
                array("Fire Tounch Fine","fire_tounch_fine",false,"fire_tounch_fine",false,TRUE,'fire_tounch_fine','','','range','',true),    
                array("Loss","refine_loss",false,"refine_loss",false,false,'refine_loss'),                        
                array("Fire Tounch Purity %","fire_tounch_purity",false,"fire_tounch_purity",false,false,'FORMAT(fire_tounch_purity,4) as fire_tounch_purity'), 

                // array("Fire Tounch Loss Fine","fire_tounch_loss_fine",false,"fire_tounch_loss_fine",false,false,'FORMAT(fire_tounch_loss_fine,4) as tounch_loss_fine','','','range','',true),                          
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
    'fire_tounch_in'       => array('Fire Tounch In', '', TRUE, '', TRUE),
    'out_weight'       => array('Out Weight', '', TRUE, '', TRUE),
    'out_lot_purity'       => array('Out Lot Purity', '', TRUE, '', TRUE),
    'fire_tounch_out'       => array('Fire Tounch Out', '', TRUE, '', TRUE),
    'fire_tounch_purity'       => array('Fire Tounch Purity', '', TRUE, '', TRUE),
    'fire_tounch_fine'       => array('Fire Tounch Fine', '', TRUE, '', TRUE),
    'fire_tounch_gross'       => array('Expexted Fire Tounch Fine', '', TRUE, '', TRUE),
    'page_no'       => array('', '', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'tounch_outs/fire_tounch_reports';
  if($row['fire_tounch_out']==0 || $row['fire_tounch_fine']==0){
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




