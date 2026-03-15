<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_wise_fancy_chain_daily_drawers extends BaseController {	
	public function __construct(){
		 $this->load->model(array('processes/process_model','processes/process_field_model','daily_drawers/box_weight_model','issue_departments/issue_department_model'));
    parent::__construct();
  }  

  public function index() { 
    $this->data['group_by_purity'] = isset($_GET['group_by_purity']) ? $_GET['group_by_purity'] : 1;
    $this->wastage_records();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('daily_drawers/daily_drawers/karigar_fancy_chain_daily_drawers',$this->data);    
  }

  private function wastage_records(){
    $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar,process_name as daily_drawer_type',
                                                   array('where'=>array('daily_drawer_in_weight != '=>0,
                                                         'type != ' => 'GPC Powder'),
                                                   'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"',
                                                                                            '"ARF Software"', '"ARF Software '.HOSTVERSION.'"',
                                                                                            '"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))), array(),
                                                   array('group_by'=>'hook_kdm_purity, karigar, process_name'));
    

    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(hook_in-hook_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar,
                                                          daily_drawer_type',
                                                          array('where'=>array('hook_in != ' => 0,),
                                                                'or_where'=>array('hook_out != ' =>0,
                                                                                  'daily_drawer_out_weight != ' => 0),
                                                                'where_not_in'=>array('karigar' => array('"AR Gold Software"', '"AR Gold Software '.HOSTVERSION.'"',
                                                                                                         '"ARF Software"', '"ARF Software '.HOSTVERSION.'"',
                                                                                                         '"ARC Software"', '"ARC Software '.HOSTVERSION.'"'))),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar,daily_drawer_type'));
    $this->set_daily_drawer_array('out', $daily_drawer_outs);

    $daily_drawer_box_weights = $this->box_weight_model->get('sum(weight) as weight,
                                                          FORMAT(purity,4) as hook_kdm_purity,
                                                          karigar,
                                                          daily_drawer_type',
                                                          array('where'=>array('weight  >' => 0)),
                                                          array(),
                                                          array('group_by'=>'purity,karigar,daily_drawer_type'));
    $this->set_daily_drawer_array('box_weight', $daily_drawer_box_weights);
  } 

  private function set_daily_drawer_array($in_out, $daily_drawers) {
    // pd($daily_drawers);
    $karigar_names=$this->process_model->get('karigar',array('product_name'=>'Fancy Chain'/*,'department_name'=>'Chain Making'*/),array(),array('group_by'=>'karigar'));
    $excluded_karigar_names=array_column($karigar_names,'karigar');
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        if(in_array($daily_drawer['karigar'], $excluded_karigar_names)){
    
        $karigar_name = $daily_drawer['karigar'];
        
        if ($this->data['group_by_purity'] == 1) {
          if ($daily_drawer['hook_kdm_purity'] >= 80 && $daily_drawer['hook_kdm_purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($daily_drawer['hook_kdm_purity'] < 80)
            $purity = '- 80%';
          elseif ($daily_drawer['hook_kdm_purity'] == 100)
            $purity = '100%';
          elseif ($daily_drawer['hook_kdm_purity'] >= 88)
            $purity = '88% +';
        } else
          $purity = $daily_drawer['hook_kdm_purity'];      

        $daily_drawer_type = $daily_drawer['daily_drawer_type'];
        

        if ($this->data['group_by_purity'] == 1) {
          if ($karigar_name == 'Factory' && $daily_drawer_type != 'Hook' 
                                         && $daily_drawer_type != 'KDM' 
                                         && $daily_drawer_type != 'Final Process' 
                                         && $daily_drawer_type != 'Choco Chain Dye Process' 
                                         && $daily_drawer_type != 'Imp Italy Dye Process' 
                                         && $daily_drawer_type != 'Indo Tally Dye Process' 
                                         && $daily_drawer_type != 'Hollow Choco Dye Process' 
                                         && $daily_drawer_type != 'Lobster'
                                         && $daily_drawer_type != 'GPC Powder')
            $daily_drawer_type = 'Hook';
        }

        if (HOST == 'ARF') {
          $daily_drawer_type = 'ARF Accessories';
        } else {
          if ($daily_drawer_type != 'KDM' && $daily_drawer_type != 'Lobster' 
                                          && $daily_drawer_type != 'Choco Chain Dye Process' 
                                          && $daily_drawer_type != 'Imp Italy Dye Process' 
                                          && $daily_drawer_type != 'Indo Tally Dye Process' 
                                          && $daily_drawer_type != 'Hollow Choco Dye Process'
                                          && $daily_drawer_type != 'Final Process'  
                                         ) $daily_drawer_type = 'Hook';
          // if ($daily_drawer_type == 'Solid Wire') $daily_drawer_type = 'Hook';
          // if ($daily_drawer_type == 'Hard Wire') $daily_drawer_type = 'Hook';
        }
        // if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
        //   $this->data['karigar_daily_drawers'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
          $this->data['karigar_daily_drawers'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity]))
          $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array();  
             
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type])) 
          $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type] = array('in' => 0, 'out' => 0,'box_weight'=>0,'gpc_powder_out'=>0);     
        $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type][$in_out] += $daily_drawer['weight'];
      }}
    }
  }
}
