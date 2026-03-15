<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_refine_loss_and_refine_fine extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` DROP `refine_loss_gross`, DROP `refine_loss_fine`;");
  }
}

?>