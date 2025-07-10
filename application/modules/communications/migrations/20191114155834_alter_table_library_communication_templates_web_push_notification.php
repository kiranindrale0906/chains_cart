<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_communication_templates_web_push_notification extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE  `library_communication_templates` ADD  `webpushto` varchar(255) NULL DEFAULT NULL AFTER  `pushto`,  ADD  `webpushtext` text NULL DEFAULT NULL AFTER  `webpushto`,  ADD  `webpushurl` text NULL DEFAULT NULL AFTER  `webpushtext`,  ADD  `webpushimage` text NULL DEFAULT NULL AFTER  `webpushurl`";
    $this->db->query($sql);
  }


}

?>