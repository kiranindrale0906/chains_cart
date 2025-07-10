<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_alloy_settings_wastage_percentage extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `alloy_settings` ADD `wastage_percentage` VARCHAR(255) NOT NULL");
  }


}

?>