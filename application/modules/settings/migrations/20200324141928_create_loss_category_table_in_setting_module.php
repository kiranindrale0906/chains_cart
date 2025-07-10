<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_loss_category_table_in_setting_module extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `loss_categories` (
									  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
									  `department_name` varchar(255) NOT NULL,
									  `name` varchar(255) NOT NULL,
									  `created_at` datetime NOT NULL,
									  `updated_at` datetime NOT NULL,
									  `created_by` int(11) NOT NULL,
									  `updated_by` int(11) NOT NULL,
									  `is_delete` tinyint(4) NOT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
									  }


}

?>