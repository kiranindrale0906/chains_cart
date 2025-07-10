<?php 
include_once APPPATH . "modules/processes/models/Process_model.php";
class Arc_fancy_filing_iii_process_model extends Process_model{
	protected $next_process_model = 'arc_fancy_chains/arc_fancy_magnet_process_model';

	public $router_class = 'filing_iii_processes';
	public $departments = array('Filing III');
	public function __construct($data = array()){
		parent::__construct($data);
		$this->attributes['product_name'] = 'Arc Fancy';
		$this->attributes['process_name'] = 'Filing III Process';
		$this->department_not_deleted=array('Filing III');
		$this->split_out_weight_departments =array('Filing III');
	}

	protected function get_next_process_model($process_field_attributes = array()) {
	    if (empty($process_field_attributes)) return '';
		if($process_field_attributes['next_department_name']=='Grinding'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_grinding_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Filing'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_filing_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Filing II'){
        $this->next_model_name = 'arc_fancy_chains/arc_fancy_filing_ii_process_model';
      }elseif($process_field_attributes['next_department_name']=='Filing II'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_filing_ii_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Magnet'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_magnet_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Steel Vibrator'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_steel_vibrator_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Pasta'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_pasta_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Pre Polish'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_pre_polish_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Stone Setting'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_stone_setting_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Refiling'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_refiling_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Refiling II'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_refiling_ii_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Buffing'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_buffing_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Hand Cutting'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_hand_cutting_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Hand Dull'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_hand_dull_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Sand Dull'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_sand_dull_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Buffing Refresh'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_buffing_refresh_process_model';
	    }elseif($process_field_attributes['next_department_name']=='GPC'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_gpc_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Meena'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_meena_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Hallmarking'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_hallmarking_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Finish Good'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_finish_good_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Electropolish'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_electropolish_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Electrostripping'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_electrostripping_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Caustic Loss'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_caustic_loss_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Factory Hold'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_factory_hold_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Packing'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_packing_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Meena Filing'){
	      $this->next_model_name = 'arc_fancy_chains/arc_fancy_meena_filing_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Filing III'){
	      $this->next_model_name = 'arc_fancy_chains/arc_chain_filing_iii_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Refiling III'){
	      $this->next_model_name = 'arc_fancy_chains/arc_chain_refiling_iii_process_model';
	    }elseif($process_field_attributes['next_department_name']=='Correction'){
	      $this->next_model_name = 'arc_fancy_chains/arc_chain_correction_process_model';
	    }elseif($process_field_attributes['next_department_name']=='GPC Rhodium'){
	      $this->next_model_name = 'arc_fancy_chains/arc_chain_gpc_rhodium_process_model';
	    }

	    
	    return $this->next_model_name;
	}

	/*public function after_save($action) {
		if($this->attributes['melting_lot_category_one']=='Ring') {
           $this->attributes['lot_no'] = 'C'.'-'.round($this->attributes['in_lot_purity']).'-R-'.$this->attributes['id'];
        }elseif($this->attributes['melting_lot_category_one']=='Chain') {
           $this->attributes['lot_no'] = 'C'.'-'.round($this->attributes['in_lot_purity']).'-C-'.$this->attributes['id'];
        }elseif($this->attributes['melting_lot_category_one']=='Pendant') {
           $this->attributes['lot_no'] = 'C'.'-'.round($this->attributes['in_lot_purity']).'-P-'.$this->attributes['id'];
        }elseif($this->attributes['melting_lot_category_one']=='Kuwaiti') {
          $this->attributes['lot_no'] =  'C'.'-'.round($this->attributes['in_lot_purity']).'-K-'.$this->attributes['id'];
        }
         $this->update(false);
    }*/
}