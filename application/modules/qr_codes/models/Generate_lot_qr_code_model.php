<?php 
class Generate_lot_qr_code_model extends BaseModel{
	public $router_class = 'generate_lot_qr_codes';
	protected $table_name= 'generate_lot_qr_codes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

 public function validate($validation_klass='') {
    $rules = $this->validation_rules();
    if(!isset($this->formdata['generate_lot_qr_code_details'])){
      $this->formdata['generate_lot_qr_code_details'] = array(array());
    }
    if(isset($this->formdata['generate_lot_qr_code_details'])){
      foreach($this->formdata['generate_lot_qr_code_details'] as $index => $generate_lot_qr_code_detail) {
        $generate_lot_qr_code_detail_rules = $this->generate_lot_qr_code_detail_model->validation_rules('', $index);
        $rules = array_merge($rules, $generate_lot_qr_code_detail_rules);
      }
    }
    
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'generate_lot_qr_codes[purity]','label' => 'Purity',
                    'rules' => 'trim|required'),
              array('field' => 'generate_lot_qr_codes[design_code]','label' => 'Design Code',
                    'rules' => 'trim|required'),
              array('field' => 'generate_lot_qr_codes[percentage]','label' => 'Percentage',
                    'rules' => 'trim|required')
            );
    return $rules;
  }

  function after_save($action) {
    if (isset($this->formdata['generate_lot_qr_code_details'])) {
      $this->generate_lot_qr_code_detail_model->delete('', array('generate_lot_qr_code_id' => $this->attributes['id']));
      foreach ($this->formdata['generate_lot_qr_code_details'] as $index => $generate_lot_qr_code_detail) {
        if(!empty($generate_lot_qr_code_detail['item_code'])){
          $generate_lot_qr_code_detail_obj = new generate_lot_qr_code_detail_model($generate_lot_qr_code_detail);
          $generate_lot_qr_code_detail_obj->attributes['purity'] = $this->attributes['purity'];
          $generate_lot_qr_code_detail_obj->attributes['design_code'] = $this->attributes['design_code'];
          $generate_lot_qr_code_detail_obj->attributes['percentage'] = $this->attributes['percentage'];
          $generate_lot_qr_code_detail_obj->attributes['generate_lot_qr_code_id'] = $this->attributes['id'];
          $generate_lot_qr_code_detail_obj->attributes['less'] = 
            two_decimal(($generate_lot_qr_code_detail['total_stone'] * $this->attributes['percentage']) /100);
          $generate_lot_qr_code_detail_obj->attributes['net_weight'] = 
            three_decimal($generate_lot_qr_code_detail['weight'] - $generate_lot_qr_code_detail_obj->attributes['less']);

            $generate_lot_qr_code_detail_obj->attributes['less'] = 
            two_decimal(($generate_lot_qr_code_detail['stone_weight'] * $this->attributes['percentage']) /100);
          $generate_lot_qr_code_detail_obj->attributes['total_stone'] = 
            three_decimal($generate_lot_qr_code_detail['stone_weight']+ $generate_lot_qr_code_detail['other_stone']);         
          $generate_lot_qr_code_detail_obj->attributes['dispatch_weight'] = 
            three_decimal($generate_lot_qr_code_detail['weight'] - $generate_lot_qr_code_detail_obj->attributes['less']);         
          $generate_lot_qr_code_detail_obj->attributes['net_weight'] = 
            three_decimal($generate_lot_qr_code_detail['weight'] - $generate_lot_qr_code_detail_obj->attributes['total_stone']);         
          $generate_lot_qr_code_detail_obj->save();
        }
      }
    }
  }
}
