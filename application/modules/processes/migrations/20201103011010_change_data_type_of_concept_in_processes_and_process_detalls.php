<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_data_type_of_concept_in_processes_and_process_detalls extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes change concept concept varchar(50) NOT NULL DEFAULT ''");
    $this->db->query("alter table process_details add concept varchar(50) NOT NULL DEFAULT ''");
  }


}

?>