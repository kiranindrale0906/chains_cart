<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_parent_lots extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE IF NOT EXISTS `parent_lots` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `process_name` varchar(225) NOT NULL,
										  `name` varchar(225) NOT NULL,
										  `status` int(11) NOT NULL,
										  `is_delete` int(11) NOT NULL DEFAULT '0',
										  `updated_at` datetime NOT NULL,
										  `created_at` datetime NOT NULL,
										  `created_by` int(11) NOT NULL,
										  `updated_by` int(11) NOT NULL,
										  `srno` int(11) NOT NULL DEFAULT '0',
										  PRIMARY KEY (`id`)
										) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;");
  }


}

?>

