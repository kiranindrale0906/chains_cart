<?php

class Packing_slip_model extends BaseModel {

  protected $table_name = "packing_slips";
  public $router_class = "packing_slips";

  public function __construct($data = array()){
		parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules= array(array('field' => 'packing_slips[date]', 'label' => 'Date',
                        'rules' => 'trim|required'),
                  // array('field' => 'packing_slips[account_name]', 'label' => 'Account Name',
                  //           'rules' => array('trim','required',array('check_account_name_error_msg', array($this,'check_account_name_exist'))),
                  //             'errors' => array('check_account_name_error_msg' => 'Please select at least one detail',
                  //                      'required' => 'Account Name is required'))
  );
    
    return $rules;
  }
  public function check_account_name_exist($name) {
    if(empty($this->formdata['packing_slip_details'])){
      return false;
    }else{
      return true;
    }
    
  }

  public function before_validate(){
    if (!isset($this->formdata['packing_slip_details']) || empty($this->formdata['packing_slip_details'])) return;
     
    $packing_slip_ids=array_column($this->formdata['packing_slip_details'], 'packing_slip_id');


    if (!isset($packing_slip_ids) || empty($packing_slip_ids)) return;
      $packing_slip_id_details=array();
      $packing_slips=array();
      $select = 'sum(in_weight) as in_weight,
                 (sum(in_weight*in_lot_purity) / sum(in_weight)) as in_lot_purity,
                 (sum(in_weight*in_purity) / sum(in_weight)) as in_purity
                 ';
      $packing_slip_details=$this->process_model->find($select, array('id in ('.implode(',', $packing_slip_ids).')' => NULL));
     $making_charge=$stone=$quantity=$gross_weight=$net_weight=$pure=$total=0;
    foreach ($this->formdata['packing_slip_details'] as $index => $value) {
      if(!empty($value['packing_slip_id'])){
        $making_charge+=$value['packing_slip_making_charge'];
        $gross_weight+=$value['packing_slip_gross_weight'];
        $stone+=$value['packing_slip_stone'];
        $quantity+=$value['packing_slip_quantity'];
        $net_weight+=$value['packing_slip_gross_weight']-$value['packing_slip_stone'];
      }
    }
    $this->attributes['date']=date('Y-m-d',strtotime($this->attributes['date']));
    $this->attributes['weight']=$packing_slip_details['in_weight'];
    $this->attributes['gross_weight']=$gross_weight;
    $this->attributes['purity']=$packing_slip_details['in_lot_purity'];
    $this->attributes['factory_purity']=$packing_slip_details['in_purity'];
    $this->attributes['net_weight']=$net_weight;
    $this->attributes['quantity']=$quantity;
    $this->attributes['making_charge']=$making_charge;
    $this->attributes['stone']=$stone;
    $this->attributes['pure']=($net_weight*$packing_slip_details['in_lot_purity']/100);
    $this->attributes['total']=($net_weight*$making_charge);
  }

   public function after_save($action){
    if (!isset($this->formdata['packing_slip_details']) || empty($this->formdata['packing_slip_details'])) return;
    $this->set_packing_slip_id_in_metal_issue_vouchers();
	}  

