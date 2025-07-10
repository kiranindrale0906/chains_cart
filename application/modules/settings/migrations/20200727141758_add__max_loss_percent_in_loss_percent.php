<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__max_loss_percent_in_loss_percent extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `loss_percentages` ADD `max_loss_percentage` DECIMAL(10,4) NOT NULL ");
  }


}

?>