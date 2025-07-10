<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_factory_karigar extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set factory_karigar='Office'");
  }


}

?>