<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_reports extends BaseController {
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

    $sql="(select 'Melting' as department_name,'Melting,AG Melting,PL Melting' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Melting','AG Melting','PL Melting'))
                      UNION
          (select 'Tarpatta' as department_name,'Flatting,AU+FE,Rolling,Bull Block,Strip Cutting,Tarpatta,14/14,Wire Drawing,Final,Issue Spring' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Flatting','AU+FE','Rolling','Bull Block','Strip Cutting','Tarpatta','14/14','Wire Drawing','Final','Issue Spring'))
                      UNION
          (select 'Shampoo' as department_name,'Shampoo,Shampoo II,Steel Vibrator,Steel Vibrator II,Strip Cutting,Magnet,GPC,R/D' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Shampoo','Shampoo II','Steel Vibrator','Steel Vibrator II','Strip Cutting','Magnet','GPC','R/D'))
                      UNION
          (select 'Spring' as department_name,'Spring,Spring Department' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Spring','Spring Department'))
                      UNION
          (select 'Chain Making' as department_name,'Chain Making,Joinning' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Chain Making','Joinning'))
                      UNION
          (select 'Hand Cutting' as department_name,'Hand Cutting' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Hand Cutting'))
                      UNION
          (select 'Hand Dull' as department_name,'Hand Dull' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Hand Dull'))
                      UNION
          (select 'Cutting' as department_name,'Cutting' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Cutting'))
                      UNION
          (select 'Refresh' as department_name,'Refresh Hold,Refresh-Repairing,GPC,Buffing,Factory Hold,Hand Dull,Hand Cutting' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and process_name in ('Refresh'))
                      UNION
          (select 'RND' as department_name,'Start' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and product_name in ('RND'))
                      UNION
          (select 'Buffing' as department_name,'Buffing' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Buffing'))
                      UNION
          (select 'Stamping' as department_name,'Stamping' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Stamping'))
                      UNION
          (select 'HCL' as department_name,'HCL,Tounch,ReHcl,Casting,HCL Process' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('HCL','Tounch','ReHcl','Casting','HCL Process'))
                      UNION
          (select 'Walnut' as department_name,'Walnut' as department_names,sum(balance_gross) as balance_gross 
                      ,sum(balance_fine) as balance_fine FROM processes WHERE `balance` != 0 and department_name in ('Walnut'))
                      UNION
                      (select 'Ghiss' as department_name,'Ghiss' as department_names,sum(balance_ghiss * wastage_purity /100) as balance_gross 
        ,sum(balance_ghiss * wastage_purity /100 * wastage_lot_purity / 100) as balance_fine FROM processes)
        UNION

        (select 'Pending Ghiss' as department_name,'Pending Ghiss' as department_names,
               sum(pending_ghiss * wastage_purity / 100) - (select sum(ghiss * wastage_purity / 100) from processes where product_name = 'Pending Ghiss Out'  AND process_name = 'Pending Ghiss Out') as balance_gross,
              sum(pending_ghiss * wastage_purity / 100 * wastage_lot_purity / 100) - (select sum(ghiss * wastage_purity / 100 * wastage_lot_purity / 100)    from processes where product_name = 'Pending Ghiss Out' AND process_name = 'Pending Ghiss Out') as balance_fine FROM processes

        )
      
        UNION
        (select 'Rope Ghiss' as department_name,'Rope Ghiss' as department_names,
              sum(balance_hcl_ghiss * wastage_purity /100) as balance_gross 
        ,sum(balance_hcl_ghiss * wastage_purity /100 * wastage_lot_purity /100) as balance_fine FROM processes)

        UNION
        (select 'HCL wastage' as department_name,'HCL wastage' as department_names,sum(balance_hcl_wastage * wastage_purity /100) as balance_gross 
        ,sum(balance_hcl_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes WHERE product_name != 'Receipt')

        UNION
        (select 'Melting Wastage' as department_name,'Melting Wastage' as department_names,sum(balance_melting_wastage) as balance_gross 
        ,sum(balance_melting_wastage * wastage_lot_purity /100 ) as balance_fine FROM processes where product_name != 'Receipt' AND product_name != 'Chain Receipt')

        UNION

        (select 'Metal' as department_name,'Metal' as department_names,sum(balance_melting_wastage) as balance_gross 
        ,sum(balance_melting_wastage * wastage_lot_purity /100) as balance_fine FROM processes where product_name = 'Receipt')

        UNION
        (select 'Daily Drawer Balance' as department_name,'Daily Drawer Balance' as department_names,sum(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance_gross 
        ,sum((daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) * hook_kdm_purity / 100) as balance_fine FROM processes where type!='GPC Powder')

        UNION
        (select 'Daily drawer wastage' as department_name,'Daily drawer wastage' as department_names,sum(balance_daily_drawer_wastage) as balance_gross 
        ,sum(balance_daily_drawer_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as balance_fine FROM processes)

        UNION
        (select 'Tounch In' as department_name,'Tounch In' as department_names,sum(tounch_in - tounch_ghiss - tounch_out) as balance_gross 
        ,sum((tounch_in - tounch_ghiss - tounch_out) * wastage_lot_purity / 100) as balance_fine FROM processes WHERE tounch_in > 0)

        UNION

        (select 'Fire Tounch In' as department_name,'' as department_names,sum(fire_tounch_in-fire_tounch_out - fire_tounch_gross) as balance_gross 
        ,sum((fire_tounch_in-fire_tounch_out - fire_tounch_gross) * wastage_lot_purity / 100) as balance_fine FROM processes WHERE fire_tounch_in != 0)
        UNION
        (select 'Tounch Out'  as department_name,'Tounch Out' as department_names,sum(balance_tounch_out) as balance_gross 
        ,sum(balance_tounch_out * tounch_purity / 100) as balance_fine FROM processes)
        UNION

        (select 'GPC Out'  as department_name,'GPC Out' as department_names,sum(balance_gpc_out) as balance_gross 
        ,sum((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_fine FROM processes)


        UNION

         (select 'GPC Powder' as department_name,'GPC Powder' as department_names,sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight))) as balance_gross,
            sum((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) * hook_kdm_purity / 100) as balance_fine FROM processes where type='GPC Powder')

       UNION

        (select 'GPC Powder Issue' as department_name,'GPC Powder Issue' as department_names, (-1 * sum(in_weight)) as balance_gross, (-1 * sum(in_weight * in_purity / 100)) as balance_fine
            from issue_departments where product_name = 'GPC Powder')";
          
  	$query  = $this->db->query($sql);
  	$base_balance = $query->result_array();
  	
  	$this->data['record']['process_data'] = $base_balance;
  																			  									
  }
}