<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_into_user_roles extends CI_Model {

  public function up()
  {
  	$sql = "INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'admin', '2019-03-15 18:07:55', '2019-03-26 19:59:49');";
    $this->db->query($sql);
  }
}

?>