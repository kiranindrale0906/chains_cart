<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Worker_wise_karigar_calculations extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'settings/same_karigar_model','settings/chain_purity_model', 'settings/karigar_model',
                             'settings/karigar_rate_worker_detail_model','processes/process_detail_model'));
  }

  public function index() { 
    $data['layout']       = 'application';
    $data['products']     = $this->same_karigar_model->get_product_dropdown();
    $data['departments']     = $this->same_karigar_model->get('distinct(department_name) as id,department_name as name');
    // $data['departments']  = array();
    $data['karigar_list'] = array();
    $group_by = array();

    $karigars = array();
    //$product_name    = !empty($_GET['karigar_calculations']['product_name'])    ? $_GET['karigar_calculations']['product_name'] : '';
    $department_name = !empty($_GET['worker_wise_karigar_calculations']['department_name']) ? $_GET['worker_wise_karigar_calculations']['department_name'] : '';
    $karigar_name    = !empty($_GET['worker_wise_karigar_calculations']['karigar_name'])    ? $_GET['worker_wise_karigar_calculations']['karigar_name'] : '';
    $in_lot_purity    = !empty($_GET['worker_wise_karigar_calculations']['in_lot_purity'])    ? $_GET['worker_wise_karigar_calculations']['in_lot_purity'] : '';

    if(!empty($_GET['worker_wise_karigar_calculations']['from_date'])) {
      $data['record']['from_date'] = $_GET['worker_wise_karigar_calculations']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['worker_wise_karigar_calculations']['from_date']));
    }

    if(!empty($_GET['worker_wise_karigar_calculations']['to_date'])) {
      $data['record']['to_date'] = $_GET['worker_wise_karigar_calculations']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['worker_wise_karigar_calculations']['to_date']));
    }
    $this->data['record']['department_name'] = $department_name;
    $data['record']['karigar_name'] = '';
    if(!empty($karigar_name)) $data['record']['karigar_name'] = $karigar_name;
    if(!empty($in_lot_purity)) $data['record']['in_lot_purity'] = $in_lot_purity;
    $where = '';
    $where_condition =array();
    if(empty($from_date)){
      $where .= ' date(processes.completed_at) >='.'"2020-01-01"';
    }else{
      $where .=  ' date(processes.completed_at) >="'.$from_date.'"';
      $where_condition['date(processes.completed_at) >='] = $from_date; 
    }
    if(empty($to_date)){
      $where .= ' AND date(processes.completed_at) <='.'"2030-01-01"';
    }else{
      $where .=   ' AND date(processes.completed_at )<="'.$to_date.'"';
      $where_condition['date(processes.completed_at) <='] = $to_date; 
    }
    $data['record']['department_name'] = $department_name;
    $data['record']['type'] = $department_name;

    $data['record']['type'] = 
                    !empty($_GET['worker_wise_karigar_calculations']['type'])?
                    $_GET['worker_wise_karigar_calculations']['type']:"";
    if(!empty($_GET['worker_wise_karigar_calculations']['type']) && 
        $_GET['worker_wise_karigar_calculations']['type'] == 'ghiss'){
      $where .= ' and  processes.ghiss > 0';
      $where_condition['processes.ghiss >'] = 0; 
    }else if(!empty($_GET['worker_wise_karigar_calculations']['type']) && 
        $_GET['worker_wise_karigar_calculations']['type'] == 'hook_in'){
      $where .= ' and processes.hook_in > 0';
      $where_condition['processes.hook_in >'] = 0; 
    }
    
    if(!empty($department_name)){
      if(!is_array($department_name)){
        $department=array($department_name);
      }else{
        $department=$department_name;
      }
      $where .=' AND processes.department_name IN("'.implode(",",$department).'")';
      $where_condition['processes.department_name'] = $department;
    } 
    
    if (!empty($karigar_name)){
      $where .= ' AND processes.karigar ="'.$karigar_name.'"';
      $where_condition['processes.karigar'] = $karigar_name;

    }
    if (!empty($in_lot_purity)){
      $where .= ' AND processes.in_lot_purity ='.$in_lot_purity;
      $where_condition['processes.in_lot_purity'] = $in_lot_purity;

    }
      $order_by = 'date(completed_at) asc'; 
      $set_where = array('union_where'=>$where,'where'=>$where_condition);  
      $process_ids = $this->process_model->get('DISTINCT(processes.id) as id',
                                                  $where_condition,
                                                  array(array('process_details',
                                                'process_details.process_id = processes.id')),$order_by);

      $ids = array_column($process_ids, 'id');
      if (!empty($karigar_name)){
        $karigars = $this->model->get_karigar_data($ids,$set_where);
      }
    //$data['karigar_list'] = get_karigars();
    $this->data['karigar_list'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));

    $data['in_lot_purity'] = $this->chain_purity_model->get('lot_purity as name, lot_purity as id', array(), array(), array('group_by' => 'lot_purity'));
    $data['karigar_list'] = array_merge($this->data['karigar_list'], get_account_name());
    //$this->model->
    //$data['karigar_list'] = //$this->model->get('distinct(karigar_name) as id, karigar_name as name',array('department_name' => $department_name)/*, 
                                               // array('product_name' => $product_name)*/);
    // }

    if(!empty($department_name) && !empty($karigar_name)) {
      $data['record']['department_name'] = $department_name;
      $karigar_rates = $this->model->get('', array(/*'product_name' => $product_name, */
                                                   'department_name' => $department_name,
                                                   'karigar_name' => $karigar_name));
    } else if(!empty($department_name)) {
      $data['record']['department_name'] = $department_name;
      $karigar_rates = $this->model->get('', array(/*'product_name' => $product_name,*/ 'department_name' => $department_name));
    
    } else if(!empty($karigar_name)) {
      $data['record']['karigar_name'] = $karigar_name;
      $karigar_rates = $this->model->get('', array(/*'product_name' => $product_name,*/ 
                                                   'karigar_name' => $karigar_name));
    } else {
      $karigar_rates = $this->model->get('' /*array('product_name' => $product_name)*/); 
    }
    
    $calculations = array();
    $design_code=array_unique(array_column($karigar_rates, 'design_code'));
    foreach ($karigar_rates as $karigar_rate) {
      $calculations[$karigar_rate['process_name']][$karigar_rate['department_name']] = array();
      
      foreach ($karigars as $karigar) {
        if(    strtolower($karigar_rate['product_name']) == strtolower($karigar['product_name']) 
            &&strtolower($karigar_rate['karigar_name']) == strtolower($karigar['karigar']) 
            && strtolower($karigar_rate['department_name'])==strtolower($karigar['department_name'])) {
          if(in_array($karigar['category_three'], $design_code)){
            $rate=$this->model->get_rate_process($karigar_rates, $karigar, $karigar_rate['product_name'],$karigar_name);

            $worker_count=$this->get_avg_out_weight_process($karigar_rates, $karigar, $karigar_rate['product_name'],$karigar_name,@$from_date,@$to_date);
            $amount=0;
            $amount=round($rate * $karigar['out_weight'],2);
            
            $calculations[$karigar_rate['process_name']][$karigar_rate['department_name']]['karigars'][] = array(
              'date'              => $karigar['date'],
              'karigar_name'      => $karigar['karigar'],
              'design_code'       => $karigar['design_codes'],
              'out_weight'        => $karigar['out_weight'],
              'loss'              => $karigar['loss'],
              'machine_size'      => $karigar['machine_size'],
              'no_of_workers'     => $worker_count,
              'lot_no'            => !empty($karigar['lot_no'])?$karigar['lot_no']:'',
              'parent_lot_name'   => $karigar['parent_lot_name'],
              'in_lot_purity'     => !empty($karigar['in_lot_purity'])?$karigar['in_lot_purity']:'',
              'rate'              => $rate,
              'amount'            => $amount);
          }
        }
      }
    } 
    // !empty($karigar_rate['no_of_workers'])&&$karigar_rate['no_of_workers']!=0?$row['out_weight']/$karigar_rate['no_of_workers']:$row['out_weight'];

    $data['calculations'] = $calculations;
    // pd($data['calculations']);
    $this->load->render('reports/worker_wise_karigar_calculations/index',$data);
  }


  private function get_avg_out_weight_process($karigar_rates,$row,$product_name,$karigar_name='',$from_date,$to_date) {
    // pd($karigar_rates);
    foreach ($karigar_rates  as $index=> $karigar_rate) {
      $avg_out_weight=0;
       if(strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])/*  && $karigar_rate['department_name']==$row['department_name']*/) {
          if(!empty($karigar_name)){
            $karigar_rate_worker_details=$this->karigar_rate_worker_detail_model->find('sum(no_of_workers) as no_of_workers,date',array('karigar'=>$karigar_name,'date(date)'=>date('Y-m-d',strtotime($row['selected_date']))),array(),array('group_by'=>'date'));

          }else{
            $karigar_rate_worker_details=$this->karigar_rate_worker_detail_model->find('sum(no_of_workers) as no_of_workers,date',array('karigar'=>$karigar_rate['karigar_name'],'date(date)'=>date('Y-m-d',strtotime($row['selected_date']))),array(),array('group_by'=>'date'));
         // lq();
          }

          $avg_out_weight=!empty($karigar_rate_worker_details['no_of_workers'])&&$karigar_rate_worker_details['no_of_workers']!=0?$karigar_rate_worker_details['no_of_workers']:0;
         }
    }
    return $avg_out_weight;
  }
  
  public function view($id) {
    $data['layout'] = 'application';
    $karigar_details = array();
    $karigar_name = isset($_GET['karigar_name'])?$_GET['karigar_name']:'';
    $parent_lot_name = isset($_GET['parent_lot_name'])?$_GET['parent_lot_name']:'';
    $rate = isset($_GET['rate'])?$_GET['rate']:'';
    $date = isset($_GET['date'])?date('Y-m-d',strtotime($_GET['date'])):'';
    $data['process_name'] = isset($_GET['process_name'])?$_GET['process_name']:'';
    $data['department_name'] = isset($_GET['department_name'])?$_GET['department_name']:'';
    $data['product_name'] = isset($_GET['product_name'])?$_GET['product_name']:'';

    $where=array('karigar' => $karigar_name, 
                 'parent_lot_name'=>$parent_lot_name,
                 'date(completed_at)=' => $date, 
                 'product_name' => $data['product_name'],
                 'process_name' => $data['process_name'], 
                 'department_name' => $data['department_name']);

    $karigars_detail = $this->process_model->get('karigar as karigar_name,department_name,
                                date_format(completed_at,"%d-%b-%Y") as date,design_code,
                                design_code as design_codes,out_weight,process_name,parent_lot_name', 
                                $where);

    foreach ($karigars_detail as $key => $details) {
      $temp=$details;
      $temp['design_code'] = $details['design_codes'];
      $temp['rate'] = $rate;
      $temp['amount'] = $rate*$details['out_weight'];
      $karigar_details[] = $temp;
    }

    $data['karigar_detail'] = $karigar_details;
    $this->load->render('reports/worker_wise_karigar_calculations/karigar_details',$data);
  }
}