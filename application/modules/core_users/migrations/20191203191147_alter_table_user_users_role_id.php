<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_user_users_role_id extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `users_user_roles` ADD  `id` INT( 11 ) NOT NULL AUTO_INCREMENT FIRST ,
ADD PRIMARY KEY (`id`) ;";
    $this->db->query($sql);
  }
}
?>