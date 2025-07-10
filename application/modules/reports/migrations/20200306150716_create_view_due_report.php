<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_view_due_report extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE VIEW `due_reports` AS
    										select `processes`.`id` AS `id`,`processes`.`product_name` AS `product_name`,
    										`processes`.`process_name` AS `process_name`,
    										`processes`.`department_name` AS `department_name`,
    										`processes`.`status` AS `status`,
    										`processes`.`created_at` AS `pending_from`,
    										timestampdiff(SECOND,`processes`.`created_at`,now()) AS `durations_taken_in_seconds`
    										,`karigars`.`due_duration` AS `due_duration_in_seconds`,
    											concat(floor((time_format(sec_to_time(`karigars`.`due_duration`),'%H') / 24)),
    													'days ',(time_format(sec_to_time(`karigars`.`due_duration`),'%H') % 24),'h:',time_format(sec_to_time(`karigars`.`due_duration`),'%im:%ss')
    												) AS `due_duration_in_days`,
    											concat(floor((time_format(sec_to_time(timestampdiff(SECOND,`processes`.`created_at`,now())),'%H') / 24)),'days ',(time_format(sec_to_time(timestampdiff(SECOND,`processes`.`created_at`,now())),'%H') % 24),'h:',time_format(sec_to_time(timestampdiff(SECOND,`processes`.`created_at`,now())),'%im:%ss')
    											) AS `days_taken`,
    											concat(floor((time_format(sec_to_time((timestampdiff(SECOND,`processes`.`created_at`,now()) - `karigars`.`due_duration`)),'%H') / 24)),'days ',(time_format(sec_to_time((timestampdiff(SECOND,`processes`.`created_at`,now()) - `karigars`.`due_duration`)),'%H') % 24),'h:',time_format(sec_to_time((timestampdiff(SECOND,`processes`.`created_at`,now()) - `karigars`.`due_duration`)),'%im:%ss')
    											) AS `extra_time_taken`,
    											`processes`.`is_delete` AS `is_delete`,
    											(case
    												when (timestampdiff(SECOND,`processes`.`created_at`,now()) < `karigars`.`due_duration`)
    													then 'ON Time'
    												when (timestampdiff(SECOND,`processes`.`created_at`,now()) > (`karigars`.`due_duration` + 86400))
    													then 'High Priority'
    												when (timestampdiff(SECOND,`processes`.`created_at`,now()) > (`karigars`.`due_duration` + 259200))
    													then 'Very High Priority'
    												else 'Still On Time' end) AS `priority`
    											from (`processes`
    											join `karigars`
    												on(((`karigars`.`product_name` = `processes`.`product_name`)
    												and (`karigars`.`process_name` = `processes`.`process_name`)
    												and (`karigars`.`department_name` = `processes`.`department_name`))))
    											where ((`processes`.`status` = 'Pending')
    												and (`karigars`.`due_duration` is not null))
    											group by `processes`.`product_name`,`processes`.`process_name`,`processes`.`department_name`,`processes`.`id`,`due_duration_in_seconds`
    											having (`durations_taken_in_seconds` > `due_duration_in_seconds`)");
  }


}

?>