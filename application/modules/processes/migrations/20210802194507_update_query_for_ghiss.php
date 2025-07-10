<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_query_for_ghiss extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 17062;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 21381;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 20204;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 19615;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 20221;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 20838;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 20807;");
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 21209;");
  }


}

?>