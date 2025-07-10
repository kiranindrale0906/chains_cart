<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_closing_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `closing_out` DECIMAL(16,8) NOT NULL DEFAULT '0'");
  }


}

?>