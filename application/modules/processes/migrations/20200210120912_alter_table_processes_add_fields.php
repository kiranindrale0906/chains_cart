<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_processes_add_fields extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes`  
    									ADD `issue_melting_wastage` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `issue_daily_drawer_wastage` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `gpc_out` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `issue_gpc_out` DECIMAL(10,4) NOT NULL DEFAULT '0',  
											ADD `balance_gpc_out` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>