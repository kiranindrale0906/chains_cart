<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='gross_weight > 0';
  else $where='gross_weight > 0 AND status!=1';
  return  array(
    'page_title'          => 'Melting Lots List',
    'primary_table'       => 'melting_lots',
    'default_column'      => 'melting_lots.id',
    'table'               => array('melting_lots'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'melting_lots.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'melting_lots',
    'add_title'           => 'Add Melting Lot',
    'view_title'          => 'Melting Lot View',
    'export_title'        => '',
    'import_title'        => '',
    'clear_filter'        => true,
    'custom_table_header' => true
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
    array("Lot No", "lot_no", false, "lot_no", TRUE, TRUE,'melting_lots.lot_no as lot_no'),
    array("Date", "created_at", false, "created_at", TRUE, TRUE,'melting_lots.created_at as created_at'),
    array("Process", "process_name", false, "process_name", TRUE, TRUE,'melting_lots.process_name as process_name'),
    array("Description", "description", false, "description", TRUE, TRUE,'melting_lots.description as description'),
    array("Required Gold", "pure_gold_weight", false, "pure_gold_weight", TRUE, TRUE,'melting_lots.pure_gold_weight as gold_weight'),
    array("Alloy Weight", "alloy_weight", false, "alloy_weight", TRUE, TRUE,'melting_lots.alloy_weight as alloy_weight','','','','',true),
    array("Gross Weight", "gross_weight", false, "gross_weight", TRUE, TRUE,'melting_lots.gross_weight as gross_weight','','','','',true),
    array("Purity (%)", "lot_purity", false, "lot_purity", TRUE, TRUE,'melting_lots.lot_purity as lot_purity'),
    // array("Remark", "remark", false, "remark", false, TRUE,'melting_lots.remark as remark'),
   array("Status", "", false, "status", false, false,'melting_lots.status as status','','','',),
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
  $sub_process_name = (!empty($_REQUEST["process_name"])&&$_REQUEST["process_name"] == "Arc Casting") ? "Melting Process" : "Sub Process Name";

  $attributes['melting_lots'] = array(
    'id' => array('', '', FALSE, '', TRUE),
    'parent_lot_id'  => array('Parent Lots', '', TRUE, '', TRUE),
    'staff_name' => array('Staff Name', '', TRUE, '', TRUE),
    'category_one' => array('Category One', '', FALSE, '', TRUE),
    'category_two' => array('Category Two', '', FALSE, '', TRUE),
    'category_three' => array('Category Three', '', FALSE, '', TRUE),
    'category_four' => array('Category Four', '', FALSE, '', TRUE),
    'type' => array('Type', '', FALSE, '', TRUE),
    'lot_purity' => array('Purity', '', TRUE, '', TRUE),
    'lot_no' => array('Lot no', '', TRUE, '', TRUE),
    'process_name'  => array('Process', '', TRUE, '', TRUE),
    'final_process_name'  => array('Final Process', '', FALSE, '', TRUE),
    'description'  => array('Description', '', TRUE, '', TRUE),
    'alloy_weight' => array('', '', TRUE, '', TRUE),
    'wastage_weight' => array('', '', TRUE, '', TRUE),
    'additional_alloy_weight' => array('', '', TRUE, '', TRUE),
    'alloy_vodatar'  => array('', '', TRUE, '', TRUE),
    'pure_gold_weight' => array('', '', TRUE, '', TRUE),
    'gross_weight'  => array('gross_weight', '', FALSE, '', TRUE),
    'karigar_text' => array('Karigar', '', FALSE, '', TRUE),
    'karigar_dropdown' => array('Karigar', 'Select', FALSE, '', TRUE),
    'chain' => array('Chain', 'Select', FALSE, '', TRUE),
    'fancy_chain' => array('Fancy Chain', '', FALSE, '', TRUE),
    'order_id' => array('Order ID', 'Select order', FALSE, '', TRUE),
    'tone' => array('Tone', 'Select', TRUE, '', TRUE),
    'remark' => array('Remark', 'Enter Remark', TRUE, '', TRUE),
    'hook_kdm_purity' => array('Hook Kdm Purity', '', TRUE, '', TRUE),
    'department_sequence' => array('Select Sequence', 'Select', TRUE, '', TRUE),
    'rod_id' => array('Rods', 'Select Rod',FALSE, '', TRUE),
    'order_name' => array('Order', '', FALSE, '', FALSE),
    'type_of_material' => array('Type Of Material', '', TRUE, '', TRUE),
    'type_of_langadi' => array('Type Of Langadi', '', TRUE, '', TRUE),
    'lopster_no' => array('Lopster no', '', TRUE, '', TRUE),
    'wastage_weight' => array('Wastage Weight', '', FALSE, '', FALSE),
    'gross_weight' => array('Gross Weight', '', FALSE, '', FALSE),
    'quantity' => array('Quantity', '', FALSE, '', FALSE),
    'input_type' => array('Input type', '', FALSE, '', FALSE),
    'sub_process_name' => array($sub_process_name, '', FALSE, '', FALSE),
    'chain_order_id' => array('', '', FALSE, '', FALSE)
  );
  
  if(HOST=="AR Gold Internal"){
    $attributes['melting_lots']['category_four'] = array('Design Code', '', FALSE, '', FALSE);
  }
  $attributes['melting_lot_details'] = array(
    'id'            => array('', '', TRUE, '', TRUE),
    'process_id'  => array('', '', TRUE, '', TRUE),
    'process_name'  => array('', '', TRUE, '', TRUE),
    'in_purity'  => array('', '', TRUE, '', TRUE),
    'in_weight'  => array('In Weight', '', FALSE, '', TRUE),
    'required_weight'  => array('Required Weight', '', FALSE, '', TRUE),
    'required_alloy_weight'  => array('Required Alloy Weight', '', FALSE, '', TRUE),
  );

  $attributes['melting_lot_orders'] = array(
    'order_id' => array('Order ID', 'Select orders', FALSE, '', TRUE),
    'parent_order_id' => array('Parent Order ID', 'Select parent order', FALSE, '', TRUE),
  );

  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'melting_lots/melting_lots';
  if(isset($row['status']) && $row['status']==1){
    $actions["Show"] = array('request' => "ajax_post",
                               'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                               'post_data' => array("melting_lots[id]" => $row['id'],
                                                    "melting_lots[status]" => 0,
                                                    "submittype" => 'json'
                                                   ),
                               'class' => ' text-success',
                               'success_function' => 'location.reload()');
  }
  else{
    $actions["Hide"] = array('request' => "ajax_post",
                                'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                                'post_data' => array("melting_lots[id]" => $row['id'],
                                                     "melting_lots[status]" => 1,
                                                     "submittype" => 'json'
                                                    ),
                                'class' => ' text-warning',
                                'success_function' => 'location.reload()');
  }

  if($row['gross_weight']!=0.00){
    $actions["View"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                             'confirm_message' => "",
                             'class' => 'blue',
                             'data_title' =>'View',
                             'i_class'=>'fal fa-file-alt font20');
  } else {
    $actions["Add"] = array('request' => "http",
                             'url' => ADMIN_PATH.'melting_lots/sub_melting_lot_details/create/'.$row['id'],
                            'confirm_message' => "",
                             'class' => 'green',
                             'data_title' =>'View',
                             'i_class'=>'fal fa-file-alt font20');
  }
  if($row['process_name']=='Fancy Chain'){
    $actions["create"] = array('request' => "http",
                             'url' => ADMIN_PATH.'melting_lots/melting_lot_details/create/'.$row['id'].'?process_name='.$row['process_name'].'&out_lot_purity='.$row['lot_purity'],
                             'confirm_message' => "",
                             'class' => 'green',
                             'data_title' =>'Create',
                             'i_class'=>'fal fa-file-alt font20');
  }
  if($row['process_name']=='Fancy 75 Chain'){
    $actions["create"] = array('request' => "http",
                             'url' => ADMIN_PATH.'melting_lots/melting_lot_details/create/'.$row['id'].'?process_name='.$row['process_name'].'&out_lot_purity='.$row['lot_purity'],
                             'confirm_message' => "",
                             'class' => 'green',
                             'data_title' =>'Create',
                             'i_class'=>'fal fa-file-alt font20');
  }
   $actions["Delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "",
                             'class' => 'red',
                             'data_title' =>'Create',
                             'i_class'=>'fal fa-file-alt font20');
  return $actions;
}




