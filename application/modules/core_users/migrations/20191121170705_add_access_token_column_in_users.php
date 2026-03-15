<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_access_token_column_in_users extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE `users` ADD  `access_token` VARCHAR( 255 ) NULL AFTER  `linkedin_access_token`";
//    $this->db->query($sql);
  }


}

?>
