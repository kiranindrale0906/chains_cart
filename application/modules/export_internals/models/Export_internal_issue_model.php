<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Export_internal_issue_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'export_internal_issues';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Export Internal';
    $this->attributes['process_name'] = 'Export Internal Issue';
    $this->attributes['chain_name'] = 'Export Internal';
    $this->department_not_deleted=array('Start');
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['department_name'] = 'Start';
    $this->attributes['melting_lot_id'] = rand();
    $this->attributes['row_id'] = rand();
    $this->attributes['out_weight'] = $this->attributes['in_weight'];
    $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
    parent::before_validate();
  }

  public function after_save($action = true) {
    $this->attributes['lot_no'] = 'EII-'.$this->attributes['id'];
    $this->update(false);

    $this->send_request_to_argold_accounts($this->attributes);
    parent::after_save($action);
  }

  public function send_request_to_argold_accounts($data) {
    $send_data=array();
    $api_url="";
    $receipt_type = HOST.' Internal ISSUE';
    $account_name = HOST.' Internal Software';
      
    $send_data['metal_issue_vouchers']=array('company_id'     => 1,
                                             'voucher_date'   => date('Y-m-d'),
                                             'receipt_type'   => $receipt_type,
                                             'account_name'   => $account_name,
                                             'credit_weight'  => $data['in_weight'],
                                             'purity'         => $data['in_lot_purity'],
                                             'factory_purity' => $data['in_lot_purity'],
                                             'fine'           => $data['in_weight'] * $data['in_lot_purity']/100,
                                             'factory_fine'   => $data['in_weight'] * $data['in_lot_purity']/100,
                                             'narration'      => 'Export Internal Issue',
                                             'argold_id'      => $data['id']);
    $api_url=API_BASE_PATH."api/api_metal_issue_vouchers/store";   
    if(!empty($api_url)) {
      $result=curl_post_request($api_url, $send_data);
    }
      
      $send_data['metal_receipt_vouchers']=array('company_id' => 1,
                                                 'account_name' => $data['account'],
                                                 'voucher_date' => date('Y-m-d'),
                                                 'receipt_type' => $receipt_type,
                                                 'debit_weight' => $data['in_weight'],
                                                 'purity' => $data['in_lot_purity'],
                                                 'fine' => $data['in_weight'] * $data['in_lot_purity']/100,
                                                 'factory_purity' => $data['in_lot_purity'],
                                                 'factory_fine' => $data['in_weight'] * $data['in_lot_purity']/100,
                                                 'narration' => 'Export Internal Issue',
                                                 'argold_id' => $data['id']);
      $api_url=API_BASE_PATH."api/api_metal_receipt_vouchers/store";   
      if(!empty($api_url)) {
        $result=curl_post_request($api_url, $send_data);
    }
  }
}