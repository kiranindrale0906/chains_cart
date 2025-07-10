<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_departments extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `departments` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(255) DEFAULT NULL,
                      `other_departments` varchar(255) DEFAULT NULL,
                      `department_process_value` varchar(255) DEFAULT NULL,
                      `karigar_name` varchar(255) DEFAULT NULL,
                      `check_field` varchar(255) DEFAULT NULL,
                      `created_at` datetime DEFAULT NULL,
                      `updated_at` datetime DEFAULT NULL,
                      `created_by` int(11) DEFAULT NULL,
                      `updated_by` int(11) DEFAULT NULL,
                      `is_delete` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;");
  }


}

?>