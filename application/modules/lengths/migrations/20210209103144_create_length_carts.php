<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_length_carts extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `length_carts` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        `created_by` int(11) DEFAULT NULL,
        `updated_by` int(11) DEFAULT NULL,
        `is_delete` tinyint(4) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
      ) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;");
  }
}

?>