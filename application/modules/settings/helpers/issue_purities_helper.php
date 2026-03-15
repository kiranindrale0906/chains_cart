<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Issue Purities',
    'primary_table'       => 'issue_purities',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'chain_name, chain_purity, category_one, category_three, category_four',
    'limit'               => "20",
    'extra_select_column' => 'issue_purities.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'issue_purities',
    'add_title'           => 'Add Issue Purity',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
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
    array("Chain name", "chain_name", TRUE, "chain_name", TRUE, TRUE, 'chain_name', 'issue_purities', FALSE,'autocomplete',array('issue_purities','chain_name')),
    array("Chain purity", "chain_purity", TRUE, "chain_purity", TRUE, TRUE, 'chain_purity', 'issue_purities', FALSE,'autocomplete',array('issue_purities','chain_purity')),
    array("Category One", "category_one", TRUE, "category_one", TRUE, TRUE, 'category_one', 'issue_purities', FALSE,'autocomplete',array('issue_purities','category_one')),
    array("Category Three", "category_three", TRUE, "category_three", TRUE, TRUE, 'category_three', 'issue_purities', FALSE,'autocomplete',array('issue_purities','category_three')),
    array("Category Four", "category_four", TRUE, "category_four", TRUE, TRUE, 'category_four', 'issue_purities', FALSE,'autocomplete',array('issue_purities','category_four')),
    array("Chain Margin", "chain_margin", TRUE, "chain_margin", TRUE, TRUE, 'chain_margin', 'issue_purities', FALSE,'autocomplete',array('issue_purities','chain_margin')),
    array("Chitti Purity", "chitti_purity", TRUE, "chitti_purity", TRUE, TRUE, 'chitti_purity', 'issue_purities', FALSE,'autocomplete',array('issue_purities','chitti_purity')),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['issue_purities'] = array(
    'id'           => array('ID', '', false, '', FALSE),
    'chain_name' => array('Chain name', 'Select Chain name', TRUE, '', FALSE),
    'chain_purity'   => array('Chain purity', 'Enter Chain purity', TRUE, '', FALSE),
    'chain_margin'   => array('Chain Margin', 'Enter Chain Margin', TRUE, '', FALSE),
    'category_one'   => array('Category One', 'Select Category', TRUE, '', FALSE),
    'category_two'   => array('Category Two', 'Select Category Two', TRUE, '', FALSE),
    'category_three'   => array('Category Three', 'Select Category Three', TRUE, '', FALSE),
    'category_four'   => array('Category Four', 'Select Category Four', TRUE, '', FALSE),
    'client_chain_name' => array('Client Chain Name', 'Enter chain name for chitti', TRUE, '', FALSE),
    'chitti_purity' => array('Chitti Purity', 'Enter Chitti Purity', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $page_no='';
  $controller = 'settings/issue_purities';
  $page_no = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if(!empty($page_no)){
      $page_no='?1=1&page_no='.$page_no;
    }
  // $actions["Edit"] = array('request' => "http", 
  //                          'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
  //                          'confirm_message' => "",
  //                          'class' => 'btn_green');
  $actions["Delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'].$page_no,
                             'confirm_message' => "Do you want to delete?",
                             'class' => 'btn_red');
  return $actions;
}