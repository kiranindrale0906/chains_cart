<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_into_users extends CI_Model {

  public function up()
  {
  	$sql = "INSERT INTO `users` ( `name`, `email_id`, `encrypted_password`, `mobile_no`, `access_token`, `status`, `last_sign_in_at`,
  	 														 `last_sign_in_ip`, `created_at`, `updated_at` ) VALUES ( 'Atul', 'atul@gmail.com', '$2y$10$/C/HGHx85eup8DeTPsONLujBpLc2H0p0ejA0A/UwGDA2NWyLAzJNy', '9887452152', '', 'Enabled', '', '', '2019-08-27 10:56:30', '2019-08-27 16:29:57');";
    $this->db->query($sql);
  }


}

?>