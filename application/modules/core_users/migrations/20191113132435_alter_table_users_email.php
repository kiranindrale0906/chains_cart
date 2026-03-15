<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_users_email extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `users` CHANGE  `email`  `email_id` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;";
    //$this->db->query($sql);
  }


}

?>