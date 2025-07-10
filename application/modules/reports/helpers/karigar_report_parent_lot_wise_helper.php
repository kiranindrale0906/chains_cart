<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Karigar Report Parent Lot Wise',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'balance > 0 AND karigar = "Amit" OR karigar = "Ashish" OR  
                              karigar = "Bappy Nawabi" OR karigar = "Bhim" 
                              OR karigar = "Dharmendra" OR karigar = "Golu" 
                              OR karigar = "Hollow Bappy" OR karigar = "Kamal" 
                              OR karigar = "Kashinath" OR karigar = "Kumar" OR karigar = "Nandanji" OR karigar = "Shyam Sunder" OR karigar = "Soiley"
                              OR karigar = "Suman" OR karigar = "Ganesh" OR karigar = "Prakash" OR karigar = "Vinay Singh"',
    'where_ids'           => '',
    'order_by'            => 'karigar DESC',
    'group_by'            => 'karigar',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'parent_lot_wise_reports',
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
    array("Karigar Name", "karigar", TRUE, "karigar", TRUE, TRUE,'karigar'),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'SUM(balance) + (SELECT SUM(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) FROM processes p WHERE p.karigar = processes.karigar) as balance'),
   array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'reports/karigar_lists';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/index?karigar='.$row['karigar'],
                           'confirm_message' => "",
                           'class' => 'btn_green',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  // $actions["Delete"] = array('request' => "http",
  //                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
  //                           'class' => 'btn_red',
  //                           'confirm_message' => "Do you want to delete",
  //                           'data_title' => "Delete",
  //                           'i_class' => 'far fa-trash-alt font20');
  return $actions;
}

?>