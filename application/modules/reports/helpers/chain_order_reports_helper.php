<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Chain Orders Report',
  );
}

function get_field_attribute($table, $field) {
  $attributes = array(
    'process'   => array('Process', 'Select', FALSE, '', TRUE),
    'from_date' => array('From date', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_processes_with_orders() {
  return array('Rope Chain', 'Machine Chain', 'Round Box Chain', 'Choco Chain');
}

function get_chain_order_processes_dropdown() {
  return generate_dropdown(get_processes_with_orders());
}

function get_chain_order_report_data() {
  return array(
    'Rope Chain' => array(
      'bom_fields'  => array('chain_code', 'varient'),
      'departments' => array ('AG'                  => array ('AG Melting'),
                              'AG Flatting'         => array ('Melting', 'Flatting'),
                              'AU FE Process'       => array ('AU+FE', 'Bull Block', 'Tarpatta', 'Wire Drawing'),
                              'Machine Process'     => array ('Machine Department'),
                              'Final Process'       => array ('Joining Department', 'Walnut Shampoo', 'HCL', 'Tounch Department', 'Castic Process', 'Hook', 'Polish', 'GPC')),
      'order_by' => "FIELD('process_name', 'AG', 'AG Flatting', 'AU FE Process', 'Machine Process', 'Final Process')"
    ),
    'Machine Chain' => array(
      'bom_fields'  => array('type', 'chain', 'size'),
      'departments' => array ('AG'                  => array ('Melting', 'Flatting'),
                              'AU FE Process'       => array ('AU+FE', 'Tarpatta', 'Wire Drawing'),
                              'Machine Process'     => array ('Machine Department'),
                              'Final Process'       => array ('Solder', 'Joining Department', 'Shampoo Walnut', 'HCL', 'Castic Process', 'Shampoo And Steel', 'Cutting', 'Ice Cutting', 'Hook', 'Buffing', 'GPC'),
                              'Rolex Final Process' => array('Joining Department', 'Shampoo', 'HCL', 'Tounch Department', 'Filing', 'Hook', 'Shampoo And Steel', 'Hand Cutting', 'Buffing', 'GPC')),
      'order_by' => "FIELD('process_name', 'AG', 'AU FE Process', 'Machine Process', 'Final Process', 'Rolex Final Process')",
    ),
    'Round Box Chain' => array(
      'bom_fields'  => array('chain_name', 'size'),
      'departments' => array (
        'AG'            => array ('Melting', 'Flatting'),
        'Final Process' => array ('Machine Department', 'Hammering', 'Polish', 'Copper', 'Cutting', 'Stripping', 'Hook', 'Buffing', 'GPC')),
      'order_by' => "FIELD('process_name', 'AG', 'Final Process')",
    ),
    'Choco Chain' => array(
      'bom_fields'  => array('type', 'chain'),
      'departments' => array ('Combine Process'       => array ('Combine'),
                              'AG'                    => array ('Melting', 'Flatting', 'Dye'),
                              'Machine Process'       => array ('Chain Making'),
                              'Final Process'         => array ('Filing', 'Hook', 'Pasta', 'Shampoo Walnut', 'Castic Process', 'Lobster Out', 'Shampoo And Steel', 'Hand Cutting', 'Hand Dull', 'Buffing', 'GPC Or Rodium'),
                              'Imp Final Process'     => array ('Filing', 'Hook', 'Pasta', 'Tounch Department', 'Lobster', 'Shampoo', 'Buffing', 'Hand Cutting', 'Hand Dull', 'Buffing II', 'GPC Or Rodium'),
                              'RND Process'           => array('Hand Cutting', 'Hand Dull', 'Buffing', 'GPC'),
                              'Casting Final Process' => array('Filing', 'Pasta', 'Castic Process', 'Lobster Out', 'Shampoo And Steel', 'Buffing', 'Hand Cutting', 'Hand Dull', 'Buffing II', 'GPC Or Rodium')),
      'order_by' => "FIELD('process_name', 'Combine Process', 'AG', 'Machine Process', 'Final Process', 'Imp Final Process', 'RND Process', 'Casting Final Process')",
    ),
  );
}