<?php defined('BASEPATH') OR exit('No direct script access allowed.');

  function getTableSettings() {
     $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
    if($show=='yes') $where='product_name="Pending Loss from Hook" and process_name="Pending Loss from Hook" and department_name="Start"';
    else $where='product_name="Pending Loss from Hook" and process_name="Pending Loss from Hook" and department_name="Start" and archive=0';
    return array(
      'page_title'          => 'Pending Hook List',
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
      'search_url'          => 'pending_loss_from_hooks',
      'add_title'           => 'Add Pending Hook',
      'export_title'        => '',
      'edit'                => '',
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
      array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
      array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
      array("Computed Hook In", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','', 'range','in_weight',true),
      array("Actual Hook In", "out_weight", TRUE, "out_weight", TRUE, TRUE, 'out_weight','','','range','out_weight',true),
      array("Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE, 'in_lot_purity','','','range','in_lot_purity',true),
      array("Total Loss", "factory_out", TRUE, "factory_out", TRUE, TRUE,'factory_out','','', 'range','factory_out',true),
      //array("Gross WT", "balance_melting_wastage", TRUE, "balance_melting_wastage", TRUE, TRUE),
      array("Action", "action", FALSE, "action", FALSE, FALSE),
    );
  }

  function get_row_actions($row, $url, $select_url, $filter) {
    $actions = array();
    $controller = 'processes/processes';
    $actions["View"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                             'confirm_message' => "",
                             'class' => '',
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

  function get_field_attribute($table, $field) {
    $attributes = array();
    $attributes["pending_loss_from_hooks"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "karigar"  => array("Karigar", "Select", FALSE, "", TRUE),
      "in_lot_purity"  => array("Purity", "Select", FALSE, "", TRUE),
      "in_weight"  => array("Computed Daily Drawer Weight", "", FALSE, "", TRUE),
      "process_hook_in"  => array("Hook In", "", FALSE, "", TRUE),
      "process_in_weight"  => array("Total In Weight", "", FALSE, "", TRUE),
      "out_weight"  => array("Actual Daily Drawer Weight", "", FALSE, "", TRUE),
      "loss"  => array("Total Loss", "", FALSE, "", TRUE),
      //"process_in_weight"  => array("Weight", "", FALSE, "", TRUE),
      //"hook_in"  => array("Hook In", "", FALSE, "", TRUE),
    );
    $attributes["process_out_wastage_details"] = array(
      "id" => array("", "", FALSE, "", FALSE),
      "process_id"  => array("", "", FALSE, "", TRUE),
    );
    return $attributes[$table][$field];
  }

?>