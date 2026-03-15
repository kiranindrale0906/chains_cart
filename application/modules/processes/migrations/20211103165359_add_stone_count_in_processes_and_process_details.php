<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_stone_count_in_processes_and_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes`
    ADD `stone_count` int(11) NOT NULL;");
    $this->db->query("ALTER TABLE `processes`
    ADD `city` varchar(255) NOT NULL;");
    $this->db->query("ALTER TABLE `process_details`
    ADD `city` varchar(255) NOT NULL;");
    $this->db->query("ALTER TABLE `process_details`
    ADD `stone_count` varchar(255) NOT NULL;");
  }


}

?>