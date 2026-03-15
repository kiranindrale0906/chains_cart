<?php 

class Daily_change_rolling_balance_report_model extends BaseModel{
	protected $table_name = "daily_rolling_balances";
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function create_daily_product_rolling($data,$date_report) {
		$products = ['arc','arc_chain','arc_customer_order','arc_casting_process','hallmark','arc_92_chain','arc_75_chain','arc_ornament','arc_92_ornament','arc_75_ornament','arc_para','arc_75_para','arc_92_para','arc_kuwaiti','arc_92_kuwaiti','arc_75_kuwaiti','ball_chain','indo_tally_chain', 'choco_chain','casting_chain', 'casting_rnd','chain_75', 'chain_92','daily_drawer', 'dus_collection','fancy_chain','fancy_75_chain','hollow_choco_chain','hand_made_chain', 'i_10_process', 'imp_italy_chain','indo_tally_chain','internal', 'ka_chain', 'lock_process','lotus_chain','lopster_making_chain', 'machine_chain', 'nano_process','lopster','rolex_chain','nawabi_chain',  'kuwaitis','pendent_set', 'pendent_set_75', 'pendent_set_plain', 'plain_ring','refresh','ring', 'ring_75', 'roco_choco_chain','rope_chain','round_box_chain','pendant', 'pendant_75', 'sisma_chain', 'sisma_accessories_making_chain', 'solid_machine_chain', 'solid_rope_chain', 'stone_ring_75', 'stone_ring_92','office_outside_pipe_and_para','office_outside','arc_rnd','arc_fancy','arc_casting','arc_turkey','arc_lock'];
			//$this->daily_change_rolling_balance_report_model->delete('', array('date(transaction_date)' =>$date_report));
		foreach ($data as $product => $balance) {
			if (in_array($product, $products)) {
				$gpc_out_detail=$this->process_model->find('sum(gpc_out) gpc_out,sum(bounch_out) bounch_out,sum(repair_out) repair_out', array('date(completed_at)' =>$date_report,'product_name'=>$balance['product_name'],'process_name!='=>"Refresh Final Process"));
				if($balance['product_name']=="Office Outside"){
					$pipe_and_para_out_detail=$this->process_model->find('sum(daily_drawer_in_weight) pipe_and_para_out', array('date(completed_at)' =>$date_report,'product_name'=>$balance['product_name'],'process_name'=>"Pipe and Para Final Process"));
				}
			$fancy_out['ka_ball_chain_fancy_out']=$fancy_out['factory_hold_ii_fancy_out']=$fancy_out['ka_chain_factory_fancy_out']=0;
			if($balance['product_name']=="KA Chain" || $balance['product_name']=="Ka Chain"){
				$imp_out_detail=$this->process_model->find('sum(recutting_out) imp_out', array('date(updated_at)' =>$date_report,'product_name'=>"KA Chain","process_name"=>"Factory Process"));
				$ka_chain_factory_fancy_out_detail=$this->process_model->find('sum(factory_out) fancy_out', array('date(updated_at)' =>$date_report,'product_name'=>"KA Chain","process_name"=>"Factory Process"));
				$fancy_out['ka_chain_factory_fancy_out']=!empty($ka_chain_factory_fancy_out_detail['fancy_out'])?$ka_chain_factory_fancy_out_detail['fancy_out']:0;
			}
			if($balance['product_name']=="Lopster Making Chain"){
				$gpc_out_detail=$this->process_model->find('sum(daily_drawer_in_weight) gpc_out', array('date(updated_at)' =>$date_report,'product_name'=>"Lopster Making Chain","process_name"=>"Buffing Process"));
			}
			if($balance['product_name']=="Sisma Accessories Making Chain"){
				$gpc_out_detail=$this->process_model->find('sum(out_weight) gpc_out', array('date(updated_at)' =>$date_report,'product_name'=>"Sisma Accessories Making Chain","department_name"=>"Final I"));
			}
			if($balance['product_name']=="Ball Chain"){
				$hook_plain_fancy_out_detail=$this->process_model->find('sum(recutting_out) fancy_out', array('date(completed_at)' =>$date_report,'product_name'=>"Ball Chain","process_name"=>"Hook Plain Process"));
				$factory_hold_ii_fancy_out_detail=$this->process_model->find('sum(recutting_out) fancy_out', array('date(completed_at)' =>$date_report,'product_name'=>"Ball Chain","process_name"=>"Factory Hold II Process"));
				$fancy_out['factory_hold_ii_fancy_out']=!empty($factory_hold_ii_fancy_out_detail['fancy_out'])?$factory_hold_ii_fancy_out_detail['fancy_out']:0;
			}
			if($balance['product_name']=="Ball Chain" || $balance['product_name']=="KA Chain"){
			$ka_ball_chain_fancy_out_detail=$this->process_model->find('sum(melting_wastage) fancy_out', array('date(completed_at)' =>$date_report,'product_name'=>$balance['product_name'],"process_name"=>"Fancy Out Process"));
			$fancy_out['ka_ball_chain_fancy_out']=!empty($ka_ball_chain_fancy_out_detail['fancy_out'])?$ka_ball_chain_fancy_out_detail['fancy_out']:0;
			}
				if($balance['balance_gross']!=0){
					$rolling_field=array(
					'transaction_date'=>$date_report,
					'product_name'=>$balance['product_name'],
					'gpc_out'=>!empty($gpc_out_detail['gpc_out'])?$gpc_out_detail['gpc_out']:0,
					'bunch_out'=>(!empty($gpc_out_detail['bounch_out'])&&($balance['product_name']!="Fancy Chain" && $balance['product_name']!="Fancy 75 Chain"))?$gpc_out_detail['bounch_out']:0,
					'fancy_out'=>$fancy_out['ka_chain_factory_fancy_out']+$fancy_out['factory_hold_ii_fancy_out']+$fancy_out['ka_ball_chain_fancy_out'],
					'imp_out'=>(!empty($imp_out_detail['imp_out'])&&($balance['product_name']!="Office Outside Pipe And Para"))?$imp_out_detail['imp_out']:0,
					'pipe_and_para_out'=>!empty($pipe_and_para_out_detail['pipe_and_para_out'])?$pipe_and_para_out_detail['pipe_and_para_out']:0,
					'repair_out'=>!empty($gpc_out_detail['repair_out'])?$gpc_out_detail['repair_out']:0,
					'balance_gross'=>$balance['balance_gross'],
					'balance_fine'=>$balance['balance_fine'],
					);
					$rolling_data=$this->daily_change_rolling_balance_report_model->find('', array('date(transaction_date)' =>$date_report,'product_name'=>$balance['product_name']));
					$rolling_obj = new daily_change_rolling_balance_report_model($rolling_field);
					if(!empty($rolling_data)){
						$rolling_obj->attributes=$rolling_field;
			        	$rolling_obj->attributes['id'] = $rolling_data['id'];
			        	$rolling_obj->update(false);
					}else{
						$rolling_obj->store(false);
					}

//					$rolling_data=$this->daily_change_rolling_balance_report_model->find('', array('date(transaction_date)' =>$date_report));
//					if (empty($rolling_data)) {
			        //	$rolling_obj->store(false);
//				      	} else {
//			        	$rolling_obj->attributes['id'] = $rolling_data['id'];
//			        	$rolling_obj->update(false);
//			      	}
				}
			}
		}
	}
}
