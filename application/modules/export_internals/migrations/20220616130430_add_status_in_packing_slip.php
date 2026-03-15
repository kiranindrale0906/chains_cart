<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_status_in_packing_slip extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `packing_slips` ADD `status` INT(4) NOT NULL DEFAULT '0'");
  }


}

?>