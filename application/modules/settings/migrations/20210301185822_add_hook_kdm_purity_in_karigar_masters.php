<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_hook_kdm_purity_in_karigar_masters extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `karigar_masters` ADD `hook_kdm_purity` DECIMAL(12,8) NOT NULL");
  }


}

?>