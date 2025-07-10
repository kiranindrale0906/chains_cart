<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_data_type_of_internal_wastage extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` CHANGE `internal_wastage` `internal_wastage` VARCHAR(225) NULL DEFAULT NULL;");
  }


}

?>