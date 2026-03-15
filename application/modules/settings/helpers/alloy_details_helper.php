<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Alloy Settings',
    'primary_table'       => 'alloy_settings',
    'default_column'      => 'id',
    'table'               => array('alloy_settings','alloy_types'),
    'join_conditions'     => array('`alloy_settings`.`alloy_id` = `alloy_types`.`id`'),
    'join_type'           => 'INNER',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'product_name,alloy_purity,tone DESC',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'alloy_settings.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'alloy_settings',
    'add_title'           => 'Add Alloy Setting',
    'export_title'        => '',
    'import_title'        => '',
    'edit'                => '',
    'custom_table_header' => true,
    'select_column'       => false,
  );
}


function list_settings() {
  $alloy_details=array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE, 'alloy_settings.product_name', 'product_name', FALSE,'autocomplete',''),

    array("Purity", "alloy_purity", TRUE, "alloy_purity", TRUE, TRUE, 'alloy_settings.alloy_purity', 'alloy_purity', FALSE,'autocomplete',''),
    array("Tone", "tone", TRUE, "tone", TRUE, TRUE, 'alloy_settings.tone', 'tone', FALSE,'autocomplete',''),
    
    array("Alloy Name", "alloy_name", TRUE, "alloy_name", TRUE, TRUE, 'alloy_name', 'alloy_name', FALSE,'autocomplete',''),

    array("Weight Percentage", "weight", TRUE, "weight", TRUE, TRUE, 'alloy_settings.weight', 'alloy_name', FALSE,'autocomplete',''), 


    array("Chain", "chain", TRUE, "chain", TRUE, TRUE, 'alloy_settings.chain', 'chain', FALSE,'autocomplete',''),

    array("Wastage Percentage", "wastage_percentage", TRUE, "wastage_percentage", TRUE, TRUE, 'alloy_settings.wastage_percentage', 'wastage_percentage', FALSE,'autocomplete',''),
    array("Category One", "category_one", TRUE, "category_one", TRUE, TRUE, 'alloy_settings.category_one', 'category_one', FALSE,'autocomplete','')
  );
  if(HOST=='ARF'){
  $alloy_details[]=array("Machine Size", "machine_size", TRUE, "machine_size", TRUE, TRUE, 'alloy_settings.machine_size', 'machine_size', FALSE,'autocomplete','');
  $alloy_details[]=array("Design Name", "design_name", TRUE, "design_name", TRUE, TRUE, 'alloy_settings.design_name', 'design_name', FALSE,'autocomplete','');
  }
  $alloy_details[]=array("Action", "action", FALSE, "action", FALSE, FALSE);
  return $alloy_details;
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['alloy_details'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Select Product name', TRUE, '', FALSE),
    'weight'          => array('Weight Percentage', 'Select Weight', TRUE, '', FALSE),
    'alloy_purity'    => array('Alloy Purity', 'Select Purity', FALSE, '', FALSE),
    'alloy_id'      => array('Alloy', 'Select Alloy', TRUE, '', FALSE),
    'tone'             => array('Tone', '', FALSE, '', FALSE),
    'category_one'             => array('Category One', '', FALSE, '', FALSE),
    'chain'             => array('Chain', '', FALSE, '', FALSE),
    'wastage_percentage' => array('Wastage Percentage', 'Select Wastage Percentage', FALSE, '', FALSE),
    'machine_size' => array('Machine Size', 'Select Machine Size', FALSE, '', FALSE),
    'design_name' => array('Design Name', 'Select Design Name', FALSE, '', FALSE),
    'import_files'=>array('', '', FALSE, '', FALSE)
  );
  return $attributes[$table][$field];
}

function import_headers(){
  return array("Product Name", 
                "Alloy Name",
                "Alloy Purity",
                "Weight",
                "Chain",
                "Tone",
                "Category One",
                "Machine Size",
                "Design Name");
} 
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/alloy_details';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}