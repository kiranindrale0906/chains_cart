<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_communication_templates extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `library_communication_templates` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `template_code` varchar(255) NOT NULL,
          `emailcomment` text NOT NULL,
          `name` varchar(255) NOT NULL,
          `fromemail` varchar(255) NOT NULL,
          `fromname` varchar(255) NOT NULL,
          `cc` text NOT NULL,
          `bcc` text NOT NULL,
          `attachment` int(11) NOT NULL,
          `emailbody` longtext NOT NULL,
          `emailsubject` varchar(255) NOT NULL,
          `emailto` varchar(255) NOT NULL,
          `emailsampledata` text,
          `sentemails` int(11) NOT NULL,
          `status` int(11) NOT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime NOT NULL,
          `pushtext` text,
          `pushurl` text,
          `pushimage` text,
          `pushto` varchar(255) NOT NULL,
          `smstext` text,
          `smsto` varchar(255) NOT NULL,
          `communication_type` tinyint(1) DEFAULT NULL COMMENT '0=transactional, 1=marketing ',
          `user_type` tinyint(1) DEFAULT NULL COMMENT '0=Admin,1=professional, 2= business/customer, 3=ServicePartner',
          `is_delete` tinyint(4) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;";
    $this->db->query($sql);
  }
}
?>