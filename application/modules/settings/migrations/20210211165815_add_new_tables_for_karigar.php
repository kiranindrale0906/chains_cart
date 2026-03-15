<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_tables_for_karigar extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `karigar_masters` (
								  `id` int(11) NOT NULL,
								  `karigar_name` varchar(225) NOT NULL,
								  `chain_name` varchar(225) NOT NULL,
								  `created_by` int(11) NOT NULL,
								  `created_at` datetime NOT NULL,
								  `updated_by` int(11) NOT NULL,
								  `updated_at` datetime NOT NULL,
								  `is_delete` int(4) NOT NULL
								) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	$this->db->query("ALTER TABLE `karigar_masters`
	  ADD PRIMARY KEY (`id`)");

	$this->db->query("ALTER TABLE `karigar_masters`
  		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>