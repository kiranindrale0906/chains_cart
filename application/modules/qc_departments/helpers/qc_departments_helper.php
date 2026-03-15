<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
	return array(
		'page_title'          => 'Qc Departments',
		'primary_table'       => 'processes',
		'default_column'      => 'id',
		'table'               => 'processes',
		'join_columns'        => '',
		'join_type'           => '',
		'where'               => 'department_name="QC Department" and in_weight!=0',
		'where_ids'           => '',
		'order_by'            => 'id desc',
		'limit'               => "20",
		'extra_select_column' => 'id,balance',
		'actionFunction'      => '',
		'headingFunction'     => 'list_settings',
		'search_url'          => 'qc_departments',
		'add_title'           => '',
		'export_title'        => '',
		'edit'                => '',
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
		array("ID", "id", TRUE, "id", TRUE, TRUE),
		array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE),
		array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE),
		array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
		array("In Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
		array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
		array("GPC Out", "gpc_out", TRUE, "gpc_out", TRUE, TRUE),
		array("Repair Out", "repair_out", TRUE, "repair_out", TRUE, TRUE),
		array("Micro Coating", "micro_coating", TRUE, "micro_coating", TRUE, TRUE),
		array("Balance", "balance", TRUE, "balance", TRUE, TRUE),
		array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE),
		array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE),
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
    'in_weight'  => array('In Weight', 'Enter IN Wt', TRUE, '', TRUE),
    'gpc_out'  => array('GPC Out', 'Enter Gross Wt', TRUE, '', TRUE),
    'quantity'  => array('Quantity', 'Enter Quantity', FALSE, '', TRUE),
    'account'  => array('Account', 'Enter Account', FALSE, '', TRUE),
    'lot_no'  => array('Lot Name', 'Enter Lot Name', FALSE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', FALSE, '', TRUE),
    'product_name'  => array('Product Name', '', FALSE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
    'in_lot_purity'  => array('Melting', 'Enter Melting', TRUE, '', TRUE),
    'in_purity'  => array('In Purity', 'Enter Melting', TRUE, '', TRUE),
    'repair_out'  => array('Repair Out', 'Enter Repair Out', TRUE, '', TRUE),
    'repair_out_quantity'  => array('Repair Quantity', 'Enter Repair Out', TRUE, '', TRUE),
    'micro_coating'  => array('Micro Coating', 'Enter Repair Out', TRUE, '', TRUE),
    'balance'  => array('Balance', 'Enter Balance', TRUE, '', TRUE),
    'balance_gross'  => array('Balance Gross', 'Enter Balance Gross', TRUE, '', TRUE),
    'balance_fine'  => array('Balance Fine', 'Enter Balance Fine', TRUE, '', TRUE),
  );

  return $attributes[$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'qc_departments/qc_departments';
  if($row['balance']!=0){

  $actions["Edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green');
  }else{
  	$actions["View"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue');

  }
  return $actions;
}
