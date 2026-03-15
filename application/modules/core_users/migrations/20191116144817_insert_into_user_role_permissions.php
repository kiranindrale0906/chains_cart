<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_into_user_role_permissions extends CI_Model {

  public function up()
  {
  	$sql = "INSERT INTO `user_role_permissions` (`id`, `user_role_id`, `controller_name`, `index`, `create`, `edit`, `view`, `delete`, `created_at`, `updated_at`, `is_delete`, `created_by`, `updated_by`) VALUES
(2, 1, 'users', 1, 0, 0, 0, 0, '2019-11-16 00:00:00', '2019-11-17 00:00:00', 0, NULL, NULL);";
    $this->db->query($sql);
  }
} ?>