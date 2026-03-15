<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_no_of_worker_in_karigar_rate extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `karigar_rates` ADD `no_of_workers` INT(11) Not Null Default 0;");
  }


}

?>