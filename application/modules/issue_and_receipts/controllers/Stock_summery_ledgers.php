<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Stock_summery_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/stock_summery_ledgers/create');
  }

  public function _get_form_data() {
    $receipts = $this->stock_summery_ledger_model->get_receipt_data();
    $stocks = $this->stock_summery_ledger_model->get_stock_data();
    $issues = $this->stock_summery_ledger_model->get_issue_data();
    //$receipts = array();
    //$stocks = array();
    //$issues = array();
    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $stock_created_dates = array_column($stocks, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates, 
                                                                         $stock_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = $this->get_records_by_created_date($receipts);
    $this->data['issues'] = $this->get_records_by_created_date($issues);
    $this->data['stocks'] = $this->get_records_by_created_date($stocks);

    /*if (!isset($_GET['do_no_remove_duplicate']))
      $this->remove_receipt_issue_matching_records();*/

    $this->data['total'] = array();

    $this->get_total_by_created_date($this->data['issues'], 'issue');

    $this->get_total_by_created_date($this->data['receipts'], 'receipt');

    $this->get_total_by_created_date($this->data['stocks'], 'stock');

    $this->set_index_for_dates();

    $this->get_balance_by_created_date();
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
        $this->data['total'][$created_date]['receipt'] = array();
        $this->data['total'][$created_date]['receipt']['weight'] = 0;
        $this->data['total'][$created_date]['receipt']['fine'] = 0;
        $this->data['total'][$created_date]['stock'] = array();
        $this->data['total'][$created_date]['stock']['weight'] = 0;
        $this->data['total'][$created_date]['stock']['fine'] = 0;
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
        }

        if (!isset($this->data['total'][$record['created_date']]['receipt'])) {
          $this->data['total'][$record['created_date']]['receipt'] = array();
          $this->data['total'][$record['created_date']]['receipt']['weight'] = 0;
          $this->data['total'][$record['created_date']]['receipt']['fine'] = 0;
        }

        if (!isset($this->data['total'][$record['created_date']]['stock'])) {
          $this->data['total'][$record['created_date']]['stock'] = array();
          $this->data['total'][$record['created_date']]['stock']['weight'] = 0;
          $this->data['total'][$record['created_date']]['stock']['fine'] = 0;
        }

        $this->data['total'][$record['created_date']][$type]['weight'] += $record['weight'];
        $this->data['total'][$record['created_date']][$type]['fine'] += $record['fine'];
      }
    }     
  }

  protected function get_balance_by_created_date() {
    $previous_date = '';
    $previous_type = '';
    foreach($this->data['created_dates'] as $created_date) {

      if ($previous_type != '') {
        $this->data['total'][$created_date][$previous_type]['weight'] += $this->data['balance'][$previous_date][$previous_type]['weight'];
        $this->data['total'][$created_date][$previous_type]['fine'] += $this->data['balance'][$previous_date][$previous_type]['fine'];
      }
      
      if ($this->data['total'][$created_date]['receipt']['weight'] 
          >= $this->data['total'][$created_date]['issue']['weight'] && 
          $this->data['total'][$created_date]['receipt']['weight'] 
          >= $this->data['total'][$created_date]['stock']['weight']) {
        $this->data['balance'][$created_date]['receipt']['weight'] = 
                                                        $this->data['total'][$created_date]['receipt']['weight']
                                                        - ($this->data['total'][$created_date]['stock']['weight']
                                                           + $this->data['total'][$created_date]['issue']['weight']);
        $this->data['balance'][$created_date]['receipt']['fine'] = 
                                                        $this->data['total'][$created_date]['receipt']['fine']
                                                        - ($this->data['total'][$created_date]['stock']['fine']
                                                           + $this->data['total'][$created_date]['issue']['fine']);
        
        $type = 'receipt';
      } elseif ($this->data['total'][$created_date]['issue']['weight'] 
                >= $this->data['total'][$created_date]['receipt']['weight'] && 
                $this->data['total'][$created_date]['issue']['weight'] 
                >= $this->data['total'][$created_date]['stock']['weight']) {
        $this->data['balance'][$created_date]['issue']['weight'] = 
                                                        ($this->data['total'][$created_date]['issue']['weight']
                                                         + $this->data['total'][$created_date]['stock']['weight'])
                                                        - $this->data['total'][$created_date]['receipt']['weight'];
        $this->data['balance'][$created_date]['issue']['fine'] = 
                                                        ($this->data['total'][$created_date]['issue']['fine']
                                                         + $this->data['total'][$created_date]['stock']['fine'])
                                                        - $this->data['total'][$created_date]['receipt']['fine'];
        $type = 'issue';
      } else {
        $this->data['balance'][$created_date]['stock']['weight'] = 
                                                        ($this->data['total'][$created_date]['stock']['weight']
                                                         + $this->data['total'][$created_date]['issue']['weight'])
                                                        - $this->data['total'][$created_date]['receipt']['weight'];
        $this->data['balance'][$created_date]['stock']['fine'] = 
                                                        ($this->data['total'][$created_date]['stock']['fine']
                                                         + $this->data['total'][$created_date]['issue']['fine'])
                                                        - $this->data['total'][$created_date]['receipt']['fine'];
        $type = 'stock';
      }
      
      $previous_date = $created_date;
      $previous_type = $type;
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