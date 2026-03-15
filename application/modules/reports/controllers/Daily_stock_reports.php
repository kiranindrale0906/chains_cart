<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_stock_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/monthly_target_model', 'reports/daily_change_rolling_balance_report_model'));
  }

  public function index() { 
    $this->get_daily_stock_reports_details();
    $this->load->render('reports/daily_stock_reports/form', $this->data);
  }

  public function store(){
    $this->get_daily_stock_reports_details();
    $this->load->render('reports/daily_stock_reports/form', $this->data);
  }

  private function get_daily_stock_reports_details(){

    // $this->data['month_lists'] = array(
    //                               array("id" => "01", "name" => "JAN"),
    //                               array("id" => "02", "name" => "FEB"),
    //                               array("id" => "03", "name" => "MAR"),
    //                               array("id" => "04", "name" => "APR"),
    //                               array("id" => "05", "name" => "MAY"),
    //                               array("id" => "06", "name" => "JUN"),
    //                               array("id" => "07", "name" => "JUL"),
    //                               array("id" => "08", "name" => "AUG"),
    //                               array("id" => "09", "name" => "SEP"),
    //                               array("id" => "10", "name" => "OCT"),
    //                               array("id" => "11", "name" => "NOV"),
    //                               array("id" => "12", "name" => "DEC")
    //                             );

    // $this->data['year_list'] = array(
    //                             array("id" => "2023", "name" => "2023"),
    //                             array("id" => "2024", "name" => "2024")
    //                           );

    $this->data["product_lists"] = array("Arc Chain", "Arc Ornament", "Arc Turkey", "Arc Para", "Lock Process", "Arc Rnd Chain");
    $this->data["process_lists"] = array("Buffing Process", "Buffing Refresh Process", "Buffing Refresh RND Process ", "Buffing RND Process", "Casting", "Daily Drawer Issue", "Daily Drawer Wastage", "Electropolish Process", "Factory Hold Process", "Factory Hold RND Process", "Factory To Karigar", "Filing II Process", "Filing Process", "Filing RND Process", "Finish Good Process", "GPC Powder", "GPC Process", "Grinding Process", "Hallmark Receipt", "Hallmarking Process", "Hand Cutting Process", "Hand Dull Process", "Hook", "Internal Final Process", "Karigar To Factory", "KDM", "Lock Buffing Process", "Lock Filing Process", "LOSS", "Loss Receipt", "Magnet Process", "Magnet RND Process", "Meena Filing Process", "Meena Process", "Melting", "Packing Process", "Pasta Process", "Pending Ghiss Out", "Pre Polish Process", "Pre Polish RND Process", "Receipt", "Refiling II Process", "Refiling Process", "Refiling RND Process", "Refresh Hold", "RND Receipt", "Stone Receipt", "Stone Setting Process", "Wastage Ghiss", "Wastage Pending Ghiss");
    $this->data["monthly_target_fields"] = array("TARGET PRODUCTION", "TARGET ROLLING", "TARGET GROSS STOCK", "DAILY PRODUCTION");

    $where = array("balance > "=> 0,
                    "product_name"=>$this->data["product_lists"],
                    "process_name"=>$this->data["process_lists"]
                  );

    // if(!empty($_POST)){
    //   $month = $_POST["daily_stock_reports"]["month"];
    //   $year = $_POST["daily_stock_reports"]["year"];
    //   $this->data['month'] = $month;
    //   $this->data['year'] = $year;

    //   if($month != "" && $year != ""){
    //     $where['created_at >= '] = date($year."-".$month."-01");
    //     $where['created_at <= '] = date($year."-".$month."-".date(t));
    //   }
    //   else if($month !="") {
    //     $where['created_at >= '] = date(date("Y")."-".$month."-01");
    //     $where['created_at <= '] = date(date("Y")."-".$month."-".date(t));
    //   }
    //   else if($year !="") {
    //     $where['created_at >= '] = date($year."-".date('m')."-01");
    //     $where['created_at <= '] = date($year."-".date('m')."-".date(t));
    //   }
    // }
    // else {
    //   $this->data['month'] = date("m");
    //   $this->data['year'] = date("Y");

    //   $where['created_at >= '] = date(date("Y")."-".date('m')."-01");
    //   $where['created_at <= '] = date(date("Y")."-".date('m')."-".date(t));
    // }

    $results = $this->process_model->get("balance, product_name, process_name, gpc_out",
                                          $where);
    $balance_data = array();

    foreach ($results as $index => $result) {
      if(isset($balance_data[$result["process_name"]][$result["product_name"]])){
        $balance_data[$result["process_name"]][$result["product_name"]] += $result["balance"];
      }
      else {

        $balance_data[$result["process_name"]][$result["product_name"]] = $result["balance"];
      }

      // process total
        if(isset($balance_data[$result["process_name"]."_process_total"])){
          $balance_data[$result["process_name"]."_process_total"] += $result["balance"];
        }
        else {
          $balance_data[$result["process_name"]."_process_total"] = $result["balance"];
        }

      //product total
        if(isset($balance_data[$result["product_name"]."_product_total"])){
          $balance_data[$result["product_name"]."_product_total"] += $result["balance"];
        }
        else {
          $balance_data[$result["product_name"]."_product_total"] = $result["balance"];
        }

      //gpc out total
        // if(isset($balance_data[$result["product_name"]."_gpc_out"])){
        //   $balance_data[$result["product_name"]."_gpc_out"] += $result["gpc_out"];
        // }
        // else {
        //   $balance_data[$result["product_name"]."_gpc_out"] = $result["gpc_out"];
        // }
    }

    $daily_rolling_balances = $this->daily_change_rolling_balance_report_model->get("product_name, sum(gpc_out) as gpc_out",
                                        array("balance_gross >" => 0, 'product_name' => $this->data["product_lists"]),
                                        array(),
                                        array('group_by'=>'product_name')
                                      );

    foreach ($daily_rolling_balances as $index => $daily_rolling_balance) {
      $balance_data[$daily_rolling_balance['product_name']."_gpc_out"] = $daily_rolling_balance['gpc_out'];
    }

    $this->data["balance_data"] = $balance_data;

    //monthly target data
      $m_where = array("month" => date('M'), "year" => date('Y'));
      // if($this->data['month'] != ""){
      //   $month_key = $this->data['month'] - 1;
      //   $m_where['month'] = $this->data['month_lists'][$month_key]['name'];
      // }

      // if($this->data['year'] != ""){
      //   $m_where['year'] = $this->data['year'];
      // }

      $m_results = $this->monthly_target_model->get("", $m_where);

      $monthly_target_data = array();

      foreach ($m_results as $index => $m_result) {
        $monthly_target_data[$m_result['product_name']] = $m_result;
      }

      $this->data['monthly_target_data'] = $monthly_target_data;
  }
}