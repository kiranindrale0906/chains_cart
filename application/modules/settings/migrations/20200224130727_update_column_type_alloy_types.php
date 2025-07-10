<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_column_type_alloy_types extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `alloy_types` CHANGE `created_by` `created_by` INT NOT NULL,CHANGE `updated_by` `updated_by` INT NOT NULL;");
  }


}

?>