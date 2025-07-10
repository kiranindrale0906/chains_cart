<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_karigar_loss_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `karigar_loss` DECIMAL(12,8) NOT NULL DEFAULT 0;");
  }


}

?>