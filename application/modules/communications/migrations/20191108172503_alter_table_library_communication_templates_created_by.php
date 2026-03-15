<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_communication_templates_created_by extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `library_communication_templates` ADD  `created_by` INT( 11 ) NULL AFTER  `is_delete` , ADD  `updated_by` INT( 11 ) NULL AFTER  `created_by` ;";
    $this->db->query($sql);
  }


}

?>