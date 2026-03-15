<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packing_detail_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','processes/process_field_model','issue_departments/issue_department_model','settings/city_model','reports/gpc_out_city_report_model'));
  }

  public function index() { 
    $this->data['record']['from_date']  = (!empty($_GET['from_date'])) ? date('Y-m-d',strtotime($_GET['from_date'])) : '';
    $this->data['record']['to_date'] = (!empty($_GET['to_date'])) ? date('Y-m-d',strtotime($_GET['to_date'])) :'';
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  
      $where_lock=array('processes.product_name ="Lock Process"'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_lock['date(process_details.created_at) >=']=$this->data['record']['from_date'];
        $where_lock['date(process_details.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['lock_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_lock,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - - - - - - - - - - - - - - Lock Process-Gpc out =sum- - - - - - - - - - - - - - -   
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  
      $where_finish_goods=array('processes.process_name ="Finish Good Process"'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_finish_goods['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_finish_goods['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['finish_goods']=$this->process_model->find('sum(processes.balance) as weight',$where_finish_goods);
  //- - - - - - - - - - - - - - - - - - - - Finish Goods - - - - - - - - - - - - - -   

      $where_lock_wip=array('processes.product_name ="Lock Process" and processes.department_name ="Lock Filing"'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_lock_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_lock_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      
      $this->data['lock_wips']=$this->process_model->find('sum(processes.balance) as weight',$where_lock_wip);

  //- - - - - - - - - - - - - - - - - - - - Lock Process-LOCK FILING DEP.BALANCE =sum- - - - - - - 
      $where_lock_casting=array('processes.product_name ="Lock Process" and processes.department_name in ("Melting","Casting")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_lock_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_lock_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }

      $this->data['lock_castings']=$this->process_model->find('sum(processes.balance_melting_wastage) as weight',$where_lock_casting);
  //- - - - - - - - - - - - - - - - - - SUM=LOCK PROCESS-MELTING WASTAGE+MELTING DEP+CASTING DEPARTMENT - - - - - - 

      
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  

    $where=array('processes.product_name'=>"ARC Chain",'processes.process_name'=>"GPC Process","process_details.city"=>"CHAIN ARG");

    if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
      $where['date(processes.created_at) >=']=$this->data['record']['from_date'];
      $where['date(processes.created_at) <=']=$this->data['record']['to_date'];
    }
     $this->data['chain_arg_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - - - -sum(gpc out)-ARC Chain ->gpc process->gpc->with city name(CHAIN ARG) - - - - -
  
      $where_chain_wip=array('processes.melting_lot_category_one in ("INTERNAL CHAIN")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_chain_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_chain_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['chain_arg_wips']=$this->process_field_model->find('sum(processes.balance) as weight',$where_chain_wip,array(array('processes',  'process_details.process_id=processes.id')));
    
  //- - - - - - - - - - - - - - SUM=CAT-(INTERNAL CHAIN) BALANCE - - - - -  - - - - - - - - - - - 
      $where_chain_casting=array('processes.department_name in ("Casting","Melting") and processes.tone="pink"'=>NULL);
      $where_chain_casting['processes.in_lot_purity >'] = '74';
      $where_chain_casting['processes.in_lot_purity <'] = '76';
      
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_chain_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_chain_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $chain_arg_castings=$this->process_field_model->find('sum(processes.balance_melting_wastage) as weight',$where_chain_casting,array(array('processes',  'process_details.process_id=processes.id')));
      $this->data['chain_arg_castings']['weight']=0;
      if((!empty($chain_arg_castings['weight'])&&$chain_arg_castings['weight']!=0)){
	//pd($chain_arg_casting);
        $this->data['chain_arg_castings']['weight']=($chain_arg_castings['weight'])-((50/$chain_arg_castings['weight'])*100);
      
}
  //- - - - - - - - - - - - - - SUM=MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 75 PINK TOTAL BALANCE/50% - - - - -  - - - - - - - - - - -
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -    

     $where_chain_am=array('process_details.city in ("CHAIN AM","AQUA GOLD","SUMO BRC")'=>NULL);
     if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_chain_am['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_chain_am['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['chain_am_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_chain_am,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - - - - - - - -sum(gpc out)->gpc process->gpc->with city name(CHAIN AM+SUMO BRC+AQUA GOLD) - - - - -  - - - - - - - - - - -
  
     $where_chain_am_wip=array('processes.melting_lot_category_one in ("SUMO CHAIN","AQUA GOLD","SPRING KADA","SUMO BRC","SUMO BANGELES","CHAIN")'=>NULL);
     if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_chain_am_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_chain_am_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['chain_am_wips']=$this->process_field_model->find('sum(processes.balance) as weight',$where_chain_am_wip,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - - - - - - - SUM=CAT-(SUMO CHAIN+AQUA GOLD+SPRING KADA+SUMO BRC+SUMO BANGELES+CHAIN) BALANCE- - - - -  - - - - - - - - - - -

      $where_chain_am_casting=array('processes.product_name in ("Arc 92 Chain","Arc 75 Chain") and processes.department_name in ("Melting","Casting") and processes.tone="pink"'=>NULL);
      $where_chain_am_casting['processes.in_lot_purity >'] = '74';
      $where_chain_am_casting['processes.in_lot_purity <'] = '76';
     
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_chain_am_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_chain_am_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $chain_am_castings=$this->process_field_model->find('sum(processes.balance_melting_wastage) as weight',$where_chain_am_casting,array(array('processes',  'process_details.process_id=processes.id')));
      $this->data['chain_am_castings']['weight']=0;
      if((!empty($chain_am_castings['weight'])&&$chain_am_castings['weight']!=0)){
      $this->data['chain_am_castings']['weight']=($chain_am_castings['weight'])-(($chain_am_castings['weight'])/2);
      }
  //- - - - - - - - - - - - - - - - - - - - SUM=PROCESS ARC CHAIN-MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 75 PINK TOTAL BALANCE/2- - - - - - - - - - - - - - - - - - - - - - - - - 

  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

      $where_ornament=array('process_details.city in ("ORNAMENTS (PINK)")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['ornament_75_pink_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_ornament,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - - sum(gpc out)->gpc process->gpc->with city name -ORNAMENTS(PINK)- - - - - - - - -
      $where_ornament_wip=array('processes.tone'=>"pink",'processes.melting_lot_category_one not in  ("SUMO CHAIN","AQUA GOLD","SPRING KADA","SUMO BRC","SUMO BANGELES","CHAIN","KUWAITI","PLAIN PARA","PARA","CZ PARA")'=>NULL);
      $where_ornament_wip['processes.in_lot_purity >'] = '74';
      $where_ornament_wip['processes.in_lot_purity <'] = '76';
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }

      $this->data['ornament_75_pink_wips']=$this->process_model->find('sum(processes.balance) as weight',$where_ornament_wip);

       
  //- - - - - - - SUM=CAT-NOT(SUMO CHAIN+AQUA GOLD+SPRING KADA+SUMO BRC+SUMO BANGELES+KUWAITI+PARA+CHAIN)-PURITY 75 PINK- BALANCE- - - - - - - - -  - - - - - - - - - - - - - -
      $where_ornament_casting=array('processes.product_name in ("Arc 92 Ornament","Arc 75 Ornament") and processes.department_name in ("Melting","Casting")'=>NULL,'processes.tone'=>"pink");
      $where_ornament_casting['processes.in_lot_purity >'] = '74';
      $where_ornament_casting['processes.in_lot_purity <'] = '76';
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['ornament_75_pink_castings']=$this->process_field_model->find('sum(processes.balance_melting_wastage) as weight',$where_ornament_casting,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - SUM=PROCESS ARC ORNAMENT-MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 75 PINK TOTAL BALANCE - - - - - - -  - - - - - - - - - - - - - -
 
      
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

      $where_ornament_yellow=array('process_details.city in ("ORNAMENTS (YELLOW)")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament_yellow['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament_yellow['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['ornament_yellow_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_ornament_yellow,array(array('processes',  'process_details.process_id=processes.id')));

  //- - - - - - - sum(gpc out)->gpc process->gpc->with city name -ORNAMENTS(YELLOW)- - - - - - -  - -
      $where_ornament_yellow_wip=array('processes.tone'=>"yellow",'processes.melting_lot_category_one not in  ("SUMO CHAIN","AQUA GOLD","SPRING KADA","SUMO BRC","SUMO BANGELES","CHAIN","KUWAITI","PLAIN PARA","PARA","CZ PARA")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament_yellow_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament_yellow_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }

      $this->data['ornament_yellow_wips']=$this->process_model->find('sum(processes.balance) as weight',$where_ornament_yellow_wip);

  //- - - - - - - SUM=CAT-NOT(SUMO CHAIN+AQUA GOLD+SPRING KADA+SUMO BRC+SUMO BANGELES+KUWAITI+PARA+CHAIN)PURITY-92+75YELLOW BALANCE- - - - - - -  - - 
      $where_ornament_yellow_casting=array('processes.product_name in ("Arc 92 Ornament","Arc 75 Ornament") and processes.department_name in ("Melting","Casting")'=>NULL,'processes.tone'=>"yellow");
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_ornament_yellow_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_ornament_yellow_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['ornament_yellow_castings']=$this->process_field_model->find('sum(processes.balance_melting_wastage) as weight',$where_ornament_yellow_casting,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - SUM=PROCESS ARC ORNAMENT-MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 92+75 YELLOW TOTAL BALANCE - - - - - - -  - -
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
      
      $where_kuwaities=array('process_details.city in ("KUWAITI")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_kuwaities['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_kuwaities['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['kuwaiti_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_kuwaities,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - sum(gpc out)->gpc process->gpc->with city name -KUWAITI   - - - - - - - - - -  - -
      $where_kuwaities_wip=array('processes.melting_lot_category_one in ("Kuwaiti")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_kuwaities_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_kuwaities_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      
      $this->data['kuwaiti_wips']=$this->process_model->find('sum(processes.balance) as weight',$where_kuwaities_wip);
      
  //- - - - - - - SUM=CAT-KUWAITI-92+75 BALANCE-PURITY- - - - - - - - - - - - - - - - - - - - - - - - -  - -
      $where_kuwaities_casting=array('processes.product_name in ("Arc 92 Kuwaiti","Arc 75 Kuwaiti") and processes.department_name in ("Melting","Casting")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_kuwaities_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_kuwaities_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['kuwaiti_castings']=$this->process_model->find('sum(processes.balance_melting_wastage) as weight',$where_kuwaities_casting);
  //- - - - - - - SUM=PROCESS ARC KUWAITI-MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 92+75 TOTAL BALANCE- - - - - - - - - - - - - - - - - - - - - - - - -  - -
      
  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

      $where_para=array('process_details.city in ("PARA ARF","PARA ARG")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_para['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_para['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      
      $this->data['para_productions']=$this->process_field_model->find('sum(process_details.gpc_out) as weight',$where_para,array(array('processes',  'process_details.process_id=processes.id')));
  //- - - - - - - sum(gpc out)->gpc process->gpc->with city name -PARA ARF+PARA ARG - - - - - - - - - - - - - - - - - - - - -  - -

      $where_para_wip=array('processes.melting_lot_category_one in ("PLAIN PARA","PARA","CZ PARA")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_para_wip['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_para_wip['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      
      $this->data['para_wips']=$this->process_model->find('sum(processes.balance) as weight',$where_para_wip);
  //- - - - - - - SUM=CAT-CZ PARA+PLAIN PARA-92+75 BALANCE - - - - - - - - - - - - - - - - - - - -  - -
      
      $where_para_casting=array('processes.product_name in ("Arc 92 Para","Arc 75 Para") and processes.department_name in ("Melting","Casting")'=>NULL);
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_para_casting['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_para_casting['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
      $this->data['para_castings']=$this->process_model->find('sum(processes.balance_melting_wastage) as weight',$where_para_casting);
  //- - - - - - - SUM=PROCESS ARC PARA-MELTING DEP+CASTING DEP.+MELTING WASTAGE BALANCE-PURITY 92+75 TOTAL BALANCE - - - - - - - - - - - - - - -  - -

  //- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

      $where_dd=array('daily_drawer_in_weight != '=>0,'product_name != '=>'Fancy Chain','type != ' => 'GPC Powder');
      if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_dd['date(processes.created_at) >=']=$this->data['record']['from_date'];
        $where_dd['date(processes.created_at) <=']=$this->data['record']['to_date'];
      }
        $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar,process_name as daily_drawer_type',
                                                   array('where'=>$where_dd,
                                                   'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"','"ARF Software"', '"ARF Software '.HOSTVERSION.'"','"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))), array(),
                                                   array('group_by'=>'hook_kdm_purity, karigar, process_name'));
    
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    $where_out_dd=array('hook_in != ' => 0);
    if(!empty($this->data['record']['from_date'])&&!empty($this->data['record']['to_date'])){
        $where_out_dd['date(created_at) >=']=$this->data['record']['from_date'];
        $where_out_dd['date(created_at) <=']=$this->data['record']['to_date'];
      }
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar',
                                                          array('where'=>$where_out_dd,
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'chain_name != '=>'Fancy Chain',
                                                                                  'daily_drawer_out_weight != ' => 0),
                                                                'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"','"ARF Software"', '"ARF Software '.HOSTVERSION.'"','"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar'));

    $this->set_daily_drawer_array('out', $daily_drawer_outs);
    $total_lock_dd=$total_chain_and_ornament_dd=$total_chain_and_ornament_92_dd=0;
    if(!empty($this->data['karigar_daily_drawers']['Model'])){
      foreach ($this->data['karigar_daily_drawers']['Model'] as $index => $value) {
        $total_lock_dd+=$value['in']-$value['out'];
      }
    }
    $this->data['lock_daily_drawers']['weight']=$total_lock_dd;
    if(!empty($this->data['karigar_daily_drawers']['Factory'])){
    //pd($this->data['karigar_daily_drawers']['Factory']);
	  $total_chain_and_ornament_dd=$this->data['karigar_daily_drawers']['Factory']['75.1500']['in']-$this->data['karigar_daily_drawers']['Factory']['75.1500']['out'];
    $total_chain_and_ornament_92_dd=$this->data['karigar_daily_drawers']['Factory']['91.8000']['in']-$this->data['karigar_daily_drawers']['Factory']['91.8000']['out'];
      }
   
    $this->data['chain_daily_drawers']['weight']=(!empty($total_chain_and_ornament_dd)?(($total_chain_and_ornament_dd/4)):0);//(!empty($total_chain_and_ornament_dd)?(($total_chain_and_ornament_dd)-((25/$total_chain_and_ornament_dd)*100)):0);

    $this->data['chain_ornament_daily_drawers']['weight']=(!empty($total_chain_and_ornament_dd)?(($total_chain_and_ornament_dd/4)):0);//(!empty($total_chain_and_ornament_dd)?(($total_chain_and_ornament_dd)-((25/$total_chain_and_ornament_dd)*100)):0);

    $this->data['chain_ornament_92_daily_drawers']['weight']=(!empty($total_chain_and_ornament_92_dd)?(($total_chain_and_ornament_92_dd)+($total_chain_and_ornament_dd/4)):0);
    
    $this->load->render('reports/packing_detail_reports/index', $this->data);    
  } 
  private function set_daily_drawer_array($in_out, $daily_drawers) {
    // pd($daily_drawers);
    $karigar_names=$this->process_model->get('karigar',array('product_name'=>'Fancy Chain'/*,'department_name'=>'Chain Making'*/),array(),array('group_by'=>'karigar'));
    
    $excluded_karigar_names=array_column($karigar_names,'karigar');
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        if(!in_array($daily_drawer['karigar'], $excluded_karigar_names)){

        $karigar_name = $daily_drawer['karigar'];
        $purity = $daily_drawer['hook_kdm_purity'];      

        
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
          $this->data['karigar_daily_drawers'][$karigar_name] = array();   
             
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity])) 
          $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array('in' => 0, 'out' => 0);     
        $this->data['karigar_daily_drawers'][$karigar_name][$purity][$in_out] += $daily_drawer['weight'];
      }}
    }
  }
}

