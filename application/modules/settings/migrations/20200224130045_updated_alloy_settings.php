<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_updated_alloy_settings extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `alloy_settings` CHANGE `updated_by` `updated_by` INT(11) NOT NULL,CHANGE `created_by` `created_by` INT(11) NOT NULL;");
 
  }


}

?>