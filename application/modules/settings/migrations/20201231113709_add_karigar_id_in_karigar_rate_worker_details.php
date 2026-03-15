<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_karigar_id_in_karigar_rate_worker_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `karigar_rate_worker_details` ADD `karigar`  VARCHAR(225) NOT NULL");
  }


}

?>