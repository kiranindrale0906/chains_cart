<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alloy_reports extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('processes/process_model','melting_lots/melting_lot_alloy_detail_model'));
	}

	public function index() { 
		$this->get_alloy();
		$this->load->render('alloys/alloy_reports/index', $this->data);    
	} 

	private function get_alloy(){
		$alloy_records = $this->process_model->get('sum(in_weight) as in_weight,type',
																													array('product_name'=>'Alloy Receipt'),
																													array(),
																													array('group_by' => 'type'));

		foreach ($alloy_records as $index => $alloy_record) {
			$type=array();
			if(!empty($alloy_record['type'])){
			 $type= array('alloy_name'=>$alloy_record['type']);
			}
			$out_weight = $this->melting_lot_alloy_detail_model->find('sum(out_weight) as out_weight',$type)['out_weight'];
			$this->data['alloy_records'][$index]['type']=$alloy_record['type'];
			$this->data['alloy_records'][$index]['in_weight']=$alloy_record['in_weight'];
			$this->data['alloy_records'][$index]['out_weight']=$out_weight;
			$this->data['alloy_records'][$index]['balance']=$alloy_record['in_weight']-$out_weight;
		}
	}

}