  private function set_packing_slip_id_in_metal_issue_vouchers() {
    $packing_slips=array();
    if (!empty($this->formdata['packing_slip_details'])) {
    foreach ($this->formdata['packing_slip_details'] as $index => $packing_slip_detail) {
      if(!empty($packing_slip_detail['packing_slip_id'])){
      $packing_slips=explode('-', $packing_slip_detail['packing_slip_id']);
      if(!empty($packing_slip_detail['process_id'])){
      $packing_details = $this->process_model->find('', array('id' => $packing_slip_detail['process_id']));
      }
        $packing_details['packing_slip_id'] = $this->attributes['id'];
        $this->create_packing_slip_details($packing_details,$packing_slip_detail);
        $process_object = new process_model($packing_details);
        $process_object->calculate_balance_wastage();
        $process_object->save(false);
      }}
    }
    if($this->router->method == 'update'){
    	$this->update_packing_slips($this->attributes['id'],$this->attributes['date']);
    }
  }
  private function create_packing_slip_details($packing_details,$packing_slip_details) {
    $this->load->model('export_internals/packing_slip_detail_model');
     $packing_slip_detail_data = array();
      $packing_slip_detail_data['weight'] = $packing_details['in_weight'];
      $packing_slip_detail_data['purity'] = $packing_details['in_lot_purity'];
      $packing_slip_detail_data['quantity'] = $packing_slip_details['packing_slip_quantity'];
      $packing_slip_detail_data['packing_slip_id'] = $packing_details['packing_slip_id'];
      $packing_slip_detail_data['process_id'] = $packing_details['id'];
      $packing_slip_detail_data['balance'] = $packing_details['packing_slip_balance'];
      $packing_slip_detail_data['stone'] = !empty($packing_slip_details['packing_slip_stone_percentag'])?($packing_slip_details['packing_slip_gross_weight']*$packing_slip_details['packing_slip_stone_percentag']/100):$packing_slip_details['packing_slip_stone'];
      $packing_slip_detail_data['gross_weight'] = $packing_slip_details['packing_slip_gross_weight'];
      $packing_slip_detail_data['net_weight'] = $packing_slip_details['packing_slip_gross_weight']-$packing_slip_detail_data['stone'];
      $packing_slip_detail_data['pure'] = $packing_slip_detail_data['net_weight']*$packing_details['in_lot_purity']/100;
      $packing_slip_detail_data['making_charge'] = $packing_slip_details['packing_slip_making_charge'];
      $packing_slip_detail_data['colour'] = $packing_slip_details['packing_slip_colour'];
      $packing_slip_detail_data['code'] = $packing_slip_details['packing_slip_code'];
      $packing_slip_detail_data['description'] = $packing_slip_details['packing_slip_description'];
      $packing_slip_detail_data['category_name'] = $packing_slip_details['packing_slip_category_name'];
      $packing_slip_detail_data['category_2'] = $packing_slip_details['packing_slip_category_2'];
      $packing_slip_detail_data['sr_no'] = $packing_slip_details['packing_slip_sr_no'];
      // $packing_slip_detail_data['site_name'] = $packing_details['site_name'];
      $packing_slip_detail_data['total'] = $packing_slip_detail_data['net_weight']*$packing_slip_details['packing_slip_making_charge'];
      $obj_packing_slip_detail=new packing_slip_detail_model($packing_slip_detail_data);
      $obj_packing_slip_detail->save();
  }  
  
  public function chitti_detail_exist($name) {
    if(empty($this->formdata['packing_slip_details'])){
      return false;
    }else{
      return true;
    }
    
  }
  public function update_packing_slips($packing_slip_id,$date) {
  $this->load->model('export_internals/packing_slip_detail_model');
    $select = 'sum(in_weight) as in_weight,
                group_concat(id) as ids,
                 (sum(in_weight*in_lot_purity) / sum(in_weight)) as in_lot_purity,
                 (sum(in_weight*in_purity) / sum(in_weight)) as in_purity';
    $process_details=$this->process_model->find($select,array('packing_slip_id'=>$packing_slip_id));
	//pd($process_details);
    $packing_slip_details=$this->packing_slip_detail_model->get('',array('process_id in ('.$process_details['ids'].')' => NULL,'packing_slip_id'=>$packing_slip_id));
	$making_charge=$gross_weight=$stone=$quantity=$net_weight=0;

     if(!empty($packing_slip_details)){
      foreach ($packing_slip_details as $index => $value) {
        if(!empty($value['packing_slip_id'])){
          $making_charge+=$value['making_charge'];
          $gross_weight+=$value['gross_weight'];
          $stone+=$value['stone'];
          $quantity+=$value['quantity'];
          $net_weight+=$value['gross_weight']-$value['stone'];
        }
      }}
      $packing_details['id']=$packing_slip_id;
      $packing_details['date']=date('Y-m-d',strtotime($date));
      $packing_details['weight']=$process_details['in_weight'];
      $packing_details['gross_weight']=$gross_weight;
      $packing_details['purity']=$process_details['in_lot_purity'];
      $packing_details['factory_purity']=$process_details['in_purity'];
      $packing_details['net_weight']=$net_weight;
      $packing_details['quantity']=$quantity;
      $packing_details['making_charge']=$making_charge;
      $packing_details['stone']=$stone;
      $packing_details['pure']=($net_weight*$process_details['in_lot_purity']/100);
      $packing_details['total']=($net_weight*$making_charge);
//      pd($packing_details);
      $process_obj = new Packing_slip_model($packing_details);
      $process_obj->update(false);
  }
}
