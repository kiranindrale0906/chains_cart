<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE `processes` SET `in_weight` = '1000.5414' WHERE `processes`.`id` = 24318;");
  }


}

?>