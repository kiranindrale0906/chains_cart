<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_email_logs extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `library_email_logs` ADD  `bounced_at` DATETIME NULL DEFAULT NULL AFTER  `clicked_at`,  ADD  `unsubscribe_at` DATETIME NULL DEFAULT NULL AFTER  `bounced_at` ;";
    $this->db->query($sql);
  }
}

?>