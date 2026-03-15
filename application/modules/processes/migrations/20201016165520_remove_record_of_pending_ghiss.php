<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_remove_record_of_pending_ghiss extends CI_Model {

  public function up()
  {
    $this->db->query("DELETE FROM `processes` WHERE `id` in (47425)");
  }


}

?>