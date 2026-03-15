<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_out_quantity_and_balance__quantity extends CI_Model {

  public function up()
  {

    $this->db->query("ALTER TABLE `processes` ADD `out_quantity` INT(11) NOT NULL DEFAULT '0' , ADD `balance_quantity` INT(11) NOT NULL DEFAULT '0' AFTER `out_quantity`;");
  }


}

?>
