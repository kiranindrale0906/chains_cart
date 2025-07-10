<?php 
function import_headers() {
  return array(
      "script_id",
      "script_bucket_id"
  );
}
function get_field_attribute($table, $field) {
   $attributes['same_karigar_imports'] = array(
    'import_files' => array('Karigars File', '', FALSE, '', FALSE),
    'import' => array('', '', FALSE, '', FALSE),
  );
  
}

?>