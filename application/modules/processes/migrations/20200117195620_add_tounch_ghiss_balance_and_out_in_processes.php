<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tounch_ghiss_balance_and_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `balance_touch_ghiss` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',
ADD  `out_touch_ghiss` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0';");
  }


}

?>
