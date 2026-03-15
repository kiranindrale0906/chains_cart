<?php
class Stock_summary_list extends BaseController {
  public function __construct() {
    parent::__construct();
  }
  
  public function index() {
    
    if($_GET['is_highlight']=='receipt_summary') $this->receipt_summary();
    if($_GET['is_highlight']=='stock_summary') $this->stock_summary();
    if($_GET['is_highlight']=='issue_summary') $this->issue_summary();
    

  }
  
  private function receipt_summary() {
    if($_GET['process']=='Alloy Issue') {
      $balance = '-(alloy_weight) as balance';
      $balance_gross = '-(alloy_weight) as balance_gross';
      $balance_fine = '0 as balance_fine';
      $query = "Select alloy_weight,process_name,gross_weight,lot_no,lot_purity,karigar,parent_lot_name,created_at,".$balance.",".$balance_gross.",".$balance_fine.",id as melting_url from melting_lots where alloy_weight!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif($_GET['process']=='Alloy Vodatar') {
      $balance = '0 as balance';
      $balance_gross = '0 as balance_gross';
      $balance_fine = '(0-(alloy_vodatar*lot_purity/100)) as balance_fine';
      $query = "Select alloy_vodatar,process_name,gross_weight,lot_no,lot_purity,karigar,parent_lot_name,created_at,".$balance.",".$balance_gross.",".$balance_fine.",id as melting_url from melting_lots where alloy_vodatar!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif($_GET['process']=='Metal Summary') {
      $query = "Select melting_wastage,created_at,balance,balance_gross,balance_fine,id as url from processes where melting_wastage!=0 and process_name = 'Receipt'";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif($_GET['process']=='Stone Vatav Receipt') {
      $query = "SELECT stone_vatav,created_at,0 as `balance`, 0 as `balance_gross`, 0 as `balance_fine` FROM `processes` WHERE stone_vatav!=0 and `processes`.`is_delete` != 1";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    }
  }

  private function stock_summary() {

    $wastages_array = array('daily_drawer_wastage','ghiss','pending_ghiss','tounch_out','tounch_ghiss','loss','ghiss_loss');
    if (strpos($_GET['process'], 'Karigar Daily Drawer') !== false) {
      $karigar = ltrim(str_replace("Karigar Daily Drawer", "", $_GET['process']));
      $balance = 'ROUND((daily_drawer_in_weight - (hook_in - hook_out %2B daily_drawer_out_weight)),4) as balance';
      $balance_gross = 'ROUND((daily_drawer_in_weight - (hook_in - hook_out %2B daily_drawer_out_weight)),4) as balance_gross';
      $balance_fine = 'ROUND(((daily_drawer_in_weight - (hook_in - hook_out %2B daily_drawer_out_weight)) * hook_kdm_purity / 100),4) as balance_fine ';
      $query = "Select product_name,process_name,department_name,daily_drawer_in_weight,hook_in,hook_out,daily_drawer_out_weight,hook_kdm_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where type!='GPC Powder' and karigar='".$karigar."'";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif (strpos($_GET['process'], 'Dye Process') !== false) {
      $dye_process = ltrim(str_replace("Dye Process", "", $_GET['process']));
      $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,balance,balance_gross,balance_fine,id as url from processes where product_name='Office Outside' and process_name='".$dye_process."Dye Process' and balance!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    }elseif (strpos($_GET['process'], 'Packing Slip') !== false) {
      $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,balance,balance_gross,balance_fine,id,packing_slip_balance as url from processes where  packing_slip_balance!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ((strpos($_GET['process'], 'Wastage') !== false) && ($_GET['section_name']=='CHAINS')) {
      $wastage_type = strtolower(str_replace(' ', '_', trim(substr(strstr($_GET['process']," "), 1))));
      $balance_gross = 'ROUND(balance_'.$wastage_type.'* wastage_purity/100,4)';
      $balance_fine = 'ROUND(balance_'.$wastage_type.'* wastage_purity/100 * wastage_lot_purity/100,4)';
      $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,balance_".$wastage_type.",".$balance_gross." as balance_gross,".$balance_fine." as balance_fine,id as url from processes where product_name='".$_GET['product']."' and balance_".$wastage_type."!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif (strpos($_GET['process'], 'Ag Out') !== false) {
      $balance_gross = 'ROUND(out_weight * wastage_purity/100,4)';
      $balance_fine = 'ROUND(out_weight * wastage_purity/100 * wastage_lot_purity/100,4)';
      $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,out_weight as balance,".$balance_gross." as balance_gross,".$balance_fine." as balance_fine,id as url from processes where product_name='".$_GET['product']."' and department_name='Melting' and out_weight!=0 and id not IN (SELECT process_id from process_groups)";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['section_name']=='WASTAGES') {
      if(in_array($_GET['product'], $wastages_array)) {
        //pd($_GET['product']);
        if($_GET['product']=='ghiss_loss' ) $_GET['product']='loss';
        $balance_gross = 'ROUND(balance_'.$_GET['product'].' * wastage_purity/100,4) as balance_gross';
        $balance_fine = 'ROUND(balance_'.$_GET['product'].' * wastage_purity/100 * wastage_lot_purity/100,4) as balance_fine';
        if($_GET['product']=='loss'){
        $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,balance_".$_GET['product'].",".$balance_gross.",".$balance_fine.",id as url from processes where balance_".$_GET['product']."!=0 and department_name='".$_GET['process']."'";
        }else{
        $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,balance_".$_GET['product'].",".$balance_gross.",".$balance_fine.",id as url from processes where balance_".$_GET['product']."!=0 and product_name='".$_GET['process']."'";
        }
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif ($_GET['product']=='melting_wastage') {
        $balance_fine = 'ROUND(balance_'.$_GET['product'].' * wastage_lot_purity/100,4) as balance_fine';
        $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,balance_".$_GET['product'].",balance_".$_GET['product']." as balance_gross,".$balance_fine.",id as url from processes where balance_".$_GET['product']."!=0 and process_name='".$_GET['process']."'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif ($_GET['product']=='fire_tounch_in') {
        $balance = 'ROUND(fire_tounch_in-fire_tounch_out-fire_tounch_gross,4)';
        $balance_fine = 'ROUND('.$balance.' * wastage_lot_purity/100,4) as balance_fine';
        $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance." as balance,".$balance." as balance_gross,".$balance_fine.",id as url from processes where fire_tounch_in!=0 and fire_tounch_out=0 and product_name='".$_GET['process']."'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif ($_GET['product']=='tounch_in') {
        $balance = 'ROUND(tounch_in-tounch_ghiss-tounch_out,4)';
        $balance_fine = 'ROUND('.$balance.' * wastage_lot_purity/100,4) as balance_fine';
        $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance." as balance,".$balance." as balance_gross,".$balance_fine.",id as url from processes where tounch_in!=0 and tounch_out=0 and product_name='".$_GET['process']."'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      }
    } elseif($_GET['product']=='GPC Out') {
      $balance = 'ROUND(balance_gpc_out,4)';
      $balance_gross = 'ROUND('.$balance.' * out_purity / 100,4) as balance_gross';
      $balance_fine = 'ROUND('.$balance.' * out_purity / 100  * out_lot_purity / 100,4) as balance_fine';
      $query = "Select product_name,process_name,department_name,out_purity,out_lot_purity,".$balance.",".$balance." as balance_gross,".$balance_fine.",id as url from processes where balance_gpc_out!=0 and process_name='".$_GET['process']."'";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['section_name']=='WASTAGE MELTING') {
      $balance = 'balance as balance';
      $balance_gross = 'balance * wastage_purity / 100 as balance_gross';
      $balance_fine = 'balance * wastage_purity / 100 * wastage_lot_purity / 100 as balance_fine';
      $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance.",".$balance.",".$balance_fine.",id as url from processes where product_name='".$_GET['product']."' and balance!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['section_name']=='GROSS AND FINE LOSS' && strpos($_GET['row'], 'department_loss') !== false) {
      if($_GET['row']=='gpc_tounch_department_loss')
        $where = "and department_name in ('GPC', 'GPC Or Rodium', 'Bunch GPC', 'Fancy Out')";
      if($_GET['row']=='wastage_tounch_department_loss')
        $where = "and department_name in ('Melting', 'Ghiss Melting', 'Daily Drawer Wastage')";
      if($_GET['row']=='other_tounch_department_loss')
        $where = "and department_name not in ('GPC', 'GPC Or Rodium', 'Bunch GPC', 'Fancy Out', 'Melting', 'Ghiss Melting', 'Daily Drawer Wastage', 'Refine Melting')";
      $balance = '0';
      $balance_fine = 'balance_tounch_loss_fine as balance_fine';
      $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance." as balance,".$balance." as balance_gross,".$balance_fine.",id as url from processes where balance_tounch_loss_fine!=0 ".$where;
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['process']=='HCL Gross Loss') {
      $balance = '0 as balance';
      $balance_gross = 'balance_hcl_loss as balance_gross';
      $balance_fine = 'balance_hcl_loss * wastage_lot_purity / 100 as balance_fine';
      $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where balance_hcl_loss!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['process']=='Fire Tounch Loss') {
      $balance = 'refine_loss as balance';
      $balance_gross = 'refine_loss as balance_gross';
      $balance_fine = 'refine_loss * wastage_lot_purity / 100 as balance_fine';
      $query = "Select product_name,process_name,department_name,wastage_purity,wastage_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where refine_loss!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif ($_GET['process']=='Melting Wastage Fine Diff') {
      $query = "SELECT processes.process_name,processes.lot_no,processes.department_name,ghiss,(melting_lot_details.required_weight * (processes.wastage_lot_purity - melting_lot_details.in_purity)/ 100) as balance_fine FROM `melting_lot_details` INNER JOIN `processes` ON `processes`.`id`=`melting_lot_details`.`process_id` WHERE `melting_lot_details`.`is_delete` != 1 and (melting_lot_details.required_weight * (processes.wastage_lot_purity - melting_lot_details.in_purity)/ 100)!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } elseif($_GET['row']=='stock_metal_summery') {
      $balance = 'balance_melting_wastage as balance';
      $balance_gross = 'balance_melting_wastage as balance_gross';
      $balance_fine = 'balance_melting_wastage * out_lot_purity / 100 as balance_fine';
      $query = "Select product_name,process_name,department_name,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where product_name='Receipt' and process_name='Receipt' and balance_melting_wastage!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    } else {
      if($_GET['product']=='Internal')
        $_GET['process'] = 'Internal Final Process';
      if($_GET['product']=='Refresh')
        $_GET['process'] = 'Refresh';
      $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,balance,balance_gross,balance_fine,id as url from processes where product_name='".$_GET['product']."' and process_name='".$_GET['process']."' and balance!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    }
  }
  
  private function issue_summary() {
    if($_GET['product']=='process') {
      if($_GET['row']=='copper') {
        $balance = 'copper_out as balance';
        $balance_gross = 'copper_out * in_purity/100 as balance_gross';
        $balance_fine = 'copper_out * in_purity/100 * in_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,in_purity,in_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where copper_out!=0";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='stone_vatav') {
        $balance = 'out_stone_vatav as balance';
        $balance_gross = 'out_stone_vatav * out_purity/100 as balance_gross';
        $balance_fine = 'out_stone_vatav * out_purity/100 * out_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,out_purity,out_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where out_stone_vatav!=0";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='issue_tounch_loss_fine') {
        $balance = '0 as balance';
        $balance_gross = '0 as balance_gross';
        $balance_fine = 'issue_tounch_loss_fine as balance_fine';
        $query = "Select product_name,process_name,department_name,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where issue_tounch_loss_fine!=0";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='issue_loss_melting') {
        $balance = 'in_weight as balance';
        $balance_gross = 'in_weight * in_purity/100 as balance_gross';
        $balance_fine = 'in_weight * in_purity/100 * in_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,in_purity,in_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where in_weight!=0 and department_name='Loss Transfer'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='issue_daily_drawer') {
        $balance = 'in_weight as balance';
        $balance_gross = 'in_weight * in_purity/100 as balance_gross';
        $balance_fine = 'in_weight * in_purity/100 * in_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,in_purity,in_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where in_weight!=0 and product_name='Issue' and process_name='Daily Drawer Issue'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='refresh_rnd_issue') {
        $balance = 'out_weight as balance';
        $balance_gross = 'out_weight * out_purity/100 as balance_gross';
        $balance_fine = 'out_weight * out_purity/100 * out_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,out_purity,out_lot_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where in_weight!=0 and product_name='RND' and process_name='RND Issue'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } elseif($_GET['row']=='issue_gpc_powder') {
        $balance = 'in_weight as balance';
        $balance_gross = 'in_weight as balance_gross';
        $balance_fine = 'in_weight * in_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,in_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where in_weight!=0 and product_name='GPC Powder'";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } else {
        $balance = $_GET['row'].' as balance';
        $balance_gross = $_GET['row'].' * wastage_purity/100 as balance_gross';
        $balance_fine = $_GET['row'].' * wastage_purity/100 * wastage_lot_purity/100 as balance_fine';
        $query = "Select product_name,process_name,department_name,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where ".$_GET['row']."!=0";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      }
    } elseif($_GET['row']=='issue_department_melting_wastage') {
        $balance = 'issue_melting_wastage as balance';
        $balance_gross = 'issue_melting_wastage as balance_gross';
        $balance_fine = 'issue_melting_wastage * wastage_lot_purity / 100 as balance_fine';
        $query = "Select product_name,process_name,department_name,in_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from processes where in_weight!=0";
        redirect(base_url().'settings/run_sql_query?query='.$query);
      } else {
      //pd($_GET['process']);
      $product_name = ltrim(str_replace("Issue", "", $_GET['process']));
      $balance = 'in_weight as balance';
      $balance_gross = 'in_weight as balance_gross';
      $balance_fine = 'in_weight * in_purity/100 as balance_fine';
      $query = "Select account_id,product_name,description,in_weight,in_purity,".$balance.",".$balance_gross.",".$balance_fine.",id as url from issue_departments where product_name='".$product_name."' and in_weight!=0";
      redirect(base_url().'settings/run_sql_query?query='.$query);
    }
  }
  
  /*public function run_sql_query($field,$purity) {
    if($purity=='in'){
      $gross = $field.' * in_purity/100 as balance_gross';
      $fine = $field.' * in_purity/100 * in_lot_purity/100 as balance_fine';
    }
    if($purity=='out'){
      $gross = $field.' * out_purity/100 as balance_gross';
      $fine = $field.' * out_purity/100 * out_lot_purity/100 as balance_fine';
    }
    $query = "Select product_name,process_name,department_name,in_weight,".$field." as balance,".$gross.",".$fine.",id as url from processes where ".$field."!=0";
    redirect(base_url().'settings/run_sql_query?query='.$query);
  }*/

  public function index_old() {
    $this->receipt_summary();
    $this->stock_summary();
    $this->issue_summary();
    /*--------------melavni-----------*/
    if(@$_GET['type_of'] == 'opening' && @$_GET['row'] == 'melavni'){
    	redirect(base_url().'stock_summary_reports/melavni_list?row='.$_GET['row'].'&type_of=opening');
    }  
    
    if((@$_GET['type_of'] == 'in_weight' || @$_GET['type_of'] == 'out_weight') && @$_GET['row'] == 'melavni')
     	redirect(base_url().'stock_summary_reports/melavni_list?row='.$_GET['row'].'&type_of='.$_GET['type_of']);
    
    if((@$_GET['type_of'] == 'balance'||@$_GET['type_of'] == 'balance_gross'||@$_GET['type_of'] == 'balance_fine') && @$_GET['row'] == 'melavni')
      redirect(base_url().'stock_summary_reports/melavni_list?row='.$_GET['row'].'&type_of=balance');



    if((@$_GET['type_of'] == 'in_weight' || @$_GET['type_of'] == 'out_weight') && @$_GET['row'] == 'alloy_vodatar')
      redirect(base_url().'stock_summary_reports/alloy_vadatar_list?row='.$_GET['row'].'&type_of='.$_GET['type_of'].'&is_highlight='.$_GET['is_highlight']);
    
    if((@$_GET['type_of'] == 'balance'||@$_GET['type_of'] == 'balance_gross'||@$_GET['type_of'] == 'balance_fine') && @$_GET['row'] == 'alloy_vodatar')
      redirect(base_url().'stock_summary_reports/alloy_vadatar_list?row='.$_GET['row'].'&type_of=balance&is_highlight='.$_GET['is_highlight']);

  
   
  /*--------------alloy_receipt_summary-----------*/
    if( @$_GET['row'] == 'alloy_receipt_summary'){
     $this->stock_summary_query('alloy_weight != 0 and alloy_weight IS NOT NULL');
    }

	 
  /*--------------hcl_fe/hcl_gold_loss-----------*/
    if(@$_GET['row'] == 'hcl_fe_out' || @$_GET['row'] == 'hcl_loss'){
      $this->stock_summary_query('department_name ="HCL" and  hcl_loss != 0');
    }  

  /*--------------hcl_process-----------*/
    if(@$_GET['row'] == 'hcl_process'){
      $this->stock_summary_query('product_name ="HCL" and  balance >0 ');
    }  
  /*--------------hcl_process_loss-----------*/
    if((@$_GET['row'] == 'hcl_process_loss')){
      $this->stock_summary_query('product_name ="HCL" and  balance >0 and balance_gross > 0');
    }


   /*--------------choco_chain_ag_out-----------*/
    if(@$_GET['row'] == 'choco_chain_ag_out'){
      $this->stock_summary_query('product_name ="Choco Chain" and department_name = "Dye" and
                                  id NOT IN (select parent_id from processes where product_name = "Choco Chai" and process_name = "Machine Process" and department_name = "Start")');
    } 
 
  /*--------------choco_chain_final_process-----------*/
    if(@$_GET['row'] == 'choco_chain_final_process'){
      $this->stock_summary_query('product_name ="Choco Chain" and process_name = "Final Process" and balance >0');
    }
    /*--------------daily_drawer_process-----------*/
    if(@$_GET['row'] == 'daily_drawer_process'){
      $this->stock_summary_query("product_name = 'Daily Drawer' and balance > 0 ");
    } 
   
 /*--------------liquor_out-----------*/
    if(@$_GET['row'] == 'issue_liquor'){
      $this->stock_summary_query('liquor_out >0');
    }
  /*--------------refresh_summary-----------*/
    if(@$_GET['row'] == 'refresh_summary'){
      $this->stock_summary_query('process_name = "Refresh" and department_name ="Start"');
    }

  /*--------------refresh_process-----------*/
    if(@$_GET['row'] == 'refresh_process'){
      $this->stock_summary_query('process_name = "Refresh" and balance > 0');
    }

 /*--------------imp_italy_chain_spring_out-----------*/ 
  	if((@$_GET['row'] == 'imp_italy_chain_spring_out')){
	   $this->stock_summary_query('product_name="Imp Italy Chain" and out_weight > 0 and department_name="Spring" and  id NOT IN (select parent_id  from processes  where product_name = "Imp Italy Chain"  and process_name = "Chain Making Process"  and department_name = "Start")');
	  }

 
    /*--------------ghiss_process-----------*/ 
    if((@$_GET['row'] == 'ghiss_process')){
     $this->stock_summary_query('product_name="Ghiss Out" and balance > 0');
    }  
    /*--------------tounch_process-----------*/ 
    if((@$_GET['row'] == 'tounch_process')){
     $this->stock_summary_query('product_name="Tounch Out" and balance > 0');
    }
    /*--------------hcl_loss_fine-----------*/ 
    if((@$_GET['row'] == 'hcl_loss_fine')){
     $this->stock_summary_query('department_name IN ("HCL","HCL Process")');
    } 

  /*-------------gpc_out----------*/
	  if(@$_GET['row'] == 'gpc_out'){
	    $this->stock_summary_query('gpc_out !=0');
	  }
 
  /*--------------melting_wastage-----------*/                      

    if(@$_GET['row'] == 'melting_wastage'){
     $this->stock_summary_query("product_name NOT IN('Receipt', 'Chain Receipt') and melting_wastage!=0");
    }
  
 
  /*-------------tounch----------*/   
	  if(@$_GET['row'] == 'tounch_in'){
	   $this->stock_summary_query('tounch_in>0');
	  }
 
  /*-------------tounch_in_ghiss----------*/   
    if(@$_GET['row'] == 'tounch_in_ghiss'){
     $this->stock_summary_query('process_name!="Receipt" and tounch_ghiss>0');
    }

   // }
  

  /*-------------tounch Out----------*/   
    if(@$_GET['row'] == 'tounch_out'){
      $this->stock_summary_query('tounch_out>0');
    }
  /*-------------tounch Loss----------*/   
    if(@$_GET['type_of'] == 'opening' && @$_GET['row'] == 'tounch_loss'){
      $this->stock_summary_query('tounch_loss_fine>0');
    }
  /*-------------loss----------*/
    if(@$_GET['row'] == 'loss'){
      $this->stock_summary_query('department_name NOT IN("GPC","Stripping") and process_name!="hcl" and loss >0');
    }
    parent::index();
  }

  private function receipt_summary_old(){
    /*----------- Metal Summary ---------*/
    if(@$_GET['row'] == 'metal_summary'){
      $this->stock_summary_query('process_name = "Receipt"');
    }
    /*-------------- Chain Receipt  -----------*/
    if(@$_GET['row'] == 'chain_receipt_summary'){
      $this->stock_summary_query('product_name="Chain Receipt"');
    }/*-------------- Rhodium Receipt  -----------*/
    if(@$_GET['row'] == 'rhodium_receipt_summary'){
      $this->stock_summary_query('product_name="Rhodium Receipt"');
    }

    /*--------------  Daily Drawer Receipt  ----------*/
    if(@$_GET['row'] == 'daily_drawer_receipt_summary'){
      $this->stock_summary_query('product_name="Daily Drawer Receipt" and daily_drawer_in_weight!=0');
    }
    /*--------------  Alloy Receipt   ----------*/
    if(@$_GET['row'] == 'alloy_receipt_summary'){
      $this->stock_summary_query('product_name="Alloy Receipt"');
    }
    /*--------------  Refresh Receipt   ----------*/
    if(@$_GET['row'] == 'refresh_metal_receipt'){
      $this->stock_summary_query('department_name="Start" and product_name="Refresh"');
    }
    /*--------------  Refresh Receipt   ----------*/
    if(@$_GET['row'] == 'rnd_receipt_in_summary'){
      $this->stock_summary_query('out_weight>0 and product_name="RND" and process_name="RND Receipt"');
    } 

    /*--------------  Refresh Receipt   ----------*/
    if(@$_GET['row'] == 'rnd_receipt_out_summary'){
      $this->stock_summary_query('out_weight>0 and product_name="RND" and process_name="RND Issue"');
    }
    /*--------------alloy_vodatar-----------*/
    if(@$_GET['type_of'] == 'opening' && @$_GET['row'] == 'alloy_vodatar'){
     redirect(base_url().'stock_summary_reports/alloy_vadatar_list?row='.$_GET['row'].'&type_of=opening&is_highlight='.$_GET['is_highlight']);
    }  
    /*--------------GPC Vodatar-----------*/
    if( @$_GET['row'] == 'gpc_vodatar'){
     $this->stock_summary_query('micro_coating > 0 and micro_coating IS NOT NULL');
    }

      /*--------------Fe-----------*/
    if(@$_GET['row'] == 'fe'){
      $this->stock_summary_query('process_name != "Receipt" and (fe_in > 0 or fe_out > 0 or wastage_fe > 0)');
    }

     /*--------------Solder-----------*/
    if( @$_GET['row'] == 'solder'){
     $this->stock_summary_query('solder_in != 0 and solder_in IS NOT NULL');
    }
     /*--------------Liquor-----------*/
    if(@$_GET['row'] == 'liquor'){
      $this->stock_summary_query('liquor_in >0');

    }
    /*-------------- Stone vatav  -----------*/
    if(@$_GET['row'] == 'stone_vatav'){
      $this->stock_summary_query('stone_vatav!=0');
    }

    /*--------------DD Chain Receipt-----------*/
    if(@$_GET['row'] == 'hollow_choco_chain_buffing_process_in' 
      || @$_GET['row'] == 'imp_italy_chain_daily_drawer_ag_in' 
      || @$_GET['row'] == 'machine_chain_daily_drawer_ag_in'
      || @$_GET['row'] == 'choco_chain_daily_drawer_ag_in'
      || @$_GET['row'] == 'rope_chain_daily_drawer_ag_in'
      || @$_GET['row'] == 'roundbox_chain_daily_drawer_ag_in'
      || @$_GET['row'] == 'sisma_chain_daily_drawer_ag_in'){
      $this->stock_summary_query('department_name="Start" and parent_id=0');
    }

  }
   private function stock_summary_old(){

  /*--------------Rope Chain Process-----------*/ 
    if((@$_GET['row'] == 'rope_chain_process')){
     $this->stock_summary_query('product_name="Rope Chain" and balance != 0');

    } 
    if((@$_GET['row'] == 'rope_chain_ag_out')){
     $this->stock_summary_query('product_name="Rope Chain" and process_name="AG" and department_name ="Melting" and id NOT IN (select process_id from process_groups)');
    }

    if(@$_GET['row'] == 'rope_chain_ag_flatting_out'){
    $this->stock_summary_query("out_weight > 0 AND id NOT IN((select parent_id from processes where product_name = 'Rope Chain' and (process_name = 'Machine Process') and department_name = 'Start')) AND `product_name` = 'Rope Chain' AND `department_name` = 'Wire Drawing'");
    } 


  /*--------------Machine Chain Process-----------*/ 
    if((@$_GET['row'] == 'machine_chain_process')){
     $this->stock_summary_query('product_name="Machine Chain" and balance != 0');
    } 

    if(@$_GET['row'] == 'machine_chain_ag_out'){
      $this->stock_summary_query('product_name ="Machine Chain" and department_name = "Melting" and id NOT IN (select parent_id from processes where product_name="Machine Chain" and process_name="Machine Process" and department_name="Start")');
    } 
    if(@$_GET['row'] == 'machine_chain_machine_out'){
      $this->stock_summary_query("out_weight > 0 AND id NOT IN((select parent_id from processes where product_name = 'Machine Chain' and (process_name = 'Final Process' or process_name = 'Rolex Final Process') and department_name = 'Start')) AND `product_name` = 'Machine Chain' AND `department_name` = 'Machine Department'");
    } 



  /*--------------Choco Chain Process-----------*/ 
    if((@$_GET['row'] == 'choco_chain_process')){
      $this->stock_summary_query('product_name="Choco Chain" and balance != 0');
    } 

    if(@$_GET['row'] == 'choco_chain_machine_out'){
     $this->stock_summary_query("out_weight > 0 AND id NOT IN((select parent_id from processes where product_name = 'Choco Chain' and (process_name = 'Final Process' or process_name = 'Imp Final Process') and department_name = 'Start')) AND `product_name` = 'Choco Chain' AND `department_name` = 'Chain Making'");
    } 

  /*--------------Indo tally Chain Process-----------*/ 
    if((@$_GET['row'] == 'indo_tally_chain_process')){
     $this->stock_summary_query('product_name="Indo tally Chain" and balance != 0');
    }
    if((@$_GET['row'] == 'indo_tally_chain_ag_out')){
     $this->stock_summary_query('product_name="Indo tally Chain" and process_name="AG" and department_name ="Melting" and id NOT IN (select process_id from process_groups)');

    } if((@$_GET['row'] == 'indo_tally_chain_pl_out')){
     $this->stock_summary_query('product_name="Indo tally Chain" and process_name="PL" and department_name ="Melting" and id NOT IN (select process_id from process_groups)');
    } 

  /*--------------Hollow Choco Chain Process-----------*/ 
    if((@$_GET['row'] == 'hollow_choco_chain_process')){
     $this->stock_summary_query('product_name="Hollow Choco Chain" and balance != 0');
    }

    if((@$_GET['row'] == 'hollow_choco_chain_pl_out')){
     $this->stock_summary_query('product_name="Hollow Choco Chain" and process_name="PL" and department_name ="Melting" and id NOT IN (select process_id from process_groups)');
    }
    
    if((@$_GET['row'] == 'hollow_choco_chain_dye_process')){
     $this->stock_summary_query('balance != 0');
    }

  /*--------------Round box Chain Process-----------*/ 
    if((@$_GET['row'] == 'roundbox_chain_process')){
     $this->stock_summary_query('product_name="Round Box Chain" and balance != 0');
    }
  /*--------------Imp Italy Chain Process-----------*/ 
    if((@$_GET['row'] == 'imp_italy_chain_process')){
     $this->stock_summary_query('product_name="Imp Italy Chain" and balance != 0');
    }

  if(@$_GET['row'] == 'imp_italy_chain_ag_flatting_out'){
    $this->stock_summary_query("out_weight > 0 AND id NOT IN((select parent_id from processes where product_name = 'Imp Italy Chain' and (process_name = 'Spring Process') and department_name = 'Start')) AND `product_name` = 'Imp Italy Chain' AND `department_name` = 'Issue Spring'");
    } 

  /*--------------Fancy Chain Process-----------*/ 
  if((@$_GET['row'] == 'fancy_chain_process')){
     $this->stock_summary_query('product_name="Fancy Chain" and balance != 0');
    }
  
  /*--------------Sisma Chain Process-----------*/ 
  if(@$_GET['row'] == 'sisma_chain_process'){
     $this->stock_summary_query('product_name="Sisma Chain" and balance != 0');
    }
  /*--------------Sisma Chain Process-----------*/ 
  if(@$_GET['row'] == 'arc_process'){
     $this->stock_summary_query('product_name="ARC" and balance != 0');
    }
  /*--------------Ball Chain Process-----------*/ 
  if(@$_GET['row'] == 'strip_start_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Strip Start Process" and balance != 0');
  }
  if(@$_GET['row'] == 'factory_hold_i_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Factory Hold I Process" and balance != 0');
  }
  if(@$_GET['row'] == 'plain_cutting_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Plain Cutting Process" and balance != 0');
  }
  if(@$_GET['row'] == 'rose_gold_two_tone_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Rose Gold Two Tone Process" and balance != 0');
  }
  if(@$_GET['row'] == 'rose_and_white_gold_cutting_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Rose And White Gold Cutting Process" and balance != 0');
  }
  if(@$_GET['row'] == 'yellow_and_white_gold_cutting_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Yellow And White Gold Cutting Process" and balance != 0');
  }
  if(@$_GET['row'] == 'factory_hold_plain_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Factory Hold Plain Process" and balance != 0');
  }
  if(@$_GET['row'] == 'copper_cutting_two_tone_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Copper Cutting Two Tone Process" and balance != 0');
  }
  if(@$_GET['row'] == 'factory_hold_ii_processes'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Factory Hold II Process" and balance != 0');
  }
  if(@$_GET['row'] == 'stripper_two_tone_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Stripper Two Tone Process" and balance != 0');
  }
  if(@$_GET['row'] == 'hook_plain_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Hook Plain Process" and balance != 0');
  }
  if(@$_GET['row'] == 'laser_plain_process'){
    $this->stock_summary_query('product_name="Ball Chain" and process_name="Laser Plain Process" and balance != 0');
  }
  /*--------------KA Chain Process-----------*/ 
  if(@$_GET['row'] == 'ka_chain_process'){
    $this->stock_summary_query('product_name="KA Chain" and balance != 0');
  }

  /*-------------- Office Outside -----------*/
  if(@$_GET['row'] == 'office_outside'){
     $this->stock_summary_query('product_name = "Office Outside" and balance != 0');
  }
 /*-------------- Solder Wastage Process -----------*/
  if(@$_GET['row'] == 'solder_wastage'){
     $this->stock_summary_query(' balance_solder_wastage > 0');
  }
  /*--------------Daily Drawer Wastage-----------*/
  if(@$_GET['row'] == 'daily_drawer_wastage'){
    $this->stock_summary_query("daily_drawer_wastage != 0");
  }

   /*------------ghiss----------*/   
    if(@$_GET['row'] == 'ghiss'){
     $this->stock_summary_query('ghiss!=0 OR balance_ghiss != 0');
    }
  /*-------------rope_ghiss----------*/   

    if(@$_GET['row'] == 'hcl_ghiss'){
     $this->stock_summary_query('hcl_ghiss != 0');
    }
   /*-------------Rope Ghiss Process----------*/   

    if(@$_GET['row'] == 'hcl_ghiss_process'){
     $this->stock_summary_query('product_name = "HCL Ghiss Out" and balance >0');
    } /*-------------Rope Ghiss Process----------*/   

 /*-------------Tounch Ghiss----------*/   
    if(@$_GET['row'] == 'tounch_ghiss'){
     $this->stock_summary_query('tounch_ghiss!=0');
    }
  /*-------------Pending Ghiss----------*/   
    if(@$_GET['row'] == 'pending_ghiss'){
     $this->stock_summary_query('pending_ghiss!=0');
    }
    /*-------------refine_loss----------*/   
    if(@$_GET['row'] == 'refine_loss'){
     $this->stock_summary_query('refine_loss!=0');
    }
    /*-------------repair_out----------*/   
    if(@$_GET['row'] == 'repair_out'){
     $this->stock_summary_query('repair_out!=0');
    }
 
  /*-------------Hcl Wastage----------*/   
    if(@$_GET['row'] == 'hcl_wastage'){
     $this->stock_summary_query('product_name!="Receipt" and balance_hcl_wastage!=0');
    }
  /*-------------HCL FE LOSS----------*/   
    if(@$_GET['row'] == 'hcl_fe_loss' || @$_GET['row'] == 'hcl_gross_loss' || @$_GET['row'] == 'hcl_gross_loss_issue'){
     $this->stock_summary_query('hcl_loss!=0');
    }
    /*-------------Loss Out----------*/   
    if(@$_GET['row'] == 'loss_out_process'){
     $this->stock_summary_query('product_name="Loss Out" and balance!=0');
    } /*-------------fire_tounch_out----------*/   
    if(@$_GET['row'] == 'fire_tounch_out'){
     $this->stock_summary_query('fire_tounch_out!=0 and tounch_out>0');
    }
  /*-------------fire_tounch_in----------*/
    if(@$_GET['row'] == 'fire_tounch_in'){
     $this->stock_summary_query('fire_tounch_in!=0 ');
    }
  /*-------------tounch_department_loss---------*/
    if(@$_GET['row'] == 'tounch_department_loss'){
     $this->stock_summary_query('tounch_loss_fine!=0 ');
    }
  /*-------------copper----------*/
    if(@$_GET['row'] == 'copper'){
     $this->stock_summary_query('copper_in!=0 OR copper_out!=0 ');
    }
  /*-------------liquor_stock----------*/
    if(@$_GET['row'] == 'liquor_stock'){
     $this->stock_summary_query('liquor_in!=0 OR liquor_out!=0 ');
    }
     /*--------------Ring Process-----------*/ 
    if((@$_GET['row'] == 'ring_process')){
     $this->stock_summary_query('product_name="Ring" and balance != 0');

    } 
    /*--------------Pendant Process-----------*/ 
    if((@$_GET['row'] == 'pendant_process')){
     $this->stock_summary_query('product_name="Pendant" and balance != 0');

    }
    /*--------------Pendent set plain Process-----------*/ 
    if((@$_GET['row'] == 'pendent_set_plain_process')){
     $this->stock_summary_query('product_name="Pendent Set Plain" and balance != 0');

    } 
     /*--------------Pendent set 75 Process-----------*/ 
    if((@$_GET['row'] == 'pendent_set_75_process')){
     $this->stock_summary_query('product_name="Pendent Set 75" and balance != 0');

    }
    /*--------------Pendent set Process-----------*/ 
     if((@$_GET['row'] == 'pendent_set_process')){
     $this->stock_summary_query('product_name="Pendent Set" and balance != 0');

    }
    /*--------------Stone Ring 92 Process-----------*/ 
     if((@$_GET['row'] == 'stone_ring_92_process')){
     $this->stock_summary_query('product_name="Stone Ring 92" and balance != 0');

    } /*--------------Stone Ring 75 Process-----------*/ 
     if((@$_GET['row'] == 'stone_ring_75_process')){
     $this->stock_summary_query('product_name="Stone Ring 75" and balance != 0');

    }  /*--------------Plain Ring Process-----------*/ 
     if((@$_GET['row'] == 'plain_ring_process')){
     $this->stock_summary_query('product_name="Plain Ring" and balance != 0');

    } 
    /*--------------Chain 92 Process-----------*/ 
     if((@$_GET['row'] == 'chain_92_process')){
     $this->stock_summary_query('product_name="Chain 92" and balance != 0');

    }
    /*--------------Chain 75 Process-----------*/ 
     if((@$_GET['row'] == 'chain_75_process')){
     $this->stock_summary_query('product_name="Chain 75" and balance != 0');

    }
  /*--------------Lock Process-----------*/ 
     if((@$_GET['row'] == 'lock_process_process')){
     $this->stock_summary_query('product_name="Lock Process" and balance != 0');
   }
/*--------------Hand MAde Chain Process-----------*/ 
     if((@$_GET['row'] == 'hand_made_chain_process')){
     $this->stock_summary_query('product_name="Hand Made Chain" and balance != 0');

    } 
  }

  private function issue_summary_old(){ 
 /*--------------issue_department-----------*/
    if( @$_GET['row'] == 'issue_department'){
      $this->stock_summary_query("issue_gpc_out!=0");
    }
    if( @$_GET['row'] == 'issue_department_melting_wastage'){
      $this->stock_summary_query("issue_melting_wastage!=0");
    }
    if( @$_GET['row'] == 'issue_department_daily_drawer_wastage'){
      $this->stock_summary_query("issue_daily_drawer_wastage!=0");
    }
    if( @$_GET['row'] == 'issue_hcl_loss'){
      $this->stock_summary_query("issue_hcl_loss!=0");
    }if( @$_GET['row'] == 'issue_tounch_loss_fine'){
      $this->stock_summary_query("issue_tounch_loss_fine!=0");
    }if( @$_GET['row'] == 'issue_ghiss'){
      $this->stock_summary_query("issue_ghiss!=0");
    }if( @$_GET['row'] == 'issue_daily_drawer'){
      $this->stock_summary_query("in_weight!=0 and `product_name` = 'Issue' AND `process_name` = 'Daily Drawer Issue'");
    }if( @$_GET['row'] == 'refresh_rnd_issue'){
      $this->stock_summary_query("out_weight!=0 and `product_name` = 'RND' AND `process_name` = 'RND Issue'");
    }if( @$_GET['row'] == 'issue_fe'){
      $this->stock_summary_query("(fe_out+wastage_fe)!=0");
    }

  }


  private function stock_summary_query($conditions='') {
//pd($conditions);
     // if(@$_GET['type_of'] == 'opening'){
     //  $this->where = 'created_at <"'.$_GET['start_date'].'"';
     //  }
     //  if(@$_GET['type_of'] == 'in_weight' || @$_GET['type_of'] == 'out_weight'){
     //  $this->where = 'created_at >="'.$_GET['start_date'].'" and created_at <"'.$_GET['end_date'].'"';
     //  }

     //  if(@$_GET['type_of'] == 'balance'||@$_GET['type_of'] == 'balance_gross'||@$_GET['type_of'] == 'balance_fine'){
     //  $this->where = 'created_at <="'.$_GET['end_date'].'"';
     //  }
      
      if($conditions!=''){
         $this->where=$conditions;
      }
  }
}
