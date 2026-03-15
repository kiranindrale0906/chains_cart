<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chain_wise_daily_drawer_summeries extends BaseController {	
	public function __construct(){
		$this->load->model(array('processes/process_model', 'processes/process_field_model','daily_drawers/daily_drawer_receipt_model'));
		parent::__construct();
	}  

	public function index() { 
		$this->data['record']['chain_name'] = (isset($_GET['chain_name']) ? $_GET['chain_name'] : '');
		$this->data['chain_name'] = (isset($_GET['chain_name']) ? $_GET['chain_name'] : '');
		$this->data['chain_names'] = $this->process_model->get('DISTINCT(chain_name) as name, chain_name as id',
		                                                   array('chain_name!=' => 'Office Outside'));

		$this->wastage_records();
		//$this->other_wastage_records();
		$this->ghiss_records();
		$this->tounch_out_records();

		$this->load->render('daily_drawers/chain_wise_daily_drawer_summeries/index',$this->data);    
	}
	private function wastage_records(){
		$purity=array('92.00'=>'88% >' ,'87.65'=>'86% - 88%' ,'83.65'=>'80% - 85%' ,'75.15'=>'< 80%');

			foreach ($purity as $index => $value) {
				$where=array('chain_name' => $this->data['record']['chain_name']);
			if($index==83.65){
        $where['hook_kdm_purity >']=80;
         $where['hook_kdm_purity<']=85;
      }elseif($index==87.65){
        $where['hook_kdm_purity >']=86;
         $where['hook_kdm_purity<']=88;
      }elseif($index==92){
         $where['hook_kdm_purity >']=88;
         $where['hook_kdm_purity<']=100;
      }elseif($index==100){
         $where['hook_kdm_purity']=100;
      }else{
        $where['hook_kdm_purity <']=80;
      }

			$this->data['wastages'][$index]=$this->process_model->find('"'.$value.'" as purity_group,
			                                                         sum(daily_drawer_wastage) as in_weight,
			                                                         sum(out_daily_drawer_wastage) as out_weight,
			                                                         sum(balance_daily_drawer_wastage) as balance,
			                                                         sum(balance_daily_drawer_wastage*out_lot_purity/100) as balance_fine,
			                                                         hook_kdm_purity',$where);

		}
	}


	private function ghiss_records(){
		$this->data['ghiss_reports']=$this->process_model->find('sum(ghiss) as in_weight,
		                                                     sum(out_ghiss) as out_weight,
		                                                     sum(balance_ghiss) as balance,sum(ghiss * out_purity / 100) as balance_gross,
		                                                     sum(balance_ghiss * out_purity / 100 * out_lot_purity / 100) as balance_fine', 
		                                                     array('chain_name' => $this->data['record']['chain_name']));
	}

	private function tounch_out_records(){
		$this->data['tounch_out_reports']=$this->process_model->find('sum(tounch_out) as in_weight,
		                                                          sum(out_tounch_out) as out_weight,
		                                                          sum(balance_tounch_out) as balance,
		                                                          sum(balance_tounch_out) as balance_gross,
		                                                          sum(balance_tounch_out * tounch_purity / 100) as balance_fine',
		                                                          array('chain_name' => $this->data['record']['chain_name']));
		}
	}