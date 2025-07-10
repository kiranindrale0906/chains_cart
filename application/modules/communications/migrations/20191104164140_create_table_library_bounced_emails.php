<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_bounced_emails extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `library_bounced_emails` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `email_address` varchar(255) NOT NULL,
          `library_email_log_id` int(11) NOT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime NOT NULL,
          `is_delete` tinyint(4) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=306 ;";
    $this->db->query($sql);
  }


}

?>