<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_daily_balance_reports extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `daily_rolling_balances` (
					  `id` int(11) NOT NULL,
					  `transaction_date` datetime NOT NULL,
					  `product_name` varchar(255) DEFAULT NULL,
					  `gpc_out` decimal(16,4) DEFAULT 0,
					  `bunch_out` decimal(16,4) DEFAULT 0,
					  `fancy_out` decimal(16,4) DEFAULT 0,
					  `imp_out` decimal(16,4) DEFAULT 0,
					  `balance_gross` decimal(16,4) DEFAULT 0,
					  `balance_fine` decimal(16,4) DEFAULT 0,
					  `pipe_and_para_out` decimal(16,4) DEFAULT 0,
					  `created_at` datetime NOT NULL,
					  `updated_at` datetime NOT NULL,
					  `is_delete` tinyint(4) DEFAULT 0,
					  `created_by` int(11) DEFAULT NULL,
					  `updated_by` int(11) DEFAULT NULL,
					  `deleted_at` datetime DEFAULT NULL)");

	$this->db->query("ALTER TABLE `daily_rolling_balances`
	  ADD PRIMARY KEY (`id`)");
	$this->db->query("ALTER TABLE `daily_rolling_balances`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>