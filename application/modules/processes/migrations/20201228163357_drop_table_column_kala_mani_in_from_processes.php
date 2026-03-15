<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_table_column_kala_mani_in_from_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` DROP `kala_mani_in`;");
    $this->db->query("ALTER TABLE `processes` DROP `kala_mani_in`;");
  }


}

?>