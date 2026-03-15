<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_into_user_role_ extends CI_Model {

  public function up()
  {
  	$sql = "INSERT INTO `users_user_roles` (`user_id`, `user_role_id`, `created_at`, `updated_at`, `is_delete`, `created_by`, `updated_by`) VALUES ('3', '1', '2019-11-16 00:00:00', '2019-11-17 00:00:00', '0', NULL, NULL);";
    $this->db->query($sql);
  }


}

?>