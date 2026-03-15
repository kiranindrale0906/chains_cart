<?php
  
class Ledgers extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  protected function get_records_by_created_date($records) {
    $records_by_created_date = array();
    foreach($records as $record) {
      if (!isset($records_by_created_date[$record['created_date']])) $records_by_created_date[$record['created_date']] = array();
      $records_by_created_date[$record['created_date']][] = $record;
    }
    return $records_by_created_date;
  }

  protected function set_index_for_dates() {
    foreach($this->data['created_dates'] as $created_date) {
      if (!isset($this->data['total'][$created_date])) {
        $this->data['total'][$created_date] = array();
        $this->data['total'][$created_date]['issue'] = array();
        $this->data['total'][$created_date]['issue']['weight'] = 0;
        $this->data['total'][$created_date]['issue']['fine'] = 0;
        $this->data['total'][$created_date]['receipt']['fine'] = 0;
        $this->data['total'][$created_date]['receipt']['wastage_fine'] = 0;
        $this->data['total'][$created_date]['receipt']['wastage_diff'] = 0;
        $this->data['total'][$created_date]['issue']['wastage_fine'] = 0;
        $this->data['total'][$created_date]['issue']['wastage_diff'] = 0;
        $this->data['total'][$created_date]['issue']['issue_fine'] = 0;
        $this->data['total'][$created_date]['issue']['out_weight'] = 0;
        $this->data['total'][$created_date]['issue']['daily_drawer_wastage'] = 0;
        $this->data['total'][$created_date]['issue']['melting_wastage'] = 0;
        $this->data['total'][$created_date]['issue']['loss'] = 0;
        $this->data['total'][$created_date]['receipt'] = array();
        $this->data['total'][$created_date]['receipt']['weight'] = 0;
        $this->data['total'][$created_date]['receipt']['in_weight'] = 0;
        $this->data['total'][$created_date]['receipt']['fine'] = 0;
        $this->data['total'][$created_date]['receipt']['wastage_fine'] = 0;
        $this->data['total'][$created_date]['receipt']['wastage_diff'] = 0;
        $this->data['total'][$created_date]['receipt']['issue_fine'] = 0;
        $this->data['total'][$created_date]['receipt']['gross'] = 0;
        $this->data['total'][$created_date]['receipt']['gpc_powder'] = 0;
        $this->data['total'][$created_date]['receipt']['kcn'] = 0;
        $this->data['total'][$created_date]['issue']['gross'] = 0;
      }
    }
  }

  protected function get_total_by_created_date($records, $type) {
    foreach($this->data['created_dates'] as $created_date) {
      if (!isset($records[$created_date])) continue;
      foreach($records[$created_date] as $record) {
        if (!isset($this->data['total'][$record['created_date']]['issue'])) {
          $this->data['total'][$record['created_date']]['issue'] = array();
          $this->data['total'][$record['created_date']]['issue']['weight'] = 0;
          $this->data['total'][$record['created_date']]['issue']['fine'] = 0;
          $this->data['total'][$record['created_date']]['issue']['wastage_fine'] = 0;
          $this->data['total'][$record['created_date']]['issue']['wastage_diff'] = 0;
          $this->data['total'][$record['created_date']]['issue']['issue_fine'] = 0;
          $this->data['total'][$record['created_date']]['issue']['gross'] = 0;
          $this->data['total'][$record['created_date']]['issue']['out_weight'] = 0;
          $this->data['total'][$record['created_date']]['issue']['in_weight'] = 0;
          $this->data['total'][$record['created_date']]['issue']['daily_drawer_wastage'] = 0;
          $this->data['total'][$record['created_date']]['issue']['melting_wastage'] = 0;
          $this->data['total'][$record['created_date']]['issue']['loss'] = 0;
        }

        if (!isset($this->data['total'][$record['created_date']]['receipt'])) {
          $this->data['total'][$record['created_date']]['receipt'] = array();
          $this->data['total'][$record['created_date']]['receipt']['weight'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['in_weight'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['out_weight'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['fine'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['wastage_fine'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['wastage_diff'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['issue_fine'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['gross'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['gpc_powder'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['kcn'] = 0;
        }

        
        if(!empty($record['kcn']) && $type=='receipt'){
           $this->data['total'][$record['created_date']][$type]['kcn'] += $record['kcn'];
        }
        if(!empty($record['gpc_powder']) && $type=='receipt'){
           $this->data['total'][$record['created_date']][$type]['gpc_powder'] += $record['gpc_powder'];
        }
        if(!empty($record['in_weight']) && $type=='receipt'){
           $this->data['total'][$record['created_date']][$type]['in_weight'] += $record['in_weight'];
        }
        if(!empty($record['in_weight']) && $type=='issue'){
           $this->data['total'][$record['created_date']][$type]['in_weight'] += $record['in_weight'];
        }
        if(!empty($record['out_weight']) && $type=='issue'){
           $this->data['total'][$record['created_date']][$type]['out_weight'] += $record['out_weight'];
        }
        if(!empty($record['out_weight']) && $type=='receipt'){
           $this->data['total'][$record['created_date']][$type]['out_weight'] += $record['out_weight'];
        }
        if(!empty($record['melting_wastage']) && $type=='issue'){
           $this->data['total'][$record['created_date']][$type]['melting_wastage'] += $record['melting_wastage'];
        }
        if(!empty($record['daily_drawer_wastage']) && $type=='issue'){
           $this->data['total'][$record['created_date']][$type]['daily_drawer_wastage'] += $record['daily_drawer_wastage'];
        }if(!empty($record['loss']) && $type=='issue'){
           $this->data['total'][$record['created_date']][$type]['loss'] += $record['loss'];
        }
        if(!empty($record['weight']) && $type=='receipt'){
         $this->data['total'][$record['created_date']][$type]['weight'] += $record['weight'];
        }if(!empty($record['weight']) && $type=='issue'){
         $this->data['total'][$record['created_date']][$type]['weight'] += $record['weight'];
        }
        $this->data['total'][$record['created_date']][$type]['fine'] += $record['fine'];
        $record['wastage_fine'] = $record['wastage_fine'] ?? 0;
        $this->data['total'][$record['created_date']][$type]['wastage_fine'] += $record['wastage_fine'];
        $record['wastage_diff'] = $record['wastage_diff'] ?? 0;
        $this->data['total'][$record['created_date']][$type]['wastage_diff'] += $record['wastage_diff'];
        $record['issue_fine'] = $record['issue_fine'] ?? 0;
        $this->data['total'][$record['created_date']][$type]['issue_fine'] += $record['issue_fine'];
        if(!empty($record['gross']) && ($type=='issue' || $type=='receipt')){
        $this->data['total'][$record['created_date']][$type]['gross'] += $record['gross'];
        }
      }
    }     
  }

  protected function get_balance_by_created_date() {
    $previous_date = '';
    $previous_type = '';
    foreach($this->data['created_dates'] as $created_date) {
      if($this->router->class!="fancy_chain_ledgers"){

        if ($previous_type != '') {
          $this->data['total'][$created_date][$previous_type]['weight'] += $this->data['balance'][$previous_date][$previous_type]['weight'];
          $this->data['total'][$created_date][$previous_type]['fine'] += $this->data['balance'][$previous_date][$previous_type]['fine'];
          $this->data['total'][$created_date][$previous_type]['wastage_fine'] += $this->data['balance'][$previous_date][$previous_type]['wastage_fine'];
          $this->data['total'][$created_date][$previous_type]['wastage_diff'] += $this->data['balance'][$previous_date][$previous_type]['wastage_diff'];
          $this->data['total'][$created_date][$previous_type]['issue_fine'] += $this->data['balance'][$previous_date][$previous_type]['issue_fine'];
        }
      }
      
      //if ($this->data['total'][$created_date]['receipt']['weight'] < $this->data['total'][$created_date]['issue']['weight']) {
        $this->data['balance'][$created_date]['receipt']['weight'] = 
                                                        $this->data['total'][$created_date]['receipt']['weight']
                                                        - $this->data['total'][$created_date]['issue']['weight'];
        $this->data['balance'][$created_date]['receipt']['fine'] = 
                                                        $this->data['total'][$created_date]['receipt']['fine']
                                                        - $this->data['total'][$created_date]['issue']['fine'];
        $this->data['balance'][$created_date]['receipt']['wastage_fine'] = 
                                                        $this->data['total'][$created_date]['receipt']['wastage_fine']
                                                        - $this->data['total'][$created_date]['issue']['wastage_fine'];
        $this->data['balance'][$created_date]['receipt']['wastage_diff'] = 
                                                        $this->data['total'][$created_date]['receipt']['wastage_diff']
                                                        - $this->data['total'][$created_date]['issue']['wastage_diff'];
        $this->data['balance'][$created_date]['receipt']['issue_fine'] = 
                                                        $this->data['total'][$created_date]['receipt']['issue_fine']
                                                        - $this->data['total'][$created_date]['issue']['issue_fine'];
        $this->data['balance'][$created_date]['receipt']['gross'] = 
                                                        $this->data['total'][$created_date]['receipt']['gross']
                                                        - $this->data['total'][$created_date]['issue']['gross'];
        
        $this->data['balance'][$created_date]['receipt']['gpc_powder'] = 
                                                        $this->data['total'][$created_date]['receipt']['gpc_powder'];

        $this->data['balance'][$created_date]['receipt']['kcn'] = 
                                                        $this->data['total'][$created_date]['receipt']['kcn'];
        
        $type = 'receipt';
      // } else {
      //   if(!empty($_GET['period'])&&$_GET['period']!=='week' && $_GET['period']!=='month' && $_GET['period']!=='year'){
      //   $this->data['balance'][$created_date]['issue']['weight'] = 
      //                                                   $this->data['total'][$created_date]['issue']['weight']
      //                                                   - $this->data['total'][$created_date]['receipt']['weight'];
      //   $this->data['balance'][$created_date]['issue']['fine'] = 
      //                                                   $this->data['total'][$created_date]['issue']['fine'] 
      //                                                   - $this->data['total'][$created_date]['receipt']['fine'];
      //   $this->data['balance'][$created_date]['issue']['wastage_fine'] = 
      //                                                   $this->data['total'][$created_date]['issue']['wastage_fine'] 
      //                                                   - $this->data['total'][$created_date]['receipt']['wastage_fine'];
      //   $this->data['balance'][$created_date]['issue']['wastage_diff'] = 
      //                                                   $this->data['total'][$created_date]['issue']['wastage_diff'] 
      //                                                   - $this->data['total'][$created_date]['receipt']['wastage_diff'];
      //   $this->data['balance'][$created_date]['issue']['issue_fine'] = 
      //                                                   $this->data['total'][$created_date]['issue']['issue_fine'] 
      //                                                   - $this->data['total'][$created_date]['receipt']['issue_fine'];
      //   $this->data['balance'][$created_date]['issue']['gross'] = 
      //                                                   $this->data['total'][$created_date]['issue']['gross'] 
      //                                                   - $this->data['total'][$created_date]['receipt']['gross'];
      //   $type = 'issue';
      // }
    //}
      
      $previous_date = $created_date;
      $previous_type = @$type;
    }     
  }

  protected function remove_receipt_issue_matching_records() {
    foreach ($this->data['created_dates'] as $created_date) {
      if (!isset($this->data['issues'][$created_date])) continue;
      foreach($this->data['issues'][$created_date] as $issue_index => $issue) {
        if (!isset($this->data['receipts'][$created_date])) continue;
        $match_receipts = TRUE;
        foreach($this->data['receipts'][$created_date] as $receipt_index => $receipt) {
          if ($match_receipts
              && round($issue['weight'], 4) == round($receipt['weight'], 4)
              && round($issue['in_weight'], 4) == round($receipt['in_weight'], 4)
              //&& round($issue['gross'], 4) == round($receipt['gross'], 4)
              && round($issue['purity'], 4) == round($receipt['purity'], 4)
              && round($issue['fine'], 4) == round($receipt['fine'], 4)) {
            unset($this->data['issues'][$created_date][$issue_index]);
            unset($this->data['receipts'][$created_date][$receipt_index]);
            $match_receipts = FALSE;
          }
        }
      }
    }
  }
}
?>
