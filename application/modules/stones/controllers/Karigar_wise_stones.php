<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_wise_stones extends BaseController {	
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
      $this->load->render('stones/stones/karigar_stones',$this->data);    
  }

  private function wastage_records(){
    $stone_ins = $this->process_model->get('sum(stone_out) as weight, 
                                         FORMAT(in_lot_purity,4) as in_lot_purity, 
                                         karigar,type',
                                         array(array('stone_out != '=>0)), array(),
                                         array('group_by'=>'in_lot_purity, karigar, type'));
    

    $this->set_stone_array('in', $stone_ins);
    
    $stone_outs = $this->process_model->get('sum(stone_in) as weight,
                                            FORMAT(in_lot_purity,4) as in_lot_purity,
                                            karigar,type',
                                            array(array('stone_in != '=>0)),
                                            array(),
                                            array('group_by'=>'in_lot_purity,karigar,type'));

    $this->set_stone_array('out', $stone_outs);
  } 

  private function set_stone_array($in_out, $stones) {
    if(!empty($stones)){
      foreach ($stones as $index => $stone) {
        if(!empty($stone['weight'])&&$stone['weight']!=0){
        $karigar_name = $stone['karigar'];
        
        if ($this->data['group_by_purity'] == 1) {
          if ($stone['in_lot_purity'] >= 80 && $stone['in_lot_purity'] < 88) 
            $purity = '80% - 88%';
          elseif ($stone['in_lot_purity'] < 80)
            $purity = '- 80%';
          elseif ($stone['in_lot_purity'] == 100)
            $purity = '100%';
          elseif ($stone['in_lot_purity'] >= 88)
            $purity = '88% +';
        } else{
          if($stone['in_lot_purity']>=76){
          $purity = 92.00;      
          }else{
          $purity = 75.25;   
          }
        }

        $stone_type = 'Stone';
        if (!isset($this->data['karigar_stones'][$karigar_name])) 
          $this->data['karigar_stoness'][$karigar_name] = array(); 

        if (!isset($this->data['karigar_stones'][$karigar_name][$purity]))
          $this->data['karigar_stoness'][$karigar_name][$purity] = array();  
             
        if (!isset($this->data['karigar_stones'][$karigar_name][$purity][$stone_type])) 
          $this->data['karigar_stones'][$karigar_name][$purity][$stone_type] = array('in' => 0, 'out' => 0);     
        $this->data['karigar_stones'][$karigar_name][$purity][$stone_type][$in_out] += $stone['weight'];
      }
     }
    }
  }
}
