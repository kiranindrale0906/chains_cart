<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_processes_add_repair_out_related_fields extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes`  
    									ADD `repair_out` DECIMAL(10,4) NOT NULL DEFAULT '0', 
											ADD `issue_repair_out` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `balance_repair_out` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `repair_out_quantity` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>