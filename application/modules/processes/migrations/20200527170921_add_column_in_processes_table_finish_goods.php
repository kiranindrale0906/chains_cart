<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_processes_table_finish_goods extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `finish_good` TINYINT(2) NOT NULL DEFAULT '0';
");
  }


}

?>