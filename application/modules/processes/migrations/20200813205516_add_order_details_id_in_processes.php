<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_order_details_id_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `order_detail_id` INT(11) NOT NULL");
  }


}

?>