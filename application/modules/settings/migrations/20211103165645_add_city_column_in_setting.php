<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_city_column_in_setting extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `cities` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `created_by` int(11) NOT NULL,
    `updated_by` int(11) NOT NULL,
    `is_delete` tinyint(4) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
  }


}

?>