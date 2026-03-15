<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karigar_calculations extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','processes/process_field_model','settings/same_karigar_model'));
  }

  public function index() { 
    $data['layout']       = 'application';
    $data['products']     = $this->same_karigar_model->get_product_dropdown();
    $data['departments']  = array();
    $data['karigar_list'] = array();
    $group_by = array();

    $product_name    = !empty($_GET['karigar_calculations']['product_name'])    ? $_GET['karigar_calculations']['product_name'] : '';
    $department_name =!empty($_GET['karigar_calculations']['department_name']) ? $_GET['karigar_calculations']['department_name'] : '';
    $karigar_name    = !empty($_GET['karigar_calculations']['karigar_name'])    ? $_GET['karigar_calculations']['karigar_name'] : '';

    if(!empty($_GET['karigar_calculations']['from_date'])) {
      $data['record']['from_date'] = $_GET['karigar_calculations']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['karigar_calculations']['from_date']));
    }

    if(!empty($_GET['karigar_calculations']['to_date'])) {
      $data['record']['to_date'] = $_GET['karigar_calculations']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['karigar_calculations']['to_date']));
    }

     if(!empty($product_name)) {
       $data['departments'] = $this->model->get('DISTINCT(department_name) as id, department_name as name', 
                                                array('product_name' => $product_name), array(), 
                                                 array('order_by'=>'department_name asc'));
      $data['record']['product_name'] = $product_name;
      $data['record']['department_name'] = $department_name;
      $where['processes.product_name'] = $product_name;

      $data['record']['karigar_name'] = '';
      if(!empty($karigar_name)) $data['record']['karigar_name'] = $karigar_name;

      if(!empty($from_date))       $where['date(processes.completed_at) >='] = $from_date;
      if(!empty($to_date))         $where['date(processes.completed_at )<='] = $to_date; 
      if(!empty($department_name)) $where['processes.department_name'] = $department_name; 
      if (!empty($karigar_name))   $where['processes.karigar'] = $karigar_name;

      // if 
      //   if(strtolower($karigar_name)=="ganesh" || strtolower($karigar_name)=="vikas" || strtolower($karigar_name)=="tushar bhai") 
      //     $where['processes.ghiss > '] = 0;
      // }

      // if(!empty($karigar_name) && !empty($department_name)) {
      //   if((strtolower($department_name)=="hook" || strtolower($department_name)=="joining department") && (strtolower($karigar_name)=="ashish"))
      //     $where['processes.hook_in > ']=0; 
      // }

      $order_by['order_by'] = 'date(completed_at) asc'; 

      if(isset($product_name)&&$product_name=="Machine Chain") {
        if($department_name == "Joining Department") {
          $select = 'processes.hook_in, processes.hook_out, processes.karigar, 
                     processes.department_name, date_format(processes.completed_at,"%d-%b-%Y") as date, 
                     substring_index(processes.lot_no,"-",1) as design_code, processes.lot_no as design_codes,
                     processes.out_weight,processes.bounch_out, processes.process_name,processes.parent_lot_name, 
                     melting_lots.category_one, melting_lots.category_two, melting_lots.category_three, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array(array('melting_lots','processes.melting_lot_id=melting_lots.id','left')), $order_by);
        } else {
          $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date, 
                     substring_index(lot_no,"-",1) as design_code, lot_no as design_codes, out_weight,bounch_out,
                     process_name, parent_lot_name, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array(), $order_by);  
        }
      }

      else if(isset($product_name)&&$product_name=="Indo tally Chain") {
        $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                   design_code, design_code as design_codes, sum(out_weight) as out_weight,sum(bounch_out) as bounch_out,
                   process_name, parent_lot_name, processes.in_lot_purity';
        $karigars = $this->process_model->get($select, $where, array(), array('group_by' => 'date(completed_at), karigar, parent_lot_name, department_name',
                                                                              'order_by' => 'date(completed_at) asc'));
      }

      else if(isset($product_name)&&$product_name=="Hollow Choco Chain") {
        $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                   design_code, design_code as design_codes, sum(out_weight) as out_weight,sum(bounch_out) as bounch_out,
                   process_name, parent_lot_name, processes.in_lot_purity';
        $karigars = $this->process_model->get($select, $where, array(), array('group_by' => 'date(completed_at), karigar, parent_lot_name, department_name',
                                                                              'order_by' => 'date(completed_at) asc'));
      }

      else if(isset($product_name)&&$product_name=="Imp Italy Chain") {
        $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                   concept as design_code, concept as design_codes, sum(out_weight) as out_weight,sum(bounch_out) as bounch_out,
                   process_name, parent_lot_name, lot_no,processes.in_lot_purity';
        $karigars = $this->process_model->get($select, $where, array(), array('group_by' => 'date(completed_at), karigar, parent_lot_name, department_name',
                                                                              'order_by' => 'date(completed_at) asc'));
      }

      else if(isset($product_name)&&$product_name=="Choco Chain") {
        $select = 'processes.karigar, department_name, date_format(processes.completed_at,"%d-%b-%Y") as date,
                   concept as design_code, concept as design_codes, sum(out_weight) as out_weight,sum(bounch_out) as bounch_out,
                   processes.process_name, processes.parent_lot_name, processes.lot_no,
                   in_lot_purity, category_one as concept_name';
        $karigars = $this->process_model->get($select, $where, array(array('melting_lots','melting_lots.id=processes.melting_lot_id','left')), 
                                              array('group_by'=>'date(processes.completed_at), karigar, department_name',
                                                    'order_by'=>'date(completed_at) asc'));
      }

      else if(isset($product_name)&&$product_name=="Rope Chain") {
        if($department_name=="Hook") {
          $select = 'processes.karigar, processes.department_name, date_format(processes.completed_at,"%d-%b-%Y") as date,
                     processes.design_code, processes.design_code as design_codes, processes.lot_no as design_codes, 
                     processes.out_weight,processes.bounch_out, processes.process_name, processes.parent_lot_name,
                     melting_lots.category_one, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array(array('melting_lots','processes.melting_lot_id=melting_lots.id','left')), $order_by);
        } else {
          $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                     substring_index(lot_no,"-",1) as design_code, lot_no as design_codes, out_weight,bounch_out,
                     process_name, parent_lot_name, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array() ,$order_by);  
        }
      }else if(isset($product_name)&&$product_name=="Office Outside"&&$department_name=="Pipe and Para Final") {
          $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                     substring_index(lot_no,"-",1) as design_code, lot_no as design_codes, daily_drawer_in_weight as out_weight,bounch_out,
                     process_name, parent_lot_name, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array() ,$order_by);
      }else if(isset($product_name)&&in_array($product_name,array("Fancy Chain","Fancy 75 Chain"))&&in_array($department_name,array("Buffing","CNC Department","DC Department","Dull","Hand Cutting","Lasiya Cutting","Polish","Rhodium","Round and Ball Chain"))) {
          $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date,
                     substring_index(lot_no,"-",1) as design_code, lot_no as design_codes, melting_wastage as out_weight,bounch_out,
                     process_name, parent_lot_name, processes.in_lot_purity';
          $karigars = $this->process_model->get($select, $where, array() ,$order_by);
      }elseif(isset($product_name)&&$product_name=="Lopster Making Chain" && $department_name=="Assembling") {
	$where['process_details.out_weight !=']=0;
        if(!empty($from_date))       $where['date(process_details.created_at) >='] = $from_date;
        if(!empty($to_date))         $where['date(process_details.created_at )<='] = $to_date; 
        $order_by['order_by'] = 'date(process_details.created_at) asc'; 
              $select = 'processes.hook_in, processes.hook_out, processes.karigar, 
                     processes.department_name, date_format(processes.created_at,"%d-%b-%Y") as date,processes.design_code, processes.design_code as design_codes,
                     process_details.out_weight,processes.bounch_out, processes.machine_size, "" as category_three,processes.process_name,processes.parent_lot_name
                     , processes.in_lot_purity';
          $karigars = $this->process_field_model->get($select, $where, array(array('processes','processes.id=process_details.process_id','left')), $order_by);
        
      }else {
        $select = 'karigar, department_name, date_format(completed_at,"%d-%b-%Y") as date, 
                   design_code, design_code as design_codes, 
                   (loss+karigar_loss+pending_loss) as loss, machine_size, "" as category_three,
                   (out_weight+customer_out) as out_weight,bounch_out, process_name, parent_lot_name, processes.in_lot_purity';
        $karigars = $this->process_model->get($select, $where, array(), $order_by);
      }
      if(!empty($product_name)) {
        $data['karigar_list'] = $this->model->get('distinct(karigar_name) as id, karigar_name as name',array( array('product_name' => $product_name)));
      }
      
      if(!empty($department_name) && !empty($karigar_name)) {
        $data['record']['department_name'] = $department_name;
        $karigar_rates = $this->model->get('', array('product_name' => $product_name,
                                                     'department_name' => $department_name,
                                                     'karigar_name' => $karigar_name));
      } else if(!empty($department_name)) {
        $data['record']['department_name'] = $department_name;
        $karigar_rates = $this->model->get('', array('product_name' => $product_name,'department_name' => $department_name));
      
      } else if(!empty($karigar_name)) {
        $data['record']['karigar_name'] = $karigar_name;
        $karigar_rates = $this->model->get('', array('product_name' => $product_name, 
                                                     'karigar_name' => $karigar_name));
      } else {
        $karigar_rates = $this->model->get('', array('product_name' => $product_name)); 
      }
      $calculations = array();
      $design_code=array_unique(array_column($karigar_rates, 'design_code'));
      foreach ($karigar_rates as $karigar_rate) {
        $calculations[$karigar_rate['process_name']][$karigar_rate['department_name']] = array();
        
        foreach ($karigars as $karigar) {
          if(    strtolower($karigar_rate['karigar_name']) == strtolower($karigar['karigar']) 
              && strtolower($karigar_rate['department_name'])==strtolower($karigar['department_name'])) {
            // if(in_array($karigar['category_three'], $design_code)){
              $rate=$this->get_rate_process($karigar_rates, $karigar, $karigar_rate['product_name'], 
                                            $karigar_name);
              $avg_out_weight=$this->get_avg_out_weight_process($karigar_rates, $karigar, $karigar_rate['product_name'],$karigar_name);
              $amount=0;
              $amount=round($rate * $karigar['out_weight'],2);
              
              $calculations[$karigar_rate['process_name']][$karigar_rate['department_name']]['karigars'][] = array(
                'date'              => $karigar['date'],
                'karigar_name'      => $karigar['karigar'],
                'design_code'       => $karigar['design_codes'],
                'out_weight'        => $karigar['out_weight'],
                'bounch_out'        => $karigar['bounch_out'],
                'loss'              => @$karigar['loss'],
                'machine_size'      => @$karigar['machine_size'],
                'avg_out_weight'     => $avg_out_weight,
                'lot_no'            => !empty($karigar['lot_no'])?$karigar['lot_no']:'',
                'parent_lot_name'   => $karigar['parent_lot_name'],
                'in_lot_purity'     => !empty($karigar['in_lot_purity'])?$karigar['in_lot_purity']:'',
                'rate'              => $rate,
                'amount'            => $amount);
            // }
          }
        }
      }  
      
      $data['calculations'] = $calculations;
    }
    $this->load->render('reports/karigar_calculations/index',$data);
  }

  private function get_karigar_rates($product_name, $department_name, $karigar_name) {
    if(!empty($department_name) && !empty($karigar_name)) {
      $data['record']['department_name'] = $department_name;
      $karigar_rates = $this->model->get('', array('product_name' => $product_name, 
                                                   'department_name' => $department_name,
                                                   'karigar_name' => $karigar_name));
    } else if(!empty($department_name)) {
      $data['record']['department_name'] = $department_name;
      $karigar_rates = $this->model->get('', array('product_name' => $product_name, 'department_name' => $department_name));
    
    } else if(!empty($karigar_name)) {
      $data['record']['karigar_name'] = $karigar_name;
      $karigar_rates = $this->model->get('', array('product_name' => $product_name, 
                                                   'karigar_name' => $karigar_name));
    } else {
      $karigar_rates = $this->model->get('', array('product_name' => $product_name)); 
    }
  }

  private function get_avg_out_weight_process($karigar_rates,$row,$product_name,$karigar_name='') {
    foreach ($karigar_rates as $karigar_rate) {
      $avg_out_weight=0;
      if(strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="filing") {
          $avg_out_weight=!empty($karigar_rate['no_of_workers'])&&$karigar_rate['no_of_workers']!=0?$row['out_weight']/$karigar_rate['no_of_workers']:$row['out_weight'];
        }
    }
    return $avg_out_weight;
  }
  private function get_rate_process($karigar_rates,$row,$product_name,$karigar_name='') {
    $rate=0;
    foreach ($karigar_rates as $karigar_rate) {
      if($product_name=="Machine Chain") {
        if(!empty($row['category_three'])) {
          if($karigar_rate['design_code']==$row['category_three'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="joining department" && $karigar_rate['category']==$row['category_one'] && $karigar_rate['wire_size']==$row['category_two']) {
            $rate=$karigar_rate['rate'];

          }
        }
        else if(strtolower($karigar_rate['karigar_name'])==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="hook") {
            $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Rope Chain") {
        if($karigar_rate['design_code']==$row['design_code'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="filing") {
            $rate=$karigar_rate['rate'];
        }
        else if($karigar_rate['code']==$row['category_one'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="hook") {
            $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Round Box Chain") {
        if($karigar_rate['design_code']==$row['design_code'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="filing") {
            $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="hook" && $karigar_rate['code']==$row['category_one']) {
            $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Choco Chain") {
        if((strtolower($karigar_name)=="bappy nawabi" || strtolower($karigar_name)=="ashish")&& strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="chain making") {
          $rate=$karigar_rate['rate'];
        }
        else if((strtolower($karigar_name)=="prashanto" || strtolower($karigar_name)=="suman") && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && $karigar_rate['design_code']==$row['concept_name'] && $karigar_rate['purity']==$row['in_lot_purity'] && strtolower($row['department_name'])=="chain making") {
          $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_name)=="ganesh" && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="filing") {
          $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_name)=="vikas" &&strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && (strtolower($row['department_name'])=="hand dull" || strtolower($row['department_name'])=="hand dull ii")) {
            $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_name)=="tushar" && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="hand cutting") {
          $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Imp Italy Chain") {
        if(!empty($row['design_code'])) {
          if($karigar_rate['design_code']==$row['design_code'] && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="hollow bappy" && strtolower($row['department_name'])=="chain making") {
            $rate=$karigar_rate['rate'];
          }   
        }
        else
        {
          if(strtolower($karigar_name)=="vikas" &&strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && (strtolower($row['department_name'])=="hand dull" || strtolower($row['department_name'])=="hand dull ii")) {
            $rate=$karigar_rate['rate'];
          }
          else if(strtolower($karigar_name)=="nandanji" &&strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="spring")  {
            $rate=$karigar_rate['rate']; 
          }
          else if(strtolower($karigar_name)=="tushar" &&strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="hand cutting")  {
            $rate=$karigar_rate['rate']; 
          }
        }
      }
      else if($product_name=="Sisma Chain") {
        if(strtolower($karigar_name)=="ganesh" && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="filing") {
          $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_name)=="vikas" && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && (strtolower($row['department_name'])=="hand dull" || strtolower($row['department_name'])=="hand dull ii")) {
          $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Indo tally Chain" || $product_name=="KA Chain" )  {
        if(strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name']) {
            $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Hollow Choco Chain" ) {
        if((strtolower($karigar_name)=="ganesh") && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="filing") {
            $rate=$karigar_rate['rate'];
        }
        else if((strtolower($karigar_name)=="tushar") && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="hand cutting") {
            $rate=$karigar_rate['rate'];
        }
      }
    }

    return $rate;
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
                                design_code as design_codes,out_weight,bounch_out,process_name,parent_lot_name', 
                                $where);

    foreach ($karigars_detail as $key => $details) {
      $temp=$details;
      $temp['design_code'] = $details['design_codes'];
      $temp['rate'] = $rate;
      $temp['amount'] = $rate*$details['out_weight'];
      $karigar_details[] = $temp;
    }

    $data['karigar_detail'] = $karigar_details;
    $this->load->render('reports/karigar_calculations/karigar_details',$data);
  }
}
