<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_remove_records_ka_chain extends CI_Model {

  public function up()
  {
   $this->db->query("DELETE FROM `processes` WHERE `id` in (51487,51488,51489)");
   $this->db->query("DELETE FROM `process_details` WHERE `id` in (16634)");

  }


}

?>