<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_process_factory_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_factory_order_details` (
										  `id` int(11) NOT NULL,
										  `process_id` int(11) NOT NULL,
										  `process_detail_id` int(11) NOT NULL,
										  `melting_lot_id` int(11) NOT NULL,
										  `factory_order_detail_id` int(11) NOT NULL,
										  `created_at` datetime NOT NULL,
										  `created_by` int(11) NOT NULL,
										  `updated_by` int(11) NOT NULL,
										  `updated_at` datetime NOT NULL,
										  `is_delete` int(4) NOT NULL
										) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
										$this->db->query("ALTER TABLE `process_factory_order_details`
										  ADD PRIMARY KEY (`id`);");
										$this->db->query("ALTER TABLE `process_factory_order_details`
								  		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>