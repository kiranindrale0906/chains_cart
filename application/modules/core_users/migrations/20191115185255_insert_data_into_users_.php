<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_data_into_users_ extends CI_Model {

  public function up()
  {
  	$sql ="INSERT INTO `users` (`id`, `name`, `email_id`, `encrypted_password`, `mobile_no`, `reset_token`, `status`, `last_sign_in_at`, `last_sign_in_ip`, `created_at`, `updated_at`, `is_delete`, `created_by`, `updated_by`, `last_read_notification`, `google_access_token`, `linkedin_access_token`) VALUES
(2, 'Atul', 'atul@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9887452152', NULL, 'Enabled', '2019-11-14 13:20:25', '::1', '2019-08-27 10:56:30', '2019-11-15 17:20:22', 0, NULL, NULL, '2019-11-15 17:20:22', NULL, NULL),
(3, 'sandip ', 'sandip.bikkad@ascratech.in', '5f4dcc3b5aa765d61d8327deb882cf99', '9511009988', NULL, 'Enabled', '2019-11-14 13:37:15', '::1', '2019-11-08 00:00:00', '2019-11-15 17:45:36', 0, NULL, NULL, '2019-11-15 17:45:36', NULL, NULL);";
    $this->db->query($sql);
  }


}

?>