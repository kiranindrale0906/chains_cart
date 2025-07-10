<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_from_hook_processes extends CI_Model {

  public function up()
  {
    $this->db->query("update processes set customer_name='bhaskar' where id=68670");
  }


}

?>