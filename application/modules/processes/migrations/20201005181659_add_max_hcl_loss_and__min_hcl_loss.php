<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_max_hcl_loss_and__min_hcl_loss extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `min_hcl_loss` DECIMAL(16,8) NOT NULL , ADD `max_hcl_loss` DECIMAL(16,8) NOT NULL");
  }


}

?>