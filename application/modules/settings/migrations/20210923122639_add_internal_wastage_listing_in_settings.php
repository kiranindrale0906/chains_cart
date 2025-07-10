<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_internal_wastage_listing_in_settings extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `internal_wastages` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(255) NOT NULL,
                    `wastage` float NOT NULL,
                    `is_delete` tinyint(4) NOT NULL DEFAULT '0',
                    `created_at` datetime NOT NULL,
                    `updated_at` datetime NOT NULL,
                    `created_by` int(11) NOT NULL DEFAULT '0',
                    `updated_by` int(11) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
  }


}

?>