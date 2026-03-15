<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_column_tounch_fine_loss extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` DROP `tounch_fine_loss`;");
  }


}

?>