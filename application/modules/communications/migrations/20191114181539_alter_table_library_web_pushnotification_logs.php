<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_web_pushnotification_logs extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE  `library_web_pushnotification_logs` CHANGE  `fcm_response`  `response` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;";
    $this->db->query($sql);
  }


}

?>