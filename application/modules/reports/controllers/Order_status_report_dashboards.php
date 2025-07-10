<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_status_report_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('arc_orders/order_model','arc_orders/generate_lot_model', 'processes/process_model'));
  }

  public function index() {
    $this->get_dashboard_counts();

    if(!empty($_GET['status'])){

      if($_GET['status'] == "In Process"){
        $this->get_order_status_details();
      }
      elseif ($_GET['status'] == "Pending") {
        $this->get_pending_order_details();
      }
      elseif ($_GET['status'] == "Dispatch") {
        $this->get_dispatch_order_details();
      }elseif ($_GET['status'] == "ALL") {
        $this->get_before_pending_order_details();
      }
    }
    $this->data['status'] = isset($_GET['status']) ? $_GET['status'] : ""; 
    $this->load->render('reports/order_status_report_dashboards/index', $this->data);
  }

  private function get_dashboard_counts(){
    $this->data["dashboard_counts"] = $this->generate_lot_model->find('SUM(CASE WHEN status <> "Dispatch" and status <> "In Process" THEN 1 ELSE 0 END) AS "Pending", SUM(CASE WHEN status = "In Process" THEN 1 ELSE 0 END) AS "In Process", SUM(CASE WHEN status = "Dispatch" THEN 1 ELSE 0 END) AS "Dispatch",SUM(CASE WHEN status = "" THEN 1 ELSE 0 END) AS "Before Pending"');
  }

  private function get_order_status_details(){

    // $this->data['customer_list'] = $this->order_model->get("customer_name as id, customer_name as name",array(),array(),array("group_by"=>"customer_name"));

    // $this->data['next_process_list'] = array(array('name' => 'ARC Chain', 'id' => 'ARC Chain'),
    //                                       array('name' => 'ARC Ornament', 'id' =>'ARC Ornament'),
    //                                       array('name' => 'ARC Turkey', 'id' =>'ARC Turkey'),
    //                                       array('name' => 'ARC Para', 'id' =>'ARC Para'),
    //                                       array('name' => 'ARC RND', 'id' =>'ARC RND'),
    //                                       array('name' => 'ARC Lock', 'id' =>'ARC Lock'),
    //                                       array('name' => 'ARC Fancy', 'id' =>'ARC Fancy')
    //                                     );

    //   $this->data['record']['customer_name'] = ($_GET['customer_name']) ?? "";
    //   $this->data['record']['from_date'] = ($_GET['from_date']) ?? "";
    //   $this->data['record']['to_date'] = ($_GET['to_date']) ?? "";
    //   $this->data['record']['next_process'] = ($_GET['next_process']) ?? "";
    //   $where = array();

    //   if($this->data['record']['customer_name'] != ""){

    //     $where['customer_name'] = $this->data['record']['customer_name'];
    //   }

    //   if($this->data['record']['next_process'] != ""){

    //     $where['next_process'] = $this->data['record']['next_process'];
    //   }

    //   if($this->data['record']['from_date'] != "" && $this->data['record']['to_date'] != ""){
    //     $where['order_date >='] = date('Y-m-d', strtotime($this->data['record']['from_date']));
    //     $where['order_date <='] = date('Y-m-d', strtotime($this->data['record']['to_date']));
    //   }
    //   else if($this->data['record']['from_date'] != ""){
    //     $where['order_date'] = date('Y-m-d', strtotime($this->data['record']['from_date']));
    //   }
    //   else if($this->data['record']['to_date'] != ""){
    //     $where['order_date'] = date('Y-m-d', strtotime($this->data['record']['to_date']));
    //   }
    //   else{
    //     $filter_date = date('Y-m-d', strtotime('today - 30 days'));
    //     $where['order_date >='] = $filter_date;
    //   }

      // $results = $this->order_model->get('DISTINCT(`arc_orders`.`order_no`) AS `sales_order_no`,`arc_orders`.`customer_name`,`arc_orders`.`quantity`, arc_orders.id AS order_id, DATE(arc_orders.order_date) AS created_at,  arc_orders.purity as in_lot_purity, arc_orders.weight as in_weight, arc_orders.order_status, arc_orders.id as arc_order_id, next_process as product_name',
      //                                   $where,
      //                                   array(array("arc_order_details","arc_order_details.order_id = arc_orders.id", "LEFT")),
      //                                   array('order_by' => 'arc_orders.order_date desc', 'group_by' => 'arc_orders.order_no')
      //                                 );

    //   $this->data['order_status_records'] = array();
    //   foreach ($results as $index => $result) {

    //       $generate_lot_results = $this->generate_lot_model->get('lot_no as generate_lot_no, investment_date,
    //                                                            generate_lot_details.order_id,process_name, generate_lots.status as generate_lot_status, lot_weight as g_lot_weight, lot_qty as g_lot_qty',
    //                                                         array("generate_lot_details.order_id"=>$result["arc_order_id"], "generate_lots.status" => "In Process"),
    //                                                         array(array('generate_lot_details','generate_lots.id=generate_lot_details.`generate_lot_id`','LEFT')),
    //                                                         array("group_by"=>"generate_lot_no"));

    //       if(!empty($generate_lot_results)){
    //         foreach ($generate_lot_results as $index => $generate_lot_result) {
    //           $result['generate_lot_no'] = isset($generate_lot_result['generate_lot_no']) ? $generate_lot_result['generate_lot_no']: "";
    //           $result['investment_date'] = isset($generate_lot_result['investment_date']) ? $generate_lot_result['investment_date'] : "";
    //           $result['generate_lot_process'] = isset($generate_lot_result['process_name']) ? $generate_lot_result['process_name'] : "";
    //           $result['generate_lot_status'] = isset($generate_lot_result['generate_lot_status']) ? $generate_lot_result['generate_lot_status'] : "";
    //           $result['generate_lot_weight'] = isset($generate_lot_result['g_lot_weight']) ? $generate_lot_result['g_lot_weight'] : "";
    //           $result['generate_lot_quantity'] = isset($generate_lot_result['g_lot_qty']) ? $generate_lot_result['g_lot_qty'] : "";

    //           $result['department_name'] = "";
    //           $result['process_name'] = "";
    //           if($result['generate_lot_no']!=""){

    //             $process_id_results = $this->process_model->find("MAX(id) as processes_id",
    //                                                     array("melting_lot_id != "=> 0, "account"=>$result['generate_lot_no']),
    //                                                     array(),
    //                                                     array("group_by"=>"lot_no"));
    //             $process_details = $this->process_model->find("product_name, department_name, lot_no",
    //                                                   array("id"=>$process_id_results['processes_id']));

    //             $result['department_name'] = $process_details["department_name"];
    //             // $result['product_name'] = $process_details["product_name"];
    //             $result['lot_no'] = $process_details["lot_no"];
    //           }

    //           $this->data['order_status_records'][$result['created_at']][] = $result;
    //         }
    //       }
    //       else {
    //         $result['generate_lot_no'] = "";
    //         $result['investment_date'] = "";
    //         $result['generate_lot_process'] = "";
    //         $result['generate_lot_status'] = "";
    //         $result['department_name'] = "";
    //         // $result['product_name'] = "";
    //         $result['lot_no'] = "";
    //         $result['generate_lot_weight'] = "";
    //         $result['generate_lot_quantity'] = "";
    //         $this->data['order_status_records'][$result['created_at']][] = $result;
    //       }
    //   }

    // SELECT generate_lots.lot_no AS  generate_lot, processes.customer_name, generate_lots.purity, generate_lots.order_weight, processes.lot_no AS melting_lot, processes.process_name, processes.department_name, generate_lots.status FROM processes LEFT JOIN generate_lots ON generate_lots.lot_no = processes.account WHERE generate_lots.status="In Process" GROUP BY generate_lots.lot_no

    $this->data['order_status_records'] = $this->process_model->get('generate_lots.lot_no AS  generate_lot, generate_lots.customer_name, generate_lots.purity, generate_lots.lot_weight as in_weight, processes.lot_no AS melting_lot, processes.process_name, processes.department_name, generate_lots.status', 
                                            array("generate_lots.status"=>"In Process"),
                                            array(
                                              array("generate_lots", "generate_lots.lot_no = processes.account", "LEFT")
                                            ),
                                            array('group_by'=>"generate_lots.lot_no")
                                          );
  }

  private function get_pending_order_details(){

    $this->data['pending_orders'] = $this->generate_lot_model->get("order_no, lot_no, customer_name, purity, lot_weight, order_date, due_date, process_name, status, remark", 
                                      array("status NOT IN ('Dispatch','In Process')" => NULL));
  }

  private function get_dispatch_order_details(){
    $this->data['pending_orders'] = $this->generate_lot_model->get("order_no, lot_no, customer_name, purity, lot_weight, order_date, due_date, process_name, status, remark", 
                                      array("status" => "Dispatch")); 
  }
  private function get_before_pending_order_details(){
    $this->data['pending_orders'] = $this->generate_lot_model->get("order_no, lot_no, customer_name, purity, lot_weight, order_date, due_date, process_name, status, remark", 
                                      array("status" => "")); 
  }
}
