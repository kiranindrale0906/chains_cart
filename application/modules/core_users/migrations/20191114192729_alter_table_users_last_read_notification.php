<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_users_last_read_notification extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE  `users` ADD  `last_read_notification` DATETIME NOT NULL DEFAULT  '0000:00:00' AFTER  `updated_by` ;";
    //$this->db->query($sql);
  }
} ?>
