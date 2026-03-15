<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_communication_configurations extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `library_communication_configurations` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `hostname` varchar(255) NOT NULL,
          `username` varchar(255) NOT NULL,
          `password` varchar(255) NOT NULL,
          `smtpsecure` varchar(255) NOT NULL,
          `port` int(11) NOT NULL,
          `fromemail` varchar(255) NOT NULL,
          `fromname` varchar(255) NOT NULL,
          `cc` varchar(255) NOT NULL,
          `bcc` text NOT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime NOT NULL,
          `pushtoken` text,
          `smsusername` varchar(255) DEFAULT NULL,
          `smspassword` varchar(255) DEFAULT NULL,
          `smsapiurl` text,
          `twilio_sid` varchar(255) DEFAULT NULL,
          `twilio_auth_token` varchar(255) DEFAULT NULL,
          `twilio_phone_number` varchar(255) DEFAULT NULL,
          `twilio_twiml_bin_url` varchar(255) DEFAULT NULL,
          `sengrid_api_key` varchar(255) DEFAULT NULL,
          `is_delete` tinyint(4) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $this->db->query($sql);
  }


}

?>