<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_calendars extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `calendars` (
										  `id` int(11) NOT NULL,
										  `selected_date` date NOT NULL,
										  `day` varchar(200) NOT NULL,
										  `close_time` time DEFAULT NULL,
										  `open_time` time DEFAULT NULL,
										  `is_closed` tinyint(4) NOT NULL DEFAULT '0',
										  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
										  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
										  `created_by` int(11) NOT NULL,
										  `updated_by` int(11) NOT NULL,
										  `is_delete` tinyint(4) NOT NULL DEFAULT '0'
										) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
  }


}

?>