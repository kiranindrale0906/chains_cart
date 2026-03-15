<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_packing_slip_in_exports extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `packing_slips` (
  `id` int(11) NOT NULL,
  `chitti_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(225) NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `weight` decimal(10,4) NOT NULL,
  `fine` decimal(10,4) NOT NULL,
  `purity` decimal(10,4) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `voucher_id` int(11) NOT NULL DEFAULT 0,
  `factory_purity` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `credit_weight` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `debit_amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `factory_fine` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `quantity` int(11) DEFAULT 0,
  `sr_no` int(11) DEFAULT 0,
  `stone` decimal(16,4) DEFAULT 0.0000,
  `net_weight` decimal(16,4) DEFAULT 0.0000,
  `making_charge` decimal(16,4) DEFAULT 0.0000,
  `pure` decimal(16,4) DEFAULT 0.0000,
  `total` decimal(16,4) DEFAULT 0.0000,
  `description` varchar(500) DEFAULT NULL,
  `colour` varchar(100) DEFAULT NULL,
  `gross_weight` decimal(16,4) DEFAULT 0.0000
);");
    $this->db->query("CREATE TABLE `packing_slip_details` (
  `id` int(11) NOT NULL,
  `packing_slip_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(225) NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `weight` decimal(10,4) NOT NULL,
  `fine` decimal(10,4) NOT NULL,
  `purity` decimal(10,4) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `packet_no` int(11) NOT NULL DEFAULT 0,
  `factory_purity` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `credit_weight` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `debit_amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `quantity` int(11) DEFAULT 0,
  `stone` decimal(16,4) DEFAULT 0.0000,
  `pure` decimal(16,4) DEFAULT 0.0000,
  `description` varchar(500) DEFAULT NULL,
  `colour` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `sr_no` int(11) DEFAULT 0,
  `net_weight` decimal(16,4) DEFAULT 0.0000,
  `balance` decimal(16,4) DEFAULT 0.0000,
  `total` decimal(16,4) DEFAULT 0.0000,
  `making_charge` decimal(16,4) NOT NULL,
  `factory_fine` decimal(16,4) NOT NULL,
  `gross_weight` decimal(16,4) DEFAULT 0.0000,
  `category_name` varchar(225) DEFAULT NULL,
  `site_name` varchar(225) DEFAULT NULL,
  `category_2` varchar(225) DEFAULT NULL
) ");
    $this->db->query("ALTER TABLE `packing_slips`
  ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `packing_slip_details`
  ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `packing_slips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    $this->db->query("ALTER TABLE `packing_slip_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

  }


}

?>