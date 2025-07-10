<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_open_fields extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `open_fields` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `in` decimal(10,2) DEFAULT NULL,
                      `out` decimal(10,2) DEFAULT NULL,
                      `description` text,
                      `purity` decimal(10,2) DEFAULT NULL,
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