<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Metal_issue_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'metal_issues';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->attributes['product_name'] = 'Metal Issue';
    $this->attributes['process_name'] = 'Issue';
    $this->attributes['chain_name'] = 'Issue';
    $this->department_not_deleted=array('Start');
    $this->load->model(array('processes/Process_field_model', 'receipt_departments/receipt_department_model'));
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
  public function after_save($action) {
    $metal_receipt = array('process_sequence' => 0,
                                  'department_name' => 'Start',
                                  'process_name' => $this->attributes['type'],
                                  'type' => $this->attributes['type'],
                                  'account' => $this->attributes['account'],
                                  'in_weight' => $this->attributes['in_weight'],
                                  'melting_wastage' => $this->attributes['in_weight'],
                                  'balance_melting_wastage' => $this->attributes['in_weight'],
                                  'row_id' => rand(),
                                  'in_lot_purity' => $this->attributes['in_lot_purity'],
                                  'hook_kdm_purity' => $this->attributes['hook_kdm_purity']); 
    $metal_receipt_obj = new receipt_department_model($metal_receipt);
    $metal_receipt_obj->save(true);
    $this->send_request_to_argold_accounts($this->attributes);
  }
  public function send_request_to_argold_accounts($data) {
    $send_data=array();
    $api_url="";
    $receipt_type = HOST.' Internal Receipt';
      
    $send_data['metal_issue_vouchers']=array('company_id'     => 1,
                                             'voucher_date'   => date('Y-m-d'),
                                             'receipt_type'   => $receipt_type,
                                             'account_name'   => $data['account'],
                                             'credit_weight'  => $data['in_weight'],
                                             'purity'         => $data['in_lot_purity'],
                                             'factory_purity' => $data['in_lot_purity'],
                                             'fine'           => $data['in_weight'] * $data['in_lot_purity']/100,
                                             'factory_fine'   => $data['in_weight'] * $data['in_lot_purity']/100,
                                             'narration'      => $data['type'],
                                             'site_name' => HOST.' '.HOSTVERSION,
                                             'argold_id'      => $data['id']);
    $api_url=API_BASE_PATH."api/api_metal_issue_vouchers/store"; 
    if(!empty($api_url)) {
      $result=curl_post_request($api_url, $send_data);
    }

    $account_name = HOST;
    $send_data_receipt['metal_receipt_vouchers']=array('company_id' => 1,
                                               'account_name' => $account_name,
                                               'voucher_date' => date('Y-m-d'),
                                               'receipt_type' => $receipt_type,
                                               'debit_weight' => $data['in_weight'],
                                               'purity' => $data['in_lot_purity'],
                                               'fine' => $data['in_weight'] * $data['in_lot_purity']/100,
                                               'factory_purity' => $data['in_lot_purity'],
                                               'factory_fine' => $data['in_weight'] * $data['in_lot_purity']/100,
                                               'narration' => $data['type'],
                                               'site_name' => HOST.' '.HOSTVERSION,
                                               'argold_id' => $data['id']);
    $api_url_receipt=API_BASE_PATH."api/api_metal_receipt_vouchers/store"; 
    if(!empty($api_url_receipt)) {
      $result=curl_post_request($api_url_receipt, $send_data_receipt);
    }
  }
}