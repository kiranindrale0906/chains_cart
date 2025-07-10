<?php
include_once APPPATH . "modules/processes/models/Process_model.php";
class Daily_drawer_issue_department_model extends Process_model {
  protected $next_process_model = '';
  
  public $router_class = 'daily_drawer_issue_departments';
  public $departments = array('Start');
  
  public function __construct($data = array()) {
    parent::__construct($data);
    $this->load->model(array('processes/Process_field_model', 'daily_drawers/Daily_drawer_receipt_model','internals/Internal_receipt_model'));
    $this->attributes['product_name'] = 'Issue';
    $this->attributes['process_name'] = 'Daily Drawer Issue';
    $this->attributes['chain_name'] = 'Office Outside';
    $this->attributes['karigar'] = 'Factory';
  }

  public function before_validate() {
    $this->attributes['process_sequence'] = 0;
    $this->attributes['melting_lot_id'] = rand();
    $this->attributes['department_name'] = 'Start';
    $this->attributes['hook_kdm_purity'] = $this->attributes['in_lot_purity'];
    $this->attributes['daily_drawer_out_weight'] = $this->attributes['in_weight'];
    $this->attributes['row_id'] = rand();
    parent::before_validate();
  }

  // public function calculate_hook_kdm_purity() {
  //   if($this->attributes['in_lot_purity'] < 80)
  //     $this->attributes['hook_kdm_purity']=75.15;
  //   elseif($this->attributes['in_lot_purity'] >= 80 && $this->attributes['in_lot_purity'] < 88)
  //     $this->attributes['hook_kdm_purity']=83.65;
  //   else 
  //     $this->attributes['hook_kdm_purity']=92.00;
  // }

  public function after_save($action) {
    $this->attributes['lot_no'] = 'DDI-'.$this->attributes['id'];
    $this->update(false);

    $record = array('process_id' => $this->attributes['id'],
                   'daily_drawer_out_weight' => $this->attributes['daily_drawer_out_weight'],
                   'daily_drawer_type' => $this->attributes['type'],
                   'hook_kdm_purity' => $this->attributes['hook_kdm_purity'],
                   'karigar' => $this->attributes['karigar'],
                   'chain_name' => $this->attributes['chain_name']); 
    $process_obj = new Process_field_model($record);
    $process_obj->save(false);

    $daily_drawer_receipt = array('process_sequence' => 0,
                                  'department_name' => 'Start',
                                  'process_name' => $this->get_process_name_from_account_name(),
                                  'type' => $this->get_process_name_from_account_name(),
                                  // 'description' => $this->get_process_name_from_account_name(),
                                  // 'account' => HOST,
                                  'in_weight' => $this->attributes['in_weight'],
                                  'daily_drawer_in_weight' => $this->attributes['in_weight'],
                                  'row_id' => rand(),
                                  'parent_id' => $this->attributes['id'],
                                  'in_lot_purity' => $this->attributes['in_lot_purity'],
                                  'hook_kdm_purity' => $this->attributes['hook_kdm_purity']); 
    $daily_drawer_receipt_obj = new Daily_drawer_receipt_model($daily_drawer_receipt);
    $daily_drawer_receipt_obj->attributes['karigar'] = $this->formdata['karigar'];
    $daily_drawer_receipt_obj->save(true);
    if(in_array($this->formdata['karigar'], array("ARF Software ".HOSTVERSION, 
                                                  "ARC Software ".HOSTVERSION, 
                                                  "AR Gold Software ".HOSTVERSION))){
      $this->send_request_to_argold_accounts($this->attributes,$this->formdata['karigar']);
    }
  }
  public function send_request_to_argold_accounts($data,$karigar) {
    $send_data=array();
    $api_url="";
    $receipt_type = HOST.' Internal Receipt';
      
    $send_data['metal_issue_vouchers']=array('company_id'     => 1,
                                             'voucher_date'   => date('Y-m-d'),
                                             'receipt_type'   => $receipt_type,
                                             'account_name'   => $karigar,
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

  protected function get_process_name_from_account_name() {
    // if ($this->attributes['account'] == 'Sisma Chain')
    //   $process_name = 'Sisma Accessories';
    // elseif ($this->attributes['account'] == 'ARF') 
    //   $process_name = 'Caping Accessories';
    // else 
      $process_name = $this->attributes['type'];

    return $process_name;
  }

  public function after_delete($id, $conditions = array()) {
    $process_detail_record = $this->Process_field_model->find('', array('process_id' => $id));
    $process_detail_obj = new Process_field_model($process_detail_record);
    $process_detail_obj->delete($process_detail_record['id'], array(), TRUE, FALSE);
  }
}
