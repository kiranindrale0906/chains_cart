<?php
function getTableSettings() {
  return array(
    /*'page_title'          => 'Length',
    'primary_table'       => 'lengths',
    'default_column'      => 'id',
    'table'               => 'lengths',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'lengths',
    'add_title'           => 'Add Length',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter' => true,*/
  );
}

function list_settings() {
  return array(
    /*array("Design Code", "design_code", TRUE, "design_code", FALSE, FALSE, 'design_code', 'Settings', FALSE,FALSE),
    array("Range", "range", TRUE, "range", FALSE, FALSE, 'range', 'settings', FALSE,FALSE),
    array("Weight", "weight", TRUE, "weight", FALSE, FALSE, 'weight', 'settings', FALSE,FALSE),
    array("Length", "length", TRUE, "length", FALSE, FALSE, "length", 'settings', FALSE,FALSE),
    array("Weight/Length", "weight_per_length", FALSE, "weight_per_length", FALSE, FALSE,'Round((weight/length),2) as weight_per_length'),
    array("17.75", "weight_1", FALSE, "weight_1", FALSE, FALSE,'Round((weight/length*17.75),2) as weight_1'),
    array("18", "weight_2", FALSE, "weight_2", FALSE, FALSE,'Round((weight/length*18),2) as weight_2'),
    array("18.25", "weight_3", FALSE, "weight_3", FALSE, FALSE,'Round((weight/length*18.25),2) as weight_3'),
    array("18.50", "weight_4", FALSE, "weight_4", FALSE, FALSE,'Round((weight/length*18.50),2) as weight_4'),
    array("18.75", "weight_5", FALSE, "weight_5", FALSE, FALSE,'Round((weight/length*18.75),2) as weight_5'),
    array("19", "weight_6", FALSE, "weight_6", FALSE, FALSE,'Round((weight/length*19),2) as weight_6'),
    array("19.25", "weight_7", FALSE, "weight_7", FALSE, FALSE,'Round((weight/length*19.25),2) as weight_7'),
    array("19.50", "weight_8", FALSE, "weight_8", FALSE, FALSE,'Round((weight/length*19.50),2) as weight_8'),
    array("19.75", "weight_9", FALSE, "weight_9", FALSE, FALSE,'Round((weight/length*19.75),2) as weight_9'),
    array("20", "weight_10", FALSE, "weight_10", FALSE, FALSE,'Round((weight/length*20),2) as weight_10'),
    array("20.25", "weight_11", FALSE, "weight_11", FALSE, FALSE,'Round((weight/length*20.25),2) as weight_11'),
    array("20.50", "weight_12", FALSE, "weight_12", FALSE, FALSE,'Round((weight/length*20.50),2) as weight_12'),
    array("20.75", "weight_13", FALSE, "weight_13", FALSE, FALSE,'Round((weight/length*20.75),2) as weight_13'),
    array("21", "weight_14", FALSE, "weight_14", FALSE, FALSE,'Round((weight/length*21),2) as weight_14'),
    array("21.25", "weight_15", FALSE, "weight_15", FALSE, FALSE,'Round((weight/length*21.25),2) as weight_15'),
    array("21.50", "weight_16", FALSE, "weight_16", FALSE, FALSE,'Round((weight/length*21.50),2) as weight_16'),
    array("21.75", "weight_17", FALSE, "weight_17", FALSE, FALSE,'Round((weight/length*21.75),2) as weight_17'),
    array("22", "weight_18", FALSE, "weight_18", FALSE, FALSE,'Round((weight/length*22),2) as weight_18'),
    array("22.25", "weight_19", FALSE, "weight_19", FALSE, FALSE,'Round((weight/length*22.25),2) as weight_19'),
    array("22.50", "weight_20", FALSE, "weight_20", FALSE, FALSE,'Round((weight/length*22.50),2) as weight_20'),
    array("22.75", "weight_21", FALSE, "weight_21", FALSE, FALSE,'Round((weight/length*22.75),2) as weight_21'),
    array("23", "weight_22", FALSE, "weight_22", FALSE, FALSE,'Round((weight/length*23),2) as weight_22'),
    array("23.25", "weight_23", FALSE, "weight_23", FALSE, FALSE,'Round((weight/length*23.25),2) as weight_23'),
    array("23.50", "weight_24", FALSE, "weight_24", FALSE, FALSE,'Round((weight/length*23.50),2) as weight_24'),
    array("23.75", "weight_25", FALSE, "weight_25", FALSE, FALSE,'Round((weight/length*23.75),2) as weight_25'),
    array("24", "weight_26", FALSE, "weight_26", FALSE, FALSE,'Round((weight/length*24),2) as weight_26'),
    
    array("Action", "action", FALSE, "action", FALSE, FALSE),*/
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'lengths/lengths/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green');
  $actions["Delete"] = array('request' => "http", 
                              'url' => ADMIN_PATH.'lengths/lengths/delete/'.$row['id'],
                              'confirm_message' => "",
                              'class' => 'btn_red');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['lengths'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'design_code'  => array('Design Code', 'Enter Design Code', TRUE, '', TRUE),
    'range'  => array('Range', 'range', TRUE, '', TRUE),
    'weight'  => array('Weight', 'weight', TRUE, '', TRUE),
    'length'  => array('Length', 'length', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}