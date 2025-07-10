<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Out_weight_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/out_weight_category_model', 'issue_departments/issue_department_model'));
  }

  public function index() { 
		$this->get_out_weight();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/out_weight_reports/index', $this->data);    
  } 

  public function create() {
    $this->get_out_weight();
    $this->send_sms($this->data['records']);
  }

  private function get_out_weight(){
    $this->data['date']=!empty($_GET['date'])?date('d M Y',strtotime($_GET['date'])):date('d M Y');
    $out_weight_categories = $this->out_weight_category_model->get('name,
                                                                          GROUP_CONCAT(QUOTE(department_name)) as department_name',
                                                                          array(),array(),
                                                                          array('group_by'=>'name'));

    foreach ($out_weight_categories as $index => $category) {
      $department_name=explode(',', $category['department_name']);
      $this->data['records'][$category['name']] = $this->process_model->find('round(sum(out_weight), 4) as out_weight,
                                                                              sum(out_weight * out_purity / 100) as out_weight_gross,
                                                                              sum(out_weight * out_purity / 100 * out_lot_purity / 100) as out_weight_fine',
                                                                              array('where' => array('DATE(completed_at)' => date('Y-m-d',strtotime($this->data['date']))),
                                                                                    'where_in' => array('department_name'=>$department_name)));
    }
    $this->data['records']['GPC ISSUE'] = $this->issue_department_model->find('round(sum(in_weight), 4) as out_weight,
                                                                               sum(in_weight) as out_weight_gross,
                                                                               sum(in_weight * in_purity / 100) as out_weight_fine',
                                                                               array('DATE(created_at)' => date('Y-m-d',strtotime($this->data['date'])),
                                                                                     'product_name' => 'GPC Out'));
  }

  private function send_sms($records) {
    // Account details
    $apiKey = urlencode(TEXTLOCAL_SMS_APIKEY);

    // Message details
    $numbers = array(919892680959);
    $sender = urlencode('TXTLCL');
    $message = array();
    foreach ($records as $category_name => $value_array) 
      $message[] = $category_name.' : '.(empty($value_array['out_weight']) ? 0 : $value_array['out_weight']);
    $message = $this->data['date'].' '.implode(', ', $message);    
    $numbers = implode(',', $numbers);

    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process your response here
    echo $response;
  }

}
