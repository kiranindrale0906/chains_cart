<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_gross_loss_in_processes extends CI_Model {

  public function up()
  {
  $this->db->query("ALTER TABLE `processes` ADD `gross_loss` int(11) NOT NULL DEFAULT '0.00000000';");
  }
}

?>