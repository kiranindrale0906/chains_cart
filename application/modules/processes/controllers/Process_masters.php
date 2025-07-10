<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_masters extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
  }


  public function index(){
  	if(isset($_GET['where'])) $where =  json_decode($_GET['where'],true);
  	else $where = array();
  	$this->get_records($where);
//    $this->data['in_lot_purity'] = $this->process_model->get('DISTINCT(in_lot_purity) as name,in_lot_purity as id');
  	parent::view(1);
  }

  public function _get_form_data(){
  	if(isset($_GET['where'])) $where =  json_decode($_GET['where'],true);
  	else $where = array();
  	$this->get_records($where);
  }

  private function get_records($where=array()){
  	if(isset($_GET['where'])) $where =  json_decode($_GET['where'],true);
  	else $where = array();
//    if(isset($_GET['in_lot_purity'])) $where_inlotpurity = array('in_lot_purity'=>$_GET['in_lot_purity']);
//    else $where_inlotpurity = array();
  	$where = array_merge(array('balance !='=>0,'product_name not in ("Office Outside","Stone Transfer")'=>NULL),$where);

    // UNION

    //                   (select 'Alloy' as product_name,sum(alloy_weight - out_alloy_weight) - (select sum(alloy_weight) from melting_lots) as balance_gross 
    //                   ,'0.000' as balance_fine FROM processes)

    //                   UNION

    //                   (select 'Alloy Vodatar' as product_name, '0.0000' as balance_gross 
    //                   ,0-sum(alloy_vodatar*lot_purity/100) as balance_fine FROM melting_lots)

    // (select 'Pending Loss' as product_name,sum(balance_loss * wastage_purity / 100) as balance_gross,
    //                           sum(balance_loss * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes where pending_loss!=0)

    //                      UNION

    //UNION

    //                  (select 'Copper' as product_name, sum(copper_out) as balance_gross , sum(copper_out * in_lot_purity / 100) as balance_fine FROM processes)

    // UNION

    //                   (select 'Stone Vatav' as product_name,
    //                       sum(out_stone_vatav * in_purity / 100) as balance_gross,
    //                       sum(out_stone_vatav * in_purity / 100 * in_lot_purity / 100) as balance_fine FROM processes)

    $sql="
                      (select product_name,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and product_name!='Office Outside' and product_name!='RND'  GROUP BY `product_name` ) 

                      UNION

                      (select 'Daily drawer wastage' as product_name,sum(balance_daily_drawer_wastage) as balance_gross 
                      ,sum(balance_daily_drawer_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes)

                      UNION

                      (select 'Ghiss' as product_name,sum(balance_ghiss * wastage_purity /100) as balance_gross 
                      ,sum(balance_ghiss * wastage_purity /100 * wastage_lot_purity / 100) as balance_fine FROM processes)
                    
                      UNION
                    
                      (select 'Solder Wastage Balance' as product_name,sum(balance_solder_wastage * wastage_purity / 100) as balance_gross,
                          sum(balance_solder_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes where balance_solder_wastage!=0)

                      UNION

                      (select 'Office Outside' as product_name, sum(balance_gross) as balance_gross, sum(balance_fine) as balance_fine FROM `processes` WHERE `product_name` = 'Office Outside' AND process_name not like 'Pipe and Para%' AND `process_name` not IN('Imp Italy Dye Process', 'Hollow Choco Dye Process', 'Choco Chain Dye Process') AND `balance` != 0)

                     UNION

                      (SELECT 'Melting Wastage Fine Diff' as product_name,'' as balance_gross,  sum((melting_lot_details.required_weight * (processes.wastage_lot_purity - melting_lot_details.in_purity)/ 100)) as balance_fine FROM `melting_lot_details` INNER JOIN `processes` ON `processes`.`id`=`melting_lot_details`.`process_id`)

                     UNION

                      (select 'GPC Powder' as product_name,sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight))) as balance_gross,
                          sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) * hook_kdm_purity / 100) as balance_fine FROM processes where type='GPC Powder')

                     UNION

                      (select 'GPC Powder Issue' as product_name, (-1 * sum(in_weight)) as balance_gross, (-1 * sum(in_weight * in_purity / 100)) as balance_fine
                          from issue_departments where product_name = 'GPC Powder')
                    
                      UNION

                      (select 'Rope Ghiss' as product_name,
                            sum(balance_hcl_ghiss * wastage_purity /100) as balance_gross 
                      ,sum(balance_hcl_ghiss * wastage_purity /100 * wastage_lot_purity /100) as balance_fine FROM processes)

                      UNION

                      (select 'Loss' as product_name, sum(balance_loss * wastage_purity /100) as balance_gross 
                      ,sum(balance_loss * wastage_purity /100 * wastage_lot_purity /100) as balance_fine FROM processes WHERE product_name != 'Ghiss Out')

                      UNION

                      (select 'Ghiss Loss' as product_name, sum(balance_loss * wastage_purity /100) as balance_gross 
                      ,sum(balance_loss * wastage_purity /100 * wastage_lot_purity /100) as balance_fine FROM processes WHERE product_name = 'Ghiss Out')

                      UNION

                      (select 'Melting Wastage' as product_name,sum(balance_melting_wastage) as balance_gross 
                      ,sum(balance_melting_wastage * wastage_lot_purity /100 ) as balance_fine FROM processes where product_name != 'Receipt' AND product_name != 'Chain Receipt' and product_name != 'Hallmark Receipt')

                      UNION

                      (select 'Metal' as product_name,sum(balance_melting_wastage) as balance_gross 
                      ,sum(balance_melting_wastage * wastage_lot_purity /100) as balance_fine FROM processes where product_name = 'Receipt')

                      UNION

                      (select 'Refine Loss' as product_name,sum(refine_loss) as balance_gross 
                      ,sum(refine_loss * in_lot_purity / 100) as balance_fine FROM processes)

                      UNION

                      (select 'HCL wastage' as product_name,sum(balance_hcl_wastage * wastage_purity /100) as balance_gross 
                      ,sum(balance_hcl_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes WHERE product_name != 'Receipt')

                      UNION

                      (select 'Tounch In' as product_name,sum(tounch_in - tounch_ghiss - tounch_out) as balance_gross 
                      ,sum((tounch_in - tounch_ghiss - tounch_out) * wastage_lot_purity / 100) as balance_fine FROM processes WHERE tounch_in > 0)

                      UNION

                      (select 'Fire Tounch In' as product_name,sum(fire_tounch_in-fire_tounch_out - fire_tounch_gross) as balance_gross 
                      ,sum((fire_tounch_in-fire_tounch_out - fire_tounch_gross) * wastage_lot_purity / 100) as balance_fine FROM processes WHERE fire_tounch_in != 0)

                      UNION

                      (select 'Daily Drawer Balance' as product_name,sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance_gross 
                      ,sum((daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) * hook_kdm_purity / 100) as balance_fine FROM processes where type!='GPC Powder')

                      UNION

                      (select 'RND' as product_name, 
                              sum(in_weight) - (select IFNULL(sum(in_weight),0) from processes where process_name = 'RND Issue') as balance_gross,
                              sum(in_weight* in_purity / 100  * in_lot_purity / 100) - (select IFNULL(sum(in_weight* in_purity / 100  * in_lot_purity / 100),0) FROM processes where process_name = 'RND Issue') as balance_fine FROM processes WHERE process_name = 'RND Receipt')

                       UNION

                      (select 'GPC Out' as product_name,sum(balance_gpc_out) as balance_gross 
                      ,sum((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_fine FROM processes)


                      UNION

                      (select 'HCL loss' as product_name,sum(balance_hcl_loss) as balance_gross 
                      ,sum(balance_hcl_loss * in_lot_purity / 100) as balance_fine FROM processes)  

                      UNION

                      (select 'Tounch Out' as product_name,sum(balance_tounch_out) as balance_gross 
                      ,sum(balance_tounch_out * tounch_purity / 100) as balance_fine FROM processes)
                      UNION

                      (select 'Chain Receipt Summary' as product_name, sum(balance_melting_wastage) as balance_gross, sum(balance_melting_wastage * wastage_lot_purity / 100) as balance_fine FROM `processes` WHERE `product_name` = 'Chain Receipt' )

                      UNION

                      (select 'Tounch Ghiss' as product_name,sum(balance_tounch_ghiss) as balance_gross 
                      ,sum(balance_tounch_ghiss * tounch_purity / 100) as balance_fine FROM processes)

                      UNION

                      (select 'Pending Ghiss' as product_name,
                             sum(pending_ghiss * wastage_purity / 100) - (select sum(ghiss * wastage_purity / 100) 
                                                                             from processes where product_name = 'Pending Ghiss Out' 
                                                                                                  AND process_name = 'Pending Ghiss Out') as balance_gross,
                            sum(pending_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) - (select sum(ghiss * wastage_purity / 100 * wastage_lot_purity / 100) 
                                                                                                        from processes 
                                                                                                        where product_name = 'Pending Ghiss Out' AND process_name = 'Pending Ghiss Out') as balance_fine FROM processes

                      )
                      
                      UNION

                      (select 'Tounch Department Loss' as product_name, '0.0000' as balance_gross 
                      ,sum(balance_tounch_loss_fine) as balance_fine FROM processes)
                      ";
    if(HOST=='ARF'){
      $sql=$sql."UNION (SELECT 'Pipe and Para Process' as product_name, sum(balance_gross) as balance_gross, sum(balance_fine) as balance_fine FROM `processes` WHERE `product_name` ='Office Outside' AND process_name like 'Pipe and Para%' AND `balance` != 0 AND `processes`.`is_delete` != 1)
       UNION
      (select 'Dhoom A' as product_name,sum(balance) as balance_gross 
      ,sum((balance) * in_lot_purity / 100) as balance_fine FROM processes WHERE balance != 0 and product_name='Dhoom A')
      UNION
      (select 'Dhoom B' as product_name,sum(balance) as balance_gross 
      ,sum((balance) * in_lot_purity / 100) as balance_fine FROM processes WHERE balance != 0 and product_name='Dhoom B')
      UNION
      (select 'Dhoom A Factory Hold' as product_name,  sum(out_weight * out_purity / 100) as balance_gross, sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine FROM `processes` WHERE id NOT IN((select parent_id from processes where product_name = 'KA Chain' and process_name = 'Factory Hold Process' and department_name = 'Start')) AND `product_name` = 'Dhoom A' AND `department_name` = 'Factory Hold' AND `process_name` = 'Dhoom A' )

    ";
    }elseif(HOST=='ARC'){
    }else{
      $sql=$sql." UNION (select 'Choco Chain Dye Process' as product_name,sum(balance_gross) as balance_gross, sum(balance_fine) as balance_fine FROM `processes` WHERE `product_name` = 'Office Outside' AND `process_name` = 'Choco Chain Dye Process' AND `balance` != 0 AND `processes`.`is_delete` != 1)
        UNION 
        (select 'Hollow Choco Dye Process' as product_name,sum(balance_gross) as balance_gross, sum(balance_fine) as balance_fine FROM `processes` WHERE `product_name` = 'Office Outside' AND `process_name` = 'Hollow Choco Dye Process' AND `balance` != 0 AND `processes`.`is_delete` != 1)
         UNION 
        (select 'Imp Dye Process' as product_name,sum(balance_gross) as balance_gross, sum(balance_fine) as balance_fine FROM `processes` WHERE `product_name` = 'Office Outside' AND `process_name` = 'Imp Italy Dye Process' AND `balance` != 0 AND `processes`.`is_delete` != 1)";
    }
  	$query  = $this->db->query($sql);

    // UNION

    //   (select 'Choco Chain Machine Out' as product_name,
    //       sum(out_weight * out_purity / 100) as balance_gross ,
    //       sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine 
    //       FROM processes 
    //       WHERE id 
    //     NOT IN (select parent_id from processes where product_name = 'Choco Chain' and process_name IN ('Final Process','Imp Final Process','Casting Final Process') and parent_id IS NOT NULL and department_name = 'Start') AND product_name = 'Choco Chain' AND department_name = 'Chain Making' AND process_name = 'Machine Process')

    /*select 'Choco Chain Machine Out' as product_name,sum(out_weight * out_purity / 100) as balance_gross ,sum(out_weight * out_purity / 100 * out_lot_purity / 100) as balance_fine FROM processes WHERE id NOT IN (select parent_id from processes where product_name = 'Choco Chain' and process_name NOT IN ('Final Process','Imp Final Process') and parent_id IS NOT NULL and department_name = 'Start')*/

    // -1 * sum(copper_in-copper_out)
     // (select 'GPC Powder Issue' as product_name,sum(in_weight) as balance_gross,
     //                      sum(in_weight) as balance_fine FROM issue_departments where product_name='GPC Powder')

     //                 UNION
  	$base_balance = $query->result_array();
  	
  	$this->data['record']['process_data'] = $base_balance;
  																			  									
  }
}