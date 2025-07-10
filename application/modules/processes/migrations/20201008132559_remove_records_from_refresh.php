<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_remove_records_from_refresh extends CI_Model {

  public function up()
  {
    $this->db->query("DELETE FROM `processes` WHERE `processes`.`id` in (26486,26487)");
    
  }


}

?>