<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_communication_templates extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `library_communication_templates` CHANGE  `emailsampledata`  `sampledata` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;";
    $this->db->query($sql);
  }


}

?>