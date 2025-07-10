<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_of_solder_watsge extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set status='Pending' where id=52869");
  }


}

?>