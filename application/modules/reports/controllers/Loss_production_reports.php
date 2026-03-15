<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loss_production_reports extends BaseController {
  public function __construct(){
    parent::__construct();

    $this->load->model(array('processes/process_model', 'settings/same_karigar_model'));
    }
  
  public function index() {
    $this->data['departments']  = $this->process_model->get('distinct(department_name) as name,department_name as id');
    $this->data['product_names']  = $this->process_model->get('distinct(product_name) as name,product_name as id');
    $this->data['purity']  = $this->process_model->get('distinct(in_lot_purity) as name,in_lot_purity as id');
    $this->data['karigars']  = $this->same_karigar_model->get('distinct(karigar_name) as name,karigar_name as id');
      if(!empty($_GET['loss_production_reports'])){
        $this->data['record']=$_GET['loss_production_reports'];
        $department_name = $this->data['record']['department_name'];
        $product_name = $this->data['record']['product_name'];
        if (!empty($product_name)) {
          $this->data['departments']  = $this->process_model->get('distinct(department_name) as name,department_name as id',array('product_name'=>$product_name));
          $this->get_loss_production_details();
        }
      }
      $this->load->render('reports/loss_production_reports/index', $this->data);
    }
  
  private function get_loss_production_details() {
    $this->get_process_reports();
    return $this->data;
  }
  private function get_process_reports() {
    $where_check=array();
    $where=array();
    if(!empty($this->data['record']['department_name'])) $where['processes.department_name'] = $this->data['record']['department_name'];
    if(!empty($this->data['record']['product_name'])) $where['processes.product_name'] = $this->data['record']['product_name'];
     if(!empty($this->data['record']['in_lot_purity'])) $where['processes.in_lot_purity'] = $this->data['record']['in_lot_purity'];
    if(!empty($this->data['record']['karigar_name'])) $where['processes.karigar'] = $this->data['record']['karigar_name'];
    if(!empty($this->data['record']['from_date']))       $where['date(processes.completed_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))         $where['date(processes.completed_at) <='] = date('Y-m-d',strtotime($this->data['record']['to_date']));
    
   $datewise_outweight = $this->process_model->get('date(completed_at) as completed_at,id,
                                                      sum(in_weight) as in_weight,
                                                      sum(balance_fine) as balance_fine,sum(out_weight) as out_weight,
                                                      sum(pending_ghiss+ghiss) as ghiss,
                                                      sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage,
                                                      sum(loss + karigar_loss + pending_loss) as loss,
                                                      sum((loss + karigar_loss + pending_loss) * wastage_purity/100) as loss_gross,
                                                      sum((loss + karigar_loss + pending_loss) * wastage_purity/100 * wastage_lot_purity/100) as loss_fine',$where,
                                                      array(),array('group_by'=>'date(completed_at)','order_by'=>'date(completed_at)'));
    $this->data['process_outweights'] = $datewise_outweight;
    }
}