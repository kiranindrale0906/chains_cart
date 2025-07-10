<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_wise_karigar_calculation_model extends BaseModel {
  protected $table_name = "karigar_rates";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

   public function get_karigar_data($ids,$where){

    $order_by = 'selected_date desc'; 
    $group_by = 'processes.id'; 
   
    $select = 	'processes.lot_no as lot_no,processes.id,karigar
                , department_name,product_name, completed_at as selected_date,
    						date_format(completed_at,"%d-%b-%Y") as date, 
               design_code, design_code as design_codes, 
               (loss+karigar_loss+pending_loss) as loss, machine_size, "" as category_three,
               (out_weight+customer_out) as out_weight, process_name, parent_lot_name, processes.in_lot_purity';

    $union_select = 'processes.lot_no as lot_no,processes.id,processes.karigar, processes.department_name, processes.product_name, 
                    process_details.created_at as selected_date,date_format(process_details.created_at,"%d%-%b-%Y") as date, 
                    processes.design_code, processes.design_code as design_codes, 
                    (processes.loss + processes.karigar_loss + processes.pending_loss) as loss, processes.machine_size, "" as category_three,
                    (processes.out_weight+processes.customer_out) as out_weight, processes.process_name,
                    processes.parent_lot_name, processes.in_lot_purity';
    if(!empty($ids))
      $karigars = $this->db->query('select * from (SELECT '.$select.' 
      															FROM processes where '.$where["union_where"] .' AND id
                                    not in ('.implode(',',$ids).')) as processes
                                    UNION
                                    (SELECT '.$union_select.' FROM process_details 
                                    INNER JOIN processes ON processes.id = process_details.process_id WHERE processes.id IN ('.implode(',',$ids).')  group by '.$group_by.' order by '.$order_by.');')->result_array();
    else{
      $karigars = $this->process_model->get($select,$where['where'],array(),array('order_by'=>$order_by));
    }
    return $karigars;  
  }
  public function get_rate_process($karigar_rates,$row,$product_name,$karigar_name='') {
    $rate=0;
    foreach ($karigar_rates as $karigar_rate) {
      if($product_name=="Machine Chain") {
        if(!empty($row['category_three'])) {
          if($karigar_rate['design_code']==$row['category_three'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="joining department" && (!empty($row['category_one'])&&$karigar_rate['category']==$row['category_one']) && $karigar_rate['wire_size']==$row['category_two']) {
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
        else if((!empty($row['category_one'])&&$karigar_rate['code']==$row['category_one']) && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="hook") {
            $rate=$karigar_rate['rate'];
        }
      }
      else if($product_name=="Round Box Chain") {
        if($karigar_rate['design_code']==$row['design_code'] && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="filing") {
            $rate=$karigar_rate['rate'];
        }
        else if(strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($karigar_name)=="ashish" && strtolower($row['department_name'])=="hook" &&(!empty($row['category_one']) && $karigar_rate['code']==$row['category_one'])) {
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
        }else if(strtolower($karigar_name)=="kumar" && strtolower($karigar_rate['karigar_name']) ==strtolower($row['karigar'])  && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="chain making") {
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
        }else if((strtolower($karigar_name)=="bikas") && strtolower($karigar_rate['karigar_name']) == strtolower($row['karigar']) && $karigar_rate['department_name']==$row['department_name'] && strtolower($row['department_name'])=="hand dull") {
            $rate=$karigar_rate['rate'];
        }
      }
    }

    return $rate;
  }

}