<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_karigar_name_in_log_percent extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `loss_percentages` ADD  `karigar_name` VARCHAR( 255 ) NULL DEFAULT NULL");
  }


}

?>