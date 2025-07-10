<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_due_durations extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE karigars SET `due_duration` = '21600';");
  }


}

?>