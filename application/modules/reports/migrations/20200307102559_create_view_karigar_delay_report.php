<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_view_karigar_delay_report extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE OR REPLACE VIEW delay_report_karigars as 
											select processes.id,processes.product_name,processes.process_name,processes.department_name,status,processes.created_at as pending_from,TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at) as durations_taken_in_seconds,processes.karigar,completed_at,
											due_duration as due_duration_in_seconds,CONCAT(
											    FLOOR(TIME_FORMAT(SEC_TO_TIME(due_duration), '%H') / 24), 'days ',
											    MOD(TIME_FORMAT(SEC_TO_TIME(due_duration), '%H'), 24), 'h:',
											    TIME_FORMAT(SEC_TO_TIME(due_duration), '%im:%ss')
											) as due_duration_in_days,

											CONCAT(
											    FLOOR(TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at)), '%H') / 24), 'days ',
											    MOD(TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at)), '%H'), 24), 'h:',
											    TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at)), '%im:%ss')
											) as days_taken,

											CONCAT(
											    FLOOR(TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at) - due_duration), '%H') / 24), 'days ',
											    MOD(TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at) - due_duration), '%H'), 24), 'h:',
											    TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(SECOND,processes.created_at,processes.completed_at) - due_duration), '%im:%ss')
											) as extra_time_taken,processes.is_delete,expected_at

											from processes 
											INNER JOIN karigars ON karigars.product_name = processes.product_name AND karigars.process_name = processes.process_name AND karigars.department_name = processes.department_name 
											where status = 'Complete' AND due_duration IS NOT NULL GROUP BY processes.product_name,processes.process_name,processes.department_name,id,due_duration_in_seconds HAVING durations_taken_in_seconds > due_duration_in_seconds");
  }


}

?>