<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Internal_wastage_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/internal_wastage_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/internal_wastage_ledgers/create');
  }

  public function _get_form_data() {
    $this->data['period']= (!empty($_GET['period'])) ? $_GET['period'] : 'date';
    $this->data['wastage']= (!empty($_GET['wastage'])) ? $_GET['wastage'] : '';
    $this->data['internal_wastages']=$this->internal_wastage_model->get();
    if(HOST=='ARF'){
     $query = $this->db->query($this->model->get_issue_department_records(ARF_DB_NAME,"AR Gold Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARF_DB_NAME,"ARC Software",$this->data['period'],$this->data['wastage']));
    }elseif(HOST=='ARC'){
     $query = $this->db->query($this->model->get_issue_department_records(ARC_DB_NAME,"AR Gold Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARC_DB_NAME,"ARF Software",$this->data['period'],$this->data['wastage']));
    }else{
     $query = $this->db->query($this->model->get_issue_department_records(ARGOLD_DB_NAME,"ARF Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARGOLD_DB_NAME,"ARC Software",$this->data['period'],$this->data['wastage']));
    }

    $issues = $query->result_array();
    foreach ($issues as $issue_index => $issue_value) {
      $issues[$issue_index]['issue_fine']=($issue_value['weight']*$issue_value['issue_melting'])/100;
      $issues[$issue_index]['vodator']=four_decimal($issue_value['fine']-$issues[$issue_index]['issue_fine']);
    }

    if(HOST=='ARF'){
     $query = $this->db->query($this->model->get_issue_department_records(ARGOLD_DB_NAME,"ARF Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARC_DB_NAME,"ARF Software",$this->data['period'],$this->data['wastage']));
    }elseif(HOST=='ARC'){
     $query = $this->db->query($this->model->get_issue_department_records(ARGOLD_DB_NAME,"ARC Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARF_DB_NAME,"ARC Software",$this->data['period'],$this->data['wastage']));
    }else{
     $query = $this->db->query($this->model->get_issue_department_records(ARF_DB_NAME,"AR Gold Software",$this->data['period'],$this->data['wastage'])." UNION ".$this->model->get_issue_department_records(ARC_DB_NAME,"AR Gold Software",$this->data['period'],$this->data['wastage']));
    }
    $receipts = $query->result_array();
    foreach ($receipts as $index => $value) {
      $receipts[$index]['issue_fine']=($value['weight']*$value['issue_melting'])/100;
      $receipts[$index]['vodator']=four_decimal($value['fine']-$receipts[$index]['issue_fine']);
    }

    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);

    if (!isset($_GET['do_no_remove_duplicate']))
      parent::remove_receipt_issue_matching_records();

    $this->data['total'] = array();
    parent::get_total_by_created_date($this->data['issues'], 'issue');
    parent::get_total_by_created_date($this->data['receipts'], 'receipt');
    parent::set_index_for_dates();
    parent::get_balance_by_created_date();
  }
}