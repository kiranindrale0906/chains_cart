<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_purity_in_kt_in_setting extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `chain_purities` ADD `purity_in_kt` VARCHAR(255) NULL DEFAULT NULL");
  }


}

?>