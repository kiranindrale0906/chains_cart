<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_is_email_verify_column_in_users extends CI_Model {

  public function up()
  {
  	$sql ='ALTER TABLE  `users` ADD  `is_email_verify` TINYINT( 4 ) NOT NULL DEFAULT  "0" AFTER  `access_token` ;';
    //$this->db->query($sql);
  }


}

?>