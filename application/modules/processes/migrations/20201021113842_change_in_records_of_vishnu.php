<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_in_records_of_vishnu extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set status='Pending' where id=49524");
    $this->db->query("DELETE FROM `processes` WHERE `id` in (50972,50973)");
  }


}

?>