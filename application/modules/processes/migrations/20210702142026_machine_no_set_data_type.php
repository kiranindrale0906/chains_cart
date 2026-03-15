<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_machine_no_set_data_type extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` CHANGE `machine_no` `machine_no` VARCHAR(50)  NULL DEFAULT NULL;");
  }


}

?>