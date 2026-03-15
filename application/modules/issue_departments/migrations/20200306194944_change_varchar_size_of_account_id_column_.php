<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_varchar_size_of_account_id_column_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `issue_departments` CHANGE  `account_id`  `account_id` VARCHAR( 225 ) NULL DEFAULT NULL ;");
  }


}

?>