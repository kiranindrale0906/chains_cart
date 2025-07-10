<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_sms_logs extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `library_sms_logs` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `smsto` varchar(50) DEFAULT NULL,
					  `smsfrom` varchar(255) DEFAULT NULL,
					  `apiurl` varchar(255) DEFAULT NULL,
					  `postfields` text,
					  `curlresponse` text,
					  `status` varchar(255) DEFAULT NULL,
					  `smstext` text,
					  `created_at` datetime DEFAULT NULL,
					  `updated_at` datetime DEFAULT NULL,
					  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28646 ;";
    $this->db->query($sql);
  }
}
?>