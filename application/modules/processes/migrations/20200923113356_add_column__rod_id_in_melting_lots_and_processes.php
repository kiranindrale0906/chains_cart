ALTER TABLE `processes` ADD `issue_loss` DECIMAL(12,8) NOT NULL<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column__rod_id_in_melting_lots_and_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `rod_id` int(11) NOT NULL");
    $this->db->query("ALTER TABLE `melting_lots` ADD `rod_id` int(11) NOT NULL");
  }


}

?>