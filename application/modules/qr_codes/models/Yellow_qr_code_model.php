<?php 
class Yellow_qr_code_model extends BaseModel{
	public $router_class = 'yellow_qr_codes';
	protected $table_name= 'yellow_qr_codes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

 public function validate($validation_klass='') {
    $rules = $this->validation_rules();
    if(!isset($this->formdata['yellow_qr_code_details'])){
      $this->formdata['yellow_qr_code_details'] = array(array());
    }
    if(isset($this->formdata['yellow_qr_code_details'])){
      foreach($this->formdata['yellow_qr_code_details'] as $index => $yellow_qr_code_detail) {
        $yellow_qr_code_detail_rules = $this->yellow_qr_code_detail_model->validation_rules('', $index);
        $rules = array_merge($rules, $yellow_qr_code_detail_rules);
      }
    }
    
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'yellow_qr_codes[purity]','label' => 'Purity',
                    'rules' => 'trim|required'),
              array('field' => 'yellow_qr_codes[design_code]','label' => 'Design Code',
                    'rules' => 'trim|required'),
              array('field' => 'yellow_qr_codes[percentage]','label' => 'Percentage',
                    'rules' => 'trim|required')
            );
    return $rules;
  }

  function after_save($action) {
    if (isset($this->formdata['yellow_qr_code_details'])) {
      $this->yellow_qr_code_detail_model->delete('', array('yellow_qr_code_id' => $this->attributes['id']));
      foreach ($this->formdata['yellow_qr_code_details'] as $index => $yellow_qr_code_detail) {
        if(!empty($yellow_qr_code_detail['weight'])){
          $yellow_qr_code_detail_obj = new yellow_qr_code_detail_model($yellow_qr_code_detail);
          $yellow_qr_code_detail_obj->attributes['purity'] = $this->attributes['purity'];
          $yellow_qr_code_detail_obj->attributes['design_code'] = $this->attributes['design_code'];
          $yellow_qr_code_detail_obj->attributes['percentage'] = $this->attributes['percentage'];
          $yellow_qr_code_detail_obj->attributes['yellow_qr_code_id'] = $this->attributes['id'];
          $yellow_qr_code_detail_obj->attributes['less'] = 
            two_decimal((($yellow_qr_code_detail['stone_weight']+$yellow_qr_code_detail['km']) * $this->attributes['percentage']) /100);
          $yellow_qr_code_detail_obj->attributes['total_stone'] = 
            three_decimal($yellow_qr_code_detail['stone_weight'] + $yellow_qr_code_detail['other_stone']);         
          $yellow_qr_code_detail_obj->attributes['dispatch_weight'] = 
            three_decimal($yellow_qr_code_detail['weight'] - $yellow_qr_code_detail_obj->attributes['less']);         
          $yellow_qr_code_detail_obj->attributes['net_weight'] = 
            three_decimal($yellow_qr_code_detail['weight'] - $yellow_qr_code_detail_obj->attributes['total_stone'] - $yellow_qr_code_detail_obj->attributes['km']);         
          $yellow_qr_code_detail_obj->save();
        }
      }
    }
  }
}
