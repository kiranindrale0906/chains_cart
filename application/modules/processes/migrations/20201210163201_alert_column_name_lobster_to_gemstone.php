<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alert_column_name_lobster_to_gemstone extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` CHANGE `lobster_in` `gemstone_in` DECIMAL(16,8) NOT NULL DEFAULT '0.00000000', CHANGE `lobster_out` `gemstone_out` DECIMAL(16,8) NOT NULL DEFAULT '0.00000000';");
    
    $this->db->query("ALTER TABLE `process_details` CHANGE `lobster_in` `gemstone_in` DECIMAL(16,8) NOT NULL DEFAULT '0.00000000', CHANGE `lobster_out` `gemstone_out` DECIMAL(16,8) NOT NULL DEFAULT '0.00000000'");
  }


}

?>