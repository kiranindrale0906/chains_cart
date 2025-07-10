<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_rhodium_in_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `rhodium_in` DECIMAL(12,8) NOT NULL");
  }


}

?>