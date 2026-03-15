<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='product_name="Hallmark Receipt"';
  else $where='product_name="Hallmark Receipt" AND archive=0';
  
  return array(
    'page_title'          => 'Hallmark Receipt List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hallmark_receipts',
    'add_title'           => 'Add Hallmark Receipt',
    'export_title'        => '',
    'edit'                => '',
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
    array("Account", "account", TRUE, "account", FALSE, TRUE, "account as account"),
    array("Type", "type", TRUE, "type", TRUE, TRUE),
    array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
    array("Description", "description", TRUE, "description", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Out WT", "out_hallmark_out", TRUE, "out_hallmark_out", TRUE, TRUE,'(select sum(p.hallmark_in) from processes p  where  p.id in (select process_id from  issue_department_details where issue_department_id in (processes.factory_issue_department_id))) as out_hallmark_out'),
    array("Balance WT", "balance_hallmark_out", TRUE, "balance_hallmark_out", TRUE, TRUE,'((in_weight)-(select sum(p.hallmark_in) from processes p  where  p.id in (select process_id from  issue_department_details where issue_department_id in (processes.factory_issue_department_id)))) as balance_hallmark_out'),
  /*array("Category Name", "name", false, "name", TRUE, TRUE,'(select name as category_name from iapp_category_master  where categories.iapp_category_master_id = iapp_category_master.id and parent_id=0) as category_name'),*/
   

    array("Parent id", "factory_issue_department_id", TRUE, "factory_issue_department_id", TRUE, TRUE),
    array("Action", "action", FALSE, "action", FALSE, FALSE)
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

  $attributes = array(
    'id'       => array('', '', TRUE, '', TRUE),
    'type'     => array('Type', '', FALSE, '', TRUE),
    'account'    => array('Account', '', FALSE, '', TRUE),
    'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'receipt_departments/hallmark_receipts';
  $actions["Delete"] = array('request' => "http",
                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                              'class' => 'red',
                              'confirm_message' => "Do you want to delete",
                              'data_title' => "Delete",
                              'i_class' => 'far fa-trash-alt font20');

  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'receipt_departments/hallmark_receipts/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn-sm green',
                           'data_title' =>'View');
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'Hide',
                           'i_class'=>'fal fa-file-alt font20');
 
  return $actions;
}
