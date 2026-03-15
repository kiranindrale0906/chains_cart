<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Choco chain BOM settings list',
    'primary_table'       => 'choco_chain_bom_settings',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'choco_chain_bom_settings.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'choco_chain_bom_settings',
    'add_title'           => 'Add choco chain BOM settings',
    'export_title'        => 'Export',
    'edit'                => '',
    'select_column'       => true,
    'import_title'        => 'Import BOM Settings',
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
    array("Action", "action", FALSE, "action", FALSE, FALSE),
    array('Type', 'type', TRUE, 'type', TRUE, TRUE, 'type', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','type')),
    array('Chain', 'chain', TRUE, 'chain', TRUE, TRUE, 'chain', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','chain')),
    array('Die 1 code', 'die_1_code', TRUE, 'die_1_code', TRUE, TRUE, 'die_1_code', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_code')),
    array('Die 2 code', 'die_2_code', TRUE, 'die_2_code', TRUE, TRUE, 'die_2_code', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_code')),
    array('Melting', 'melting', TRUE, 'melting', TRUE, TRUE, 'melting', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','melting')),
    array('Weight in 18 inch', 'wt_in_18_inch', TRUE, 'wt_in_18_inch', TRUE, TRUE, 'wt_in_18_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','wt_in_18_inch')),
    array('No of die pieces in 18 inch', 'no_of_die_pcs_in_18_inch', TRUE, 'no_of_die_pcs_in_18_inch', TRUE, TRUE, 'no_of_die_pcs_in_18_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','no_of_die_pcs_in_18_inch')),
    array('Die pieces weight in 18 inch', 'die_pcs_wt_in_18_inch', TRUE, 'die_pcs_wt_in_18_inch', TRUE, TRUE, 'die_pcs_wt_in_18_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_pcs_wt_in_18_inch')),
    array('Die 1 pieces per 18 inch', 'die_1_pcs_per_18_inch', TRUE, 'die_1_pcs_per_18_inch', TRUE, TRUE, 'die_1_pcs_per_18_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_pcs_per_18_inch')),
    array('Die 1 weight per pieces', 'die_1_wt_per_pcs', TRUE, 'die_1_wt_per_pcs', TRUE, TRUE, 'die_1_wt_per_pcs', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_wt_per_pcs')),
    array('Die 1 weight', 'die_1_wt', TRUE, 'die_1_wt', TRUE, TRUE, 'die_1_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_wt')),
    array('Die 2 pieces per 18 inch', 'die_2_pcs_per_18_inch', TRUE, 'die_2_pcs_per_18_inch', TRUE, TRUE, 'die_2_pcs_per_18_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_pcs_per_18_inch')),
    array('Die 2 weight per pieces', 'die_2_wt_per_pcs', TRUE, 'die_2_wt_per_pcs', TRUE, TRUE, 'die_2_wt_per_pcs', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_wt_per_pcs')),
    array('Die 2 weight', 'die_2_wt', TRUE, 'die_2_wt', TRUE, TRUE, 'die_2_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_wt')),
    array('Die 1 strip per piece width', 'die_1_strip_per_pc_width', TRUE, 'die_1_strip_per_pc_width', TRUE, TRUE, 'die_1_strip_per_pc_width', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_strip_per_pc_width')),
    array('Die 1 strip per piece thickness', 'die_1_strip_per_pc_thickness', TRUE, 'die_1_strip_per_pc_thickness', TRUE, TRUE, 'die_1_strip_per_pc_thickness', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_strip_per_pc_thickness')),
    array('Die 1 strip precentage', 'die_1_strip_precentage', TRUE, 'die_1_strip_precentage', TRUE, TRUE, 'die_1_strip_precentage', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_strip_precentage')),
    array('Die 1 strip per piece weight', 'die_1_strip_per_pc_wt', TRUE, 'die_1_strip_per_pc_wt', TRUE, TRUE, 'die_1_strip_per_pc_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_strip_per_pc_wt')),
    array('Die 2 strip per piece width', 'die_2_strip_per_pc_width', TRUE, 'die_2_strip_per_pc_width', TRUE, TRUE, 'die_2_strip_per_pc_width', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_strip_per_pc_width')),
    array('Die 2 strip per piece thickness', 'die_2_strip_per_pc_thickness', TRUE, 'die_2_strip_per_pc_thickness', TRUE, TRUE, 'die_2_strip_per_pc_thickness', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_strip_per_pc_thickness')),
    array('Die 2 strip precentage', 'die_2_strip_precentage', TRUE, 'die_2_strip_precentage', TRUE, TRUE, 'die_2_strip_precentage', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_strip_precentage')),
    array('Die 2 strip per piece weight', 'die_2_strip_per_pc_wt', TRUE, 'die_2_strip_per_pc_wt', TRUE, TRUE, 'die_2_strip_per_pc_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_strip_per_pc_wt')),
    array('Die 1 strip to langari percentage', 'die_1_strip_to_langari_percentage', TRUE, 'die_1_strip_to_langari_percentage', TRUE, TRUE, 'die_1_strip_to_langari_percentage', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_strip_to_langari_percentage')),
    array('Die 1 langari name', 'die_1_langari_name', TRUE, 'die_1_langari_name', TRUE, TRUE, 'die_1_langari_name', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_langari_name')),
    array('Die 1 langari per piece size', 'die_1_langari_per_pc_size', TRUE, 'die_1_langari_per_pc_size', TRUE, TRUE, 'die_1_langari_per_pc_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_langari_per_pc_size')),
    array('Die 1 langari per piece weight', 'die_1_langari_per_pc_wt', TRUE, 'die_1_langari_per_pc_wt', TRUE, TRUE, 'die_1_langari_per_pc_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_1_langari_per_pc_wt')),
    array('Die 2 strip to langari percentage', 'die_2_strip_to_langari_percentage', TRUE, 'die_2_strip_to_langari_percentage', TRUE, TRUE, 'die_2_strip_to_langari_percentage', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_strip_to_langari_percentage')),
    array('Die 2 langari name', 'die_2_langari_name', TRUE, 'die_2_langari_name', TRUE, TRUE, 'die_2_langari_name', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_langari_name')),
    array('Die 2 langari per piece size', 'die_2_langari_per_pc_size', TRUE, 'die_2_langari_per_pc_size', TRUE, TRUE, 'die_2_langari_per_pc_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_langari_per_pc_size')),
    array('Die 2 langari per piece weight', 'die_2_langari_per_pc_wt', TRUE, 'die_2_langari_per_pc_wt', TRUE, TRUE, 'die_2_langari_per_pc_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','die_2_langari_per_pc_wt')),
    array('Hook per chain size', 'hook_per_chain_size', TRUE, 'hook_per_chain_size', TRUE, TRUE, 'hook_per_chain_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','hook_per_chain_size')),
    array('Hook per chain quantity', 'hook_per_chain_qty', TRUE, 'hook_per_chain_qty', TRUE, TRUE, 'hook_per_chain_qty', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','hook_per_chain_qty')),
    array('Hook per chain weight', 'hook_per_chain_wt', TRUE, 'hook_per_chain_wt', TRUE, TRUE, 'hook_per_chain_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','hook_per_chain_wt')),
    array('Lock per chain size', 'lock_per_chain_size', TRUE, 'lock_per_chain_size', TRUE, TRUE, 'lock_per_chain_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','lock_per_chain_size')),
    array('Lock per chain quantity', 'lock_per_chain_qty', TRUE, 'lock_per_chain_qty', TRUE, TRUE, 'lock_per_chain_qty', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','lock_per_chain_qty')),
    array('Lock per chain weight', 'lock_per_chain_wt', TRUE, 'lock_per_chain_wt', TRUE, TRUE, 'lock_per_chain_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','lock_per_chain_wt')),
    array('Kdm per inch', 'kdm_per_inch', TRUE, 'kdm_per_inch', TRUE, TRUE, 'kdm_per_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','kdm_per_inch')),
    array('Solid wire per inch size', 'solid_wire_per_inch_size', TRUE, 'solid_wire_per_inch_size', TRUE, TRUE, 'solid_wire_per_inch_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','solid_wire_per_inch_size')),
    array('Solid wire per inch weight', 'solid_wire_per_inch_wt', TRUE, 'solid_wire_per_inch_wt', TRUE, TRUE, 'solid_wire_per_inch_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','solid_wire_per_inch_wt')),
    array('Pipe type size', 'pipe_type_size', TRUE, 'pipe_type_size', TRUE, TRUE, 'pipe_type_size', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','pipe_type_size')),
    array('Pipe finish', 'pipe_finish', TRUE, 'pipe_finish', TRUE, TRUE, 'pipe_finish', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','pipe_finish')),
    array('Pipe pieces', 'pipe_pcs', TRUE, 'pipe_pcs', TRUE, TRUE, 'pipe_pcs', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','pipe_pcs')),
    array('Pipe weight per piece', 'pipe_wt_per_pc', TRUE, 'pipe_wt_per_pc', TRUE, TRUE, 'pipe_wt_per_pc', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','pipe_wt_per_pc')),
    array('Pipe total weight', 'pipe_total_wt', TRUE, 'pipe_total_wt', TRUE, TRUE, 'pipe_total_wt', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','pipe_total_wt')),
    array('Weight per inch', 'wt_per_inch', TRUE, 'wt_per_inch', TRUE, TRUE, 'wt_per_inch', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','wt_per_inch')),
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
  $attributes['choco_chain_bom_settings'] = array(
    'id'                                => array('ID', '', TRUE, '', TRUE),
    'type'                              => array('Type', 'Enter type', TRUE, '', TRUE),
    'chain'                             => array('Chain', 'Enter chain', TRUE, '', TRUE),
    'die_1_code'                        => array('Die 1 code', 'Enter die 1 code', TRUE, '', TRUE),
    'die_2_code'                        => array('Die 2 code', 'Enter die 2 code', TRUE, '', TRUE),
    'melting'                           => array('Melting', 'Enter melting', TRUE, '', TRUE),
    'wt_in_18_inch'                     => array('Weight in 18 inch', 'Enter weight in 18 inch', TRUE, '', TRUE),
    'no_of_die_pcs_in_18_inch'          => array('No of die pieces in 18 inch', 'Enter no of die pieces in 18 inch', TRUE, '', TRUE),
    'die_pcs_wt_in_18_inch'             => array('Die pieces weight in 18 inch', 'Enter die pieces weight in 18 inch', TRUE, '', TRUE),
    'die_1_pcs_per_18_inch'             => array('Die 1 pieces per 18 inch', 'Enter die 1 pieces per 18 inch', TRUE, '', TRUE),
    'die_1_wt_per_pcs'                  => array('Die 1 weight per pieces', 'Enter die 1 weight per pieces', TRUE, '', TRUE),
    'die_1_wt'                          => array('Die 1 weight', 'Enter die 1 weight', TRUE, '', TRUE),
    'die_2_pcs_per_18_inch'             => array('Die 2 pieces per 18 inch', 'Enter die 2 pieces per 18 inch', TRUE, '', TRUE),
    'die_2_wt_per_pcs'                  => array('Die 2 weight per pieces', 'Enter die 2 weight per pieces', TRUE, '', TRUE),
    'die_2_wt'                          => array('Die 2 weight', 'Enter die 2 weight', TRUE, '', TRUE),
    'die_1_strip_per_pc_width'          => array('Die 1 strip per piece width', 'Enter die 1 strip per piece width', TRUE, '', TRUE),
    'die_1_strip_per_pc_thickness'      => array('Die 1 strip per piece thickness', 'Enter die 1 strip per piece thickness', TRUE, '', TRUE),
    'die_1_strip_precentage'            => array('Die 1 strip precentage', 'Enter die 1 strip precentage', TRUE, '', TRUE),
    'die_1_strip_per_pc_wt'             => array('Die 1 strip per piece weight', 'Enter die 1 strip per piece weight', TRUE, '', TRUE),
    'die_2_strip_per_pc_width'          => array('Die 2 strip per piece width', 'Enter die 2 strip per piece width', TRUE, '', TRUE),
    'die_2_strip_per_pc_thickness'      => array('Die 2 strip per piece thickness', 'Enter die 2 strip per piece thickness', TRUE, '', TRUE),
    'die_2_strip_precentage'            => array('Die 2 strip precentage', 'Enter die 2 strip precentage', TRUE, '', TRUE),
    'die_2_strip_per_pc_wt'             => array('Die 2 strip per piece weight', 'Enter die 2 strip per piece weight', TRUE, '', TRUE),
    'die_1_strip_to_langari_percentage' => array('Die 1 strip to langari percentage', 'Enter die 1 strip to langari percentage', TRUE, '', TRUE),
    'die_1_langari_name'                => array('Die 1 langari name', 'Enter die 1 langari name', TRUE, '', TRUE),
    'die_1_langari_per_pc_size'         => array('Die 1 langari per piece size', 'Enter die 1 langari per piece size', TRUE, '', TRUE),
    'die_1_langari_per_pc_wt'           => array('Die 1 langari per piece weight', 'Enter die 1 langari per piece weight', TRUE, '', TRUE),
    'die_2_strip_to_langari_percentage' => array('Die 2 strip to langari percentage', 'Enter die 2 strip to langari percentage', TRUE, '', TRUE),
    'die_2_langari_name'                => array('Die 2 langari name', 'Enter die 2 langari name', TRUE, '', TRUE),
    'die_2_langari_per_pc_size'         => array('Die 2 langari per piece size', 'Enter die 2 langari per piece size', TRUE, '', TRUE),
    'die_2_langari_per_pc_wt'           => array('Die 2 langari per piece weight', 'Enter die 2 langari per piece weight', TRUE, '', TRUE),
    'hook_per_chain_size'               => array('Hook per chain size', 'Enter hook per chain size', TRUE, '', TRUE),
    'hook_per_chain_qty'                => array('Hook per chain quantity', 'Enter hook per chain quantity', TRUE, '', TRUE),
    'hook_per_chain_wt'                 => array('Hook per chain weight', 'Enter hook per chain weight', TRUE, '', TRUE),
    'lock_per_chain_size'               => array('Lock per chain size', 'Enter lock per chain size', TRUE, '', TRUE),
    'lock_per_chain_qty'                => array('Lock per chain quantity', 'Enter lock per chain quantity', TRUE, '', TRUE),
    'lock_per_chain_wt'                 => array('Lock per chain weight', 'Enter lock per chain weight', TRUE, '', TRUE),
    'kdm_per_inch'                      => array('Kdm per inch', 'Enter kdm per inch', TRUE, '', TRUE),
    'solid_wire_per_inch_size'          => array('Solid wire per inch size', 'Enter solid wire per inch size', TRUE, '', TRUE),
    'solid_wire_per_inch_wt'            => array('Solid wire per inch weight', 'Enter solid wire per inch weight', TRUE, '', TRUE),
    'pipe_type_size'                    => array('Pipe type size', 'Enter pipe type size', TRUE, '', TRUE),
    'pipe_finish'                       => array('Pipe finish', 'Enter pipe finish', TRUE, '', TRUE),
    'pipe_pcs'                          => array('Pipe pieces', 'Enter pipe pieces', TRUE, '', TRUE),
    'pipe_wt_per_pc'                    => array('Pipe weight per piece', 'Enter pipe weight per piece', TRUE, '', TRUE),
    'pipe_total_wt'                     => array('Pipe total weight', 'Enter pipe total weight', TRUE, '', TRUE),
    'wt_per_inch'                       => array('Weight per inch', 'Enter weight per inch', TRUE, '', TRUE),
    'import_files'                      => array('', '', FALSE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'choco_chains/choco_chain_bom_settings';
  $actions["Edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green');
  return $actions;
}

function import_headers() {
  return array('TYPE',
               'CHAIN',
               'DIE 1 CODE',
               'DIE 2 CODE',
               'MELTING',
               'WT IN 18 INCH',
               'NO OF DIE PCS IN 18 INCH',
               'DIE PCS WT IN 18 INCH',
               'DIE 1 PCS PER 18 INCH',
               'DIE 1 WT PER PCS',
               'DIE 1 WT',
               'DIE 2 PCS PER 18 INCH',
               'DIE 2 WT PER PCS',
               'DIE 2 WT',
               'DIE 1 STRIP PER PC WIDTH',
               'DIE 1 STRIP PER PC THICKNESS',
               'DIE 1 STRIP PRECENTAGE',
               'DIE 1 STRIP PER PC WT',
               'DIE 2 STRIP PER PC WIDTH',
               'DIE 2 STRIP PER PC THICKNESS',
               'DIE 2 STRIP PRECENTAGE',
               'DIE 2 STRIP PER PC WT',
               'DIE 1 STRIP TO LANGARI PERCENTAGE',
               'DIE 1 LANGARI NAME',
               'DIE 1 LANGARI PER PC SIZE',
               'DIE 1 LANGARI PER PC WT',
               'DIE 2 STRIP TO LANGARI PERCENTAGE',
               'DIE 2 LANGARI NAME',
               'DIE 2 LANGARI PER PC SIZE',
               'DIE 2 LANGARI PER PC WT',
               'HOOK PER CHAIN SIZE',
               'HOOK PER CHAIN QTY',
               'HOOK PER CHAIN WT',
               'LOCK PER CHAIN SIZE',
               'LOCK PER CHAIN QTY',
               'LOCK PER CHAIN WT',
               'KDM PER INCH',
               'SOLID WIRE PER INCH SIZE',
               'SOLID WIRE PER INCH WT',
               'PIPE TYPE SIZE',
               'PIPE FINISH',
               'PIPE PCS',
               'PIPE WT PER PC',
               'PIPE TOTAL WT',
               'WT PER INCH');
}