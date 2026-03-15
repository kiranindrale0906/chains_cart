<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_loss_percentage_column_in_processes_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD `loss_percentage` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>