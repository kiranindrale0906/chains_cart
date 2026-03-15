<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rnd_list extends BaseController {	
	public function __construct(){
		 $this->load->model(array('processes/process_model', 'processes/process_field_model', 'rnds/rnd_receipt_model', 'rnds/rnd_issue_model'));
    parent::__construct();
  }  

  public function index() { 
    $this->rnd_records();

    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
    $this->load->render('rnds/rnd_list/index',$this->data);    
  }
 

  private function rnd_records(){

    $receipt_ins = $this->rnd_receipt_model->get('sum(in_weight) as weight, 
                                                   FORMAT(in_lot_purity,4) as in_lot_purity',
                                                   array('in_weight>'=>0), array(),
                                                   array('group_by'=>'in_lot_purity','order_by'=>'in_lot_purity desc'));
    $this->set_rnd_array('receipt', $receipt_ins);
    
    $issue_outs = $this->rnd_issue_model->get('sum(out_weight) as weight, 
                                                   FORMAT(out_lot_purity,4) as in_lot_purity',
                                                   array('out_weight>'=>0), array(),
                                                   array('group_by'=>'out_lot_purity','order_by'=>'out_lot_purity desc'));
    $this->set_rnd_array('issue', $issue_outs);
  } 

  private function set_rnd_array($in_out, $rnd_records) {
    if(!empty($rnd_records)){
      foreach ($rnd_records as $index => $rnd_record) {
        $purity = $rnd_record['in_lot_purity'];
        if (!isset($this->data['rnd_records'][$purity]))
          $this->data['rnd_records'][$purity] = array();  
             
        if (!isset($this->data['rnd_records'][$purity])) 
          $this->data['rnd_records'][$purity]= array('receipt' => 0, 'issue' => 0);     
        $this->data['rnd_records'][$purity][$in_out] = $rnd_record['weight'];
      }
    }
  }

  }