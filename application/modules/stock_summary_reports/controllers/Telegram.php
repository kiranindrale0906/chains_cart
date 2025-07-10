<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/stock_summary_reports/controllers/Stock_summary_reports.php";

class Telegram extends Stock_summary_reports {
  protected $load_helper = false;
  public function __construct(){
    parent::__construct();
    $this->bot = new \TelegramBot\Api\BotApi('1387671982:AAGd_ke_dJoiZ_tkThtUlCrPUBTo2oNfjdc');
  }
  
  public function index() {
    if (empty($_GET['access_token']) || $_GET['access_token'] != API_ACCESS_TOKEN) {
      echo json_encode(array('status'      => 'error',
                             'open_modal'  => FALSE));
      die;
    }

    $type= isset($_GET['type']) ? $_GET['type'] : 'stock';
    $this->data['date'] = !empty($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $stock_summary_balance = parent::index();

    if($type=='rolling') $this->send_chain_rolling($stock_summary_balance);
    if($type=='stock')   $this->send_stock($stock_summary_balance);
  }

  private function send_chain_rolling($stock_summary_balance) {
    $chain_names = $this->get_chain_names();
    $message = date('d-m-Y',strtotime($this->data['date']))." - ".HOST;
    $this->send_chain_rolling_message($message);
    foreach ($chain_names as $chain_name) {
      $out_weight = $this->process_model->find('sum(gpc_out+repair_out) as out_weight',
                                                array('product_name'=>$chain_name,
                                                      '(`gpc_out` != 0 or repair_out != 0 )'=>null,
                                                      'process_name not in ("Refresh Final Process")' => NULL,
                                                      'lot_no not like "%RF%"' => NULL,
                                                      'date(completed_at)' => date('Y-m-d')));
      $balance_gross = $stock_summary_balance[str_replace(' ', '_', strtolower($chain_name))]['balance_gross'];
      $rolling = (!empty($out_weight)&&$out_weight['out_weight']!=0) ? four_decimal($out_weight['out_weight'] / $balance_gross) : four_decimal($balance_gross);
      
      if($out_weight['out_weight'] != 0) {
        $rolling_message  = $chain_name." : \nBalance : ".four_decimal($balance_gross)."\n";
        $rolling_message .= "GPC / Repair Out : ".four_decimal($out_weight['out_weight'])."\n";
        $rolling_message .= "Rolling : ".four_decimal($rolling);
        $this->send_chain_rolling_message($rolling_message);
      }
    }
  }

  private function send_chain_rolling_message($message) {
    $this->bot->sendMessage('712491427', $message);    //Atul: 712491427
    $this->bot->sendMessage('1056863449', $message);   //Nikhil Ranawat: 1056863449
  }

  private function send_stock($stock_summary_balance) {
    $stock_message = date('d-m-Y',strtotime($this->data['date']))." - ".HOST." - Stock\n";
    $stock_message .= "Balance : ".four_decimal($stock_summary_balance['total_stock_summary']['balance'])."\n";
    $stock_message .= "Balance Gross : ".four_decimal($stock_summary_balance['total_stock_summary']['balance_gross'])."\n";
    $stock_message .= "Balance Fine : ".four_decimal($stock_summary_balance['total_stock_summary']['balance_fine']);
    $this->send_stock_message($stock_message);
  }

  private function send_stock_message($message) {
    $this->bot->sendMessage('712491427', $message);   //Atul: 712491427
    $this->bot->sendMessage('1056863449', $message);  //Nikhil Ranawat: 1056863449
    $this->bot->sendMessage('1699299372', $message);  //Bheru Sankhla: 1699299372
  }

  private function get_chain_names() {
    if(HOST == 'AR Gold') return array('Choco Chain', 'Fancy Chain', 'Hollow Choco Chain', 'Imp Italy Chain', 'Indo tally Chain', 'Machine Chain', 'Rope Chain', 'Round Box Chain', 'Sisma Chain');
    if(HOST == 'ARF')     return array('KA Chain', 'Ball Chain', 'Fancy Chain', 'Nano Process');
    if(HOST == 'ARC')     return array('Chain 75', 'Kuwaitis', 'Ring', 'Ring 75', 'Pendant', 'Pendant 75', 'Lock Process', 'Casting RND');
  }
}