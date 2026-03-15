<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_remove_records_from_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("DELETE FROM `process_details` WHERE `id`=11181");
    $this->db->query("DELETE FROM `process_details` WHERE `id`=11183");
    
  }


}

?>