<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_wise_sisma_chain_daily_drawers extends BaseController {	
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
      $this->load->render('daily_drawers/daily_drawers/karigar_sisma_chain_daily_drawers',$this->data);    
  }

  private function wastage_records(){
    $daily_drawer_ins = $this->process_model->get('sum(daily_drawer_in_weight) as weight, 
                                                   FORMAT(hook_kdm_purity,4) as hook_kdm_purity, 
                                                   karigar,melting_lot_category_one as daily_drawer_type',
                                                   array('where'=>array('daily_drawer_in_weight != '=>0,
                                                                        'product_name in ("Sisma Accessories Making Chain","Office Outside","Daily Drawer Receipt") '=>NULL)),
                                                  array(),
                                                   array('group_by'=>'hook_kdm_purity, karigar, melting_lot_category_one'));
    $this->set_daily_drawer_array('in', $daily_drawer_ins);
    
    $daily_drawer_outs = $this->process_field_model->get('sum(sisma_in-sisma_out+daily_drawer_out_weight) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar,
                                                          daily_drawer_type',
                                                          array('chain_name in ("Sisma Accessories Making Chain","Sisma Chain") '=>NULL),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar,daily_drawer_type'));
    //pd($daily_drawer_outs);

    $this->set_daily_drawer_array('out', $daily_drawer_outs);
    $daily_drawer_total_weights = $this->process_model->get('sum(daily_drawer_in_weight - (((hook_in - hook_out)+(sisma_in - sisma_out)) + daily_drawer_out_weight)) as weight,
                                                          FORMAT(hook_kdm_purity,4) as hook_kdm_purity,
                                                          karigar,melting_lot_category_one as daily_drawer_type',
                                                          array('where'=>array('type != ' => 'GPC Powder')),
                                                          array(),
                                                          array('group_by'=>'hook_kdm_purity,karigar,melting_lot_category_one'));
    $this->set_daily_drawer_array('box_weight', $daily_drawer_total_weights);
  

    } 

  private function set_daily_drawer_array($in_out, $daily_drawers) {
    // pd($daily_drawers);
    $karigar_names=$this->process_model->get('karigar',array('karigar'=>'Sisma Accessory'),array());
    
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
