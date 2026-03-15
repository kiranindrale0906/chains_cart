<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_records_from_refresh_hold extends CI_Model {

  public function up()
  {
   	$this->db->query("ALTER TABLE `processes` ADD `out_gpc_out` DECIMAL(12,8) NOT NULL ,
											 ADD `chitti_out` DECIMAL(12,8) NOT NULL ,
											 ADD `issue_chitti_out` DECIMAL(12,8) NOT NULL ,
											 ADD `balance_chitti_out` DECIMAL(12,8) NOT NULL;
											");
  }


}

?>