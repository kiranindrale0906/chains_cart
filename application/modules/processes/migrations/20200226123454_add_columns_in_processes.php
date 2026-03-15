<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_columns_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes`
    									ADD  `issue_tounch_loss_fine` decimal( 10,4 ) NOT NULL DEFAULT 0,
    									ADD  `balance_tounch_loss_fine` decimal( 10,4 ) NOT NULL DEFAULT 0,
    									ADD  `issue_hcl_loss` decimal( 10,4 ) NOT NULL DEFAULT 0,
    									ADD  `balance_hcl_loss` decimal( 10,4 ) NOT NULL DEFAULT 0;");
  }


}

?>