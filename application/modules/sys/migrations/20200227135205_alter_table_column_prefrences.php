<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_column_prefrences extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `column_prefrences` ADD `created_by` INT NOT NULL , ADD `updated_by` INT NOT NULL;");
  }


}

?>