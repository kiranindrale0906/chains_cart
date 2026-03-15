<?php 
class Qr_code_model extends BaseModel{
	public $router_class = 'qr_codes';
	protected $table_name= 'qr_codes';
	public function __construct($data = array()){
		parent::__construct($data);
	}

 public function validate($validation_klass='') {
    $rules = $this->validation_rules();
    if(!isset($this->formdata['qr_code_details'])){
      $this->formdata['qr_code_details'] = array(array());
    }
    if(isset($this->formdata['qr_code_details'])){
      foreach($this->formdata['qr_code_details'] as $index => $qr_code_detail) {
        $qr_code_detail_rules = $this->qr_code_detail_model->validation_rules('', $index);
        $rules = array_merge($rules, $qr_code_detail_rules);
      }
    }
    
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'qr_codes[purity]','label' => 'Purity',
                    'rules' => 'trim|required'),
              array('field' => 'qr_codes[design_code]','label' => 'Design Code',
                    'rules' => 'trim|required'),
              array('field' => 'qr_codes[percentage]','label' => 'Percentage',
                    'rules' => 'trim|required')
            );
    return $rules;
  }

  function after_save($action) {
    if (isset($this->formdata['qr_code_details'])) {
      $this->qr_code_detail_model->delete('', array('qr_code_id' => $this->attributes['id']));
      foreach ($this->formdata['qr_code_details'] as $index => $qr_code_detail) {
        if(!empty($qr_code_detail['weight'])){
          $qr_code_detail_obj = new qr_code_detail_model($qr_code_detail);
          $qr_code_detail_obj->attributes['purity'] = $this->attributes['purity'];
               $qr_code_detail_obj->attributes['design_code'] = $this->attributes['design_code'];
          $qr_code_detail_obj->attributes['percentage'] = $this->attributes['percentage'];
          $qr_code_detail_obj->attributes['qr_code_id'] = $this->attributes['id'];
          $qr_code_detail_obj->attributes['less'] = 
            two_decimal(($qr_code_detail['total_stone'] * $this->attributes['percentage']) /100);
          $qr_code_detail_obj->attributes['net_weight'] = 
            three_decimal($qr_code_detail['weight'] - $qr_code_detail_obj->attributes['less']-$qr_code_detail_obj->attributes['km']);         
          $qr_code_detail_obj->save();
        }
      }
    }
  }
}
