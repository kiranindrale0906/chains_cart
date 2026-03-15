<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_view_calender extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE VIEW `view_calendars` AS select `calendars`.`id` AS `id`,`calendars`.`selected_date` AS `selected_date`,`calendars`.`day` AS `day`,`calendars`.`open_time` AS `open_time`,`calendars`.`close_time` AS `close_time`,(case when (`calendars`.`is_closed` = '1') then 'Closed' else 'Open' end) AS `is_closed`,`calendars`.`is_delete` AS `is_delete` from `calendars`");
  }


}

?>