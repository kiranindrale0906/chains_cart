<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_wastage_views extends BaseController {	
	public function __construct(){
	 parent::__construct();
	 $this->load->model(array('processes/process_model', 'processes/process_field_model',
                              'daily_drawers/daily_drawer_receipt_model'));
  }  
  public function index() {
    $this->data['column'] = (isset($_GET['column']) ? $_GET['column'] : '');
    
    if($_GET['column']=='in_weight'){
      $where=array('daily_drawer_wastage !='=>0);
    }
    if($_GET['column']=='out_weight'){
      $where=array('out_daily_drawer_wastage !='=>0);
    }
    if(!empty($_GET['type'])){
      $where['process_name!=']=$_GET['type'];
    }

    if($_GET['column']=='balance'){
      $where=array('daily_drawer_wastage !='=>0);
    }

    if($_GET['column']=='issue_weight'){
      $where=array('issue_daily_drawer_wastage !='=>0);
    }
    if(!empty($_GET['chain_name'])){
      $where['chain_name']=str_replace('_',' ',$_GET['chain_name']);
    }
    if(isset($_GET['tone'])){
        $where['tone']=!empty($_GET['tone'])? str_replace('_',' ',$_GET['tone']):'';
    }
    if(!empty($_GET['purity'])){
      if($_GET['purity']==83.65){
        $where['hook_kdm_purity >']=80;
         $where['hook_kdm_purity<']=85;
      }elseif($_GET['purity']==87.65){
        $where['hook_kdm_purity >']=86;
         $where['hook_kdm_purity<']=88;
      }elseif($_GET['purity']==92){
         $where['hook_kdm_purity >']=88;
         $where['hook_kdm_purity<']=100;
      }elseif($_GET['purity']==100){
         $where['hook_kdm_purity']=100;
      }else{
        $where['hook_kdm_purity <']=80;
      }
    }
    if(!empty($_GET['category']) && $_GET['category']==1){
      if($_GET['purity']!=100){
        if (HOST == 'ARF') {
          $processes_and_departments = '(   process_name in ("Box Start Process", "Box Chain Process", "Anchor Start Process", "Anchor Process", "ARF KDM","Strip Start Process")
                                         or (process_name = "Shook"  and department_name in ("Melting", "Tar Making"))
                                         or (process_name = "Cap"    and department_name in ("Melting", "Flatting"))
                                         or (process_name = "Pipe"   and department_name in ("Melting", "Flatting", "Pipe Making"))
                                         or (process_name = "Lasiya" and department_name in ("Melting", "Tarpatta", "Box Tar Chain"))
                                         or (process_name = "Para"   and department_name in ("Melting", "Flatting", "Pipe And Para Making"))
                                         or (product_name = "Daily Drawer" and process_name = "Melting")
                                         or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Melting", "Flatting"))
                                         or (product_name = "Solder Wastage" and process_name = "Melting")
                                         or (product_name = "Tounch Out" and process_name = "Melting"))';
          $where[$processes_and_departments] = NULL;
        }
        else 
          
            $where['department_name']='Hook';
      }
    }elseif(!empty($_GET['category']) && $_GET['category']==2){
      if (HOST == 'ARF') {
        $processes_and_departments = '( process_name in ("Vishnu Process", "Laser Process",
                                                       "Hammering Process", "Ashish Process", 
                                                       "Hammering II Process", 
                                                       "CNC Process", "DC Process", "Round and Ball Chain Process",
                                                       "CNC Recutting Process", "DC Recutting Process", "Round and Ball Chain Recutting Process",
                                                       "Factory Process","Factory Hold I Process",
                                                       "Factory Hold Plain Process","Rose Gold Two Tone Process",
                                                       "Rose And White Gold Cutting Process",
                                                       "Stripper Two Tone Process","Yellow And White Gold Cutting Process","Plain Cutting Process",
                                                       "Laser Plain Process","Copper Cutting Two Tone Process")
                                      or (process_name = "Shook" and department_name = "Round and Ball Chain")
                                      or (process_name = "Pipe"  and department_name = "Diamond Cutting")
                                      or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Hammering I"))
                                      or (process_name = "Para"  and department_name in ("Dull", "Round and Ball Chain", "Hand Cutting", "Final")))';
      $where[$processes_and_departments] = NULL;
      }
      else 
        $where['department_name']='Hook';
    }elseif(!empty($_GET['category']) && $_GET['category']==3){
      if (HOST == 'ARF') {
        $processes_and_departments = '(   product_name = "Fancy Chain"
                                       or process_name in ("Hook Process", "Refresh","Hook Plain Process")
                                       or (process_name = "Shook"     and department_name = "S Making")
                                       or (process_name = "Cap"       and department_name = "Stamping")
                                       or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Stamping", "Chain Making"))
                                       or (process_name = "Ghiss Out" and department_name = "Melting"))';
        $where[$processes_and_departments] = NULL;
      } else 
        $where['department_name!=']='Hook';

    }

    $this->data['wastage_weights']=$this->process_model->get('lot_no,
                                                               product_name,
                                                               process_name,
                                                               department_name,
                                                               process_name,
                                                               created_at,
                                                               karigar,daily_drawer_wastage as in_weight,
                                out_daily_drawer_wastage as out_weight,
                                issue_daily_drawer_wastage as issue_weight,
                                balance_daily_drawer_wastage as balance,
                                (balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine,
                                hook_kdm_purity',$where,array(),array('order_by'=>'created_at desc')
                               );

 
    $this->load->render('daily_drawers/daily_drawer_wastage_views/index', $this->data);
  }
}

 
  
