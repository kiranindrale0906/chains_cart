<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_kala_mani_in_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `kala_mani_in` DECIMAL(12,8) NOT NULL DEFAULT 0,ADD `meena_vatav` DECIMAL(12,8) NOT NULL DEFAULT 0");
  }


}

?>