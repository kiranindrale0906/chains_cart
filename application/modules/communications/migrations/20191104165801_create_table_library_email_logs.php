<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_email_logs extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `library_email_logs` (
    		  `id` int(11) NOT NULL AUTO_INCREMENT,
    		  `hostname` varchar(255) NOT NULL,
    		  `toemail` varchar(255) NOT NULL,
    		  `username` varchar(255) NOT NULL,
    		  `fromemail` varchar(255) NOT NULL,
    		  `fromname` varchar(255) NOT NULL,
    		  `subject` varchar(255) NOT NULL,
    		  `emailbody` longtext NOT NULL,
    		  `additiona_email_ids` text NOT NULL,
    		  `template_id` int(11) NOT NULL,
    		  `template_name` varchar(255) NOT NULL,
    		  `status` varchar(255) NOT NULL,
    		  `created_at` datetime NOT NULL,
    		  `delivered_at` datetime DEFAULT NULL,
    		  `opened_at` datetime DEFAULT NULL,
    		  `clicked_at` datetime DEFAULT NULL,
    		  `emailhash` varchar(255) NOT NULL,
    		  `openemail` int(11) DEFAULT NULL,
    		  `openemailtime` datetime NOT NULL,
    		  `sendgrid_message_id` varchar(255) DEFAULT NULL,
    		  `sendgrid_status` varchar(255) DEFAULT NULL,
    		  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
    		  PRIMARY KEY (`id`),
    		  KEY `sendgrid_message_id` (`sendgrid_message_id`)
    		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=457936 ;";
    $this->db->query($sql);
  }
}

?>