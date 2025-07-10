<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_completed_at extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `completed_at` DATETIME NULL DEFAULT NULL;");
  }


}

?>