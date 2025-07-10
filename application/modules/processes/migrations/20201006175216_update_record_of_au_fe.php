<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_of_au_fe extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 25455;");
  }


}

?>