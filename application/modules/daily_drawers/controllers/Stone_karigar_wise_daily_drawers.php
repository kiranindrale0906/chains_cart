<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stone_karigar_wise_daily_drawers extends BaseController {	
	public function __construct(){
		 $this->load->model(array('processes/process_model','processes/process_field_model','daily_drawers/box_weight_model','issue_departments/issue_department_model'));
    parent::__construct();
  }  

  public function index() { 
    $this->data['group_by_purity'] = isset($_GET['group_by_purity']) ? $_GET['group_by_purity'] : 1;
    $this->stone_detail_records();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('daily_drawers/daily_drawers/stone_karigar_daily_drawers',$this->data);    
  }

  private function stone_detail_records(){
    $this->data['factory_daily_drawer_ins'] = $this->process_model->find('sum(in_weight) as weight',array('where'=>array('product_name'=>'Stone Receipt')), array());
    $this->data['factory_daily_drawer_outs'] = $this->process_model->find('sum(in_weight) as weight',array('where'=>array('product_name'=>'Stone Issue')), array());

    $daily_drawer_ins = $this->process_model->get('sum(in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar,process_name as daily_drawer_type',
                                                   array('where'=>array('in_weight != '=>0,
                                                                        'product_name'=>'Stone Issue')), array(),
                                                   array('group_by'=>'hook_kdm_purity, karigar, process_name'));
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_model->get('sum(stone_vatav-out_stone_vatav) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar,process_name
                                                          daily_drawer_type',
                                                          array('where'=>array('stone_vatav != ' => 0),
                                                                'or_where'=>array('out_stone_vatav != ' =>0)),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar,process_name'));

    $this->set_daily_drawer_array('out', $daily_drawer_outs);
  } 

  private function set_daily_drawer_array($in_out, $daily_drawers) {
    // pd($daily_drawers);
    if(!empty($daily_drawers)){
      foreach ($daily_drawers as $index => $daily_drawer) {
        
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
        

        // if ($this->data['group_by_purity'] == 1) {
        //   if ($karigar_name == 'Factory' && $daily_drawer_type != 'Hook' 
        //                                  // && $daily_drawer_type != 'KDM' 
        //                                  // && $daily_drawer_type != 'Final Process' 
        //                                  // && $daily_drawer_type != 'Choco Chain Dye Process' 
        //                                  // && $daily_drawer_type != 'Imp Italy Dye Process' 
        //                                  // && $daily_drawer_type != 'Indo Tally Dye Process' 
        //                                  // && $daily_drawer_type != 'Hollow Choco Dye Process' 
        //                                  && $daily_drawer_type != 'Lobster'
        //                                  // && $daily_drawer_type != 'GPC Powder'
        //                                  )
        //     $daily_drawer_type = 'Hook';
        // }

        // if (HOST == 'ARF') {
        //   $daily_drawer_type = 'ARF Accessories';
        // } else {
        //   if ($daily_drawer_type != 'Hook' 
        //     && $daily_drawer_type != 'Lobster' 
        //     && $daily_drawer_type != 'Choco Chain Dye Process'
        //     && $daily_drawer_type != 'Imp Italy Dye Process' 
        //     && $daily_drawer_type != 'Indo Tally Dye Process'
        //     && $daily_drawer_type != 'Hollow Choco Dye Process'
        //     && $daily_drawer_type != 'Final Process') $daily_drawer_type = 'Hook';
        //   // if ($daily_drawer_type == 'Solid Wire') $daily_drawer_type = 'Hook';
        //   // if ($daily_drawer_type == 'Hard Wire') $daily_drawer_type = 'Hook';
        // }
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name])) 
          $this->data['karigar_daily_drawers'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity]))
          $this->data['karigar_daily_drawers'][$karigar_name][$purity] = array();  
             
        if (!isset($this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type])) 
          $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type] = array('in' => 0, 'out' => 0);     
        $this->data['karigar_daily_drawers'][$karigar_name][$purity][$daily_drawer_type][$in_out] += $daily_drawer['weight'];
      }
    }
  }
}
