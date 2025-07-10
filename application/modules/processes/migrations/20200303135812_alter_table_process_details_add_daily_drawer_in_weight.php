<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_process_details_add_daily_drawer_in_weight extends CI_Model {

  public function up()
  {
    /* this file is created only to fix the missing column on staging server. 
      Do not use this file on prduction. Duplicate migration already exists as follows
      20200123135326_add_daily_drawer_in_weight.php
      do not uncomment following lines
    */
    $sql = "ALTER TABLE `process_details` ADD `daily_drawer_in_weight` DECIMAL(10,4) NOT NULL DEFAULT '0';";
    // $this->db->query($sql);
  }
}