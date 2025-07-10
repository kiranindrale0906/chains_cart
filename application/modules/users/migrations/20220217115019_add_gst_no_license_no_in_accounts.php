<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_gst_no_license_no_in_accounts extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `accounts` ADD `gst_no` varchar(225) DEFAULT NULL , ADD `license_no` varchar(225) DEFAULT NULL,  ADD `license_validity_date` datetime DEFAULT NULL");
  }


}

?>