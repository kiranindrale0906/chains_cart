<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_wastage_purities_columns_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `wastage_purity` decimal( 12,4 ) NOT NULL DEFAULT 0,
                      ADD  `wastage_lot_purity` decimal( 12,4 ) NOT NULL DEFAULT 0 ;");
  }


}

?>