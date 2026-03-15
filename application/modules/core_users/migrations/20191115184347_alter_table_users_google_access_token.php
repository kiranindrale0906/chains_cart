<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_users_google_access_token extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE `users` ADD  `google_access_token` VARCHAR( 255 ) NULL AFTER  `last_read_notification`, ADD  `linkedin_access_token` VARCHAR( 255 ) NULL AFTER  `google_access_token` ;";
    //$this->db->query($sql);
  }


}

?>
