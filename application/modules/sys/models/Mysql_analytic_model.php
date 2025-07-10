<?php
class Mysql_analytic_model extends BaseModel {
  protected $table_name = 'users';
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function get_logs() {
    $file_dir = '/var/www/mysql-logs/mysql-slow.log';
    $file_content = file_get_contents($file_dir);
    $logs = explode("# User@Host: ", $file_content);  //PHP
    unset($logs[0]);
    array_splice($logs,0,0);
    $logdata = array();
    $log_entry = '';
    $log_lines = array();
    $entry_stats = '';
    foreach ($logs as $index => $log) {
      $log_entry = $log;
      $log_lines = explode("\n", $log_entry);
      preg_match_all("/\[([^\]]*)\]/", $log_lines[0], $matches);
      if ($matches[1][0] == $this->db->username) {
        $logdata[$index]['db_name'] = $matches[1][0];

        $entry_stats = explode(" ", $log_lines[1]);
        $logdata[$index]['query_time'] = $entry_stats[2];
        $logdata[$index]['lock_time'] = $entry_stats[5];
        $logdata[$index]['rows_sent'] = $entry_stats[7];
        $logdata[$index]['rows_examined'] = $entry_stats[10];
        
        if (substr($log_lines[2], 0, 3) == 'use') {
          unset($log_lines[2]);
          array_splice($log_lines,0,0);
        }

        $timestamp = $this->string_between_two_string($log_lines[2], "SET timestamp=", ";");
        $date = date('d/m/Y h:i:s', $timestamp);
        
        $logdata[$index]['date'] = $date;

        unset($log_lines[0]);
        unset($log_lines[1]);
        unset($log_lines[2]);

        array_splice($log_lines,0,0);

        $log_lines = implode("\n", $log_lines);
        $log_lines = explode("# Time: ", $log_lines);

        $logdata[$index]['query_string'] = $log_lines[0];      

      }
    }

    $query_times = array_column($logdata, 'query_time');
    array_multisort($query_times, SORT_DESC, $logdata);
    
    return $logdata;
  }

  public function string_between_two_string($str, $starting_word, $ending_word) { 
    $subtring_start = strpos($str, $starting_word); 
    $subtring_start += strlen($starting_word);   
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
    return substr($str, $subtring_start, $size);   
  } 
}
?>


