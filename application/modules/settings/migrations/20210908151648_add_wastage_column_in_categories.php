<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_wastage_column_in_categories extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `categories` ADD `wastage` DECIMAL(16,8) NOT NULL DEFAULT '0'");
  }


}

?>