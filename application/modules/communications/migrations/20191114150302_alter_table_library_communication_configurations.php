<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_library_communication_configurations extends CI_Model {

  public function up()
  {
  	$sql = "ALTER TABLE  `library_communication_configurations` ADD  `webpushtoken` text NULL DEFAULT NULL AFTER  `sengrid_api_key`,  ADD  `webauthdomain` varchar(255) NULL DEFAULT NULL AFTER  `webpushtoken`,  ADD  `webdatabaseurl` varchar(255) NULL DEFAULT NULL AFTER  `webauthdomain`,  ADD  `webprojectid` varchar(255) NULL DEFAULT NULL AFTER  `webdatabaseurl`,  ADD  `webstoragebucket` varchar(255) NULL DEFAULT NULL AFTER  `webprojectid`,  ADD  `webmessagingSenderid` varchar(255) NULL DEFAULT NULL AFTER  `webstoragebucket`,  ADD  `webappid` varchar(255) NULL DEFAULT NULL AFTER  `webmessagingSenderid`,  ADD  `webmeasurementid` varchar(255) NULL DEFAULT NULL AFTER  `webappid` ;";
    $this->db->query($sql);
  }


}

?>