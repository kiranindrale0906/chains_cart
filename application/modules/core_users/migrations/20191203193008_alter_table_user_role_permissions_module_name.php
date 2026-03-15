<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_user_role_permissions_module_name extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `user_role_permissions` ADD  `module_name` VARCHAR( 255 ) NOT NULL AFTER  `updated_by` ;";
//    $this->db->query($sql);
  }
}
?>
