<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_field_job_card_no_rejected_out_and_rejected_out_qty_and_gpc_out_qty extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `job_card_no` varchar(11) DEFAULT NULL , ADD `rejected_out` decimal(16,8) NOT NULL DEFAULT '0', ADD `item_name` varchar(255) DEFAULT NULL, ADD `rejected_qty` INT(11) NOT NULL DEFAULT '0', ADD `gpc_out_qty` INT(11) NOT NULL DEFAULT '0'");
  	$this->db->query("ALTER TABLE `process_details` ADD `rejected_out` DECIMAL(16,8) NOT NULL DEFAULT '0',ADD `rejected_qty` INT(11) NOT NULL DEFAULT '0',ADD `gpc_out_qty` INT(11) NOT NULL DEFAULT '0',ADD `out_quantity` INT(11) NOT NULL DEFAULT '0',ADD `balance_quantity` INT(11) NOT NULL DEFAULT '0'");
  }


}

?>