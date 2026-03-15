<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_refine_loss_refine_loss_gross_and_refine_loss_fine_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `refine_loss` DECIMAL(10,4) NOT NULL DEFAULT '0', 
    								 ADD `refine_loss_gross` DECIMAL(10,4) NOT NULL DEFAULT '0', 
    								 ADD `refine_loss_fine` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>