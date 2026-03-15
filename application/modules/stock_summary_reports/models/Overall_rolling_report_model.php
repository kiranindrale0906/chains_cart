<?php 
class Overall_rolling_report_model extends BaseModel{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
    $this->load->model(array('issue_and_receipts/internal_ledger_model'));
  }

  public function validation_rules($klass='', $index=0){
    $validation_rules='';
    return $validation_rules; 
  }

  public function get_total_balance_from_argold_ledger(){
    $issues   = $this->internal_ledger_model->get_issue_records();
    $receipts = $this->internal_ledger_model->get_receipt_records();
    

    $sum_receipts= 0;
    foreach ($receipts as $receipt)
      $sum_receipts += $receipt['weight'];
  
    $sum_issues = 0;
    foreach ($issues as $issue) 
      $sum_issues += $issue['weight'];
  
    return $sum_issues-$sum_receipts;
  }
}