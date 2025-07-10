<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
	return array(
		'page_title'          => 'Alloy Issue List',
		'primary_table'       => 'processes',
		'default_column'      => 'id',
		'table'               => 'processes',
		'join_columns'        => '',
		'join_type'           => '',
		'where'               => 'product_name="Alloy Issue"',
		'where_ids'           => '',
		'order_by'            => 'id desc',
		'limit'               => "20",
		'extra_select_column' => 'id',
		'actionFunction'      => '',
		'headingFunction'     => 'list_settings',
		'search_url'          => 'alloy_issues',
		'add_title'           => 'Add Alloy Issue',
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
		array("Type", "type", TRUE, "type", TRUE, TRUE),
		array("Date", "created_at", TRUE, "created_at", FALSE, TRUE),
		array("Melting", "in_lot_purity", TRUE, "in_lot_purity", FALSE, TRUE),
		array("Alloy issue", "out_alloy_weight", TRUE, "out_alloy_weight", TRUE, TRUE,'out_alloy_weight','','',
					'range','out_alloy_weight',true),
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
		'in_weight'  => array('Gross Wt', 'Enter Gross Wt', TRUE, '', TRUE),
		'in_lot_purity'  => array('Melting', 'Select Melting', TRUE, '', TRUE),
		'process_name'  => array('Process Name', '', FALSE, '', TRUE),
	);

	return $attributes[$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'receipt_departments/receipt_departments';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  return $actions;
}
