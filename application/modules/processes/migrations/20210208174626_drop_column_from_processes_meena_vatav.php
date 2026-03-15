<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_column_from_processes_meena_vatav extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` DROP `meena_vatav`;");
    $this->db->query("ALTER TABLE `process_details` DROP `meena_vatav`;");
  }


}

?>