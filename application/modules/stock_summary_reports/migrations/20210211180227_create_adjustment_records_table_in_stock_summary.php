<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_adjustment_records_table_in_stock_summary extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `adjustment_records` (
					  `id` int(11) NOT NULL,
					  `balance` decimal(10,8) NOT NULL,
					  `balance_gross` decimal(10,8) NOT NULL,
					  `balance_fine` decimal(10,8) NOT NULL,
					  `created_by` int(11) NOT NULL,
					  `created_at` datetime NOT NULL,
					  `updated_by` int(11) NOT NULL,
					  `updated_at` datetime NOT NULL,
					  `is_delete` int(4) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    $this->db->query("ALTER TABLE `adjustment_records` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `adjustment_records` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    $this->db->query("INSERT INTO `adjustment_records` (`id`, `balance`, `balance_gross`, `balance_fine`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_delete`) VALUES
(1, '1.00000000', '1.00000000', '1.00000000', 7, '2021-02-11 19:09:47', 0, '2021-02-11 19:09:47', 0);");
    
  }


}

?>