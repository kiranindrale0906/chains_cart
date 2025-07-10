<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_mobile_verify_otp_column_in_users extends CI_Model {

  public function up()
  {
  	$sql ="ALTER TABLE  `users` ADD  `mobile_verify_otp` INT( 11 ) NULL DEFAULT NULL AFTER  `is_email_verify` ;";
    //$this->db->query($sql);
  }


}

?>