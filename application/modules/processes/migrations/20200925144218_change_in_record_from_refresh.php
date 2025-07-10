<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_in_record_from_refresh extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE `processes` SET `balance_loss` = '0' WHERE `processes`.`id` = 33009;");
    
    $this->db->query("UPDATE `processes` SET `loss` = '0' WHERE `processes`.`id` = 33009;");
    $this->db->query("UPDATE `processes` SET `daily_drawer_wastage` = '57.45000000' WHERE `processes`.`id` = 33009;");
    $this->db->query("UPDATE `processes` SET `balance_daily_drawer_wastage` = '57.45000000' WHERE `processes`.`id` = 33009;");
    



  }


}

?>