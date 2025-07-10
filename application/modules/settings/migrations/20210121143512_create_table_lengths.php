<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_lengths extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `lengths` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `design_code` varchar(255) DEFAULT NULL,
                        `range` varchar(255) DEFAULT NULL,
                        `weight` decimal(10,2) DEFAULT NULL,
                        `length` decimal(10,2) DEFAULT NULL,
                        `created_at` datetime DEFAULT NULL,
                        `updated_at` datetime DEFAULT NULL,
                        `created_by` int(11) DEFAULT NULL,
                        `updated_by` int(11) DEFAULT NULL,
                        `is_delete` tinyint(4) NOT NULL DEFAULT '0',
                        PRIMARY KEY (`id`)
                      ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;");
  }


}

?>