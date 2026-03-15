<?php 
class Qr_code_detail_model extends BaseModel{
	public $router_class = 'qr_code_details';
	protected $table_name= 'qr_code_details';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='', $index=0) {
    $rules = array(
      array('field' => 'qr_code_details['.$index.'][net_weight]',
            'label' => 'Net Weight',
            'rules' => 'trim|numeric'),
      array('field' => 'qr_code_details['.$index.'][weight]',
            'label' => 'Gross Weight',
            'rules' => 'trim|numeric'), 
      array('field' => 'qr_code_details['.$index.'][total_stone]',
            'label' => 'Total Stone',
            'rules' => 'trim'),
      array('field' => 'qr_code_details['.$index.'][less]',
            'label' => 'Less',
            'rules' => 'trim|numeric'),
      array('field' => 'qr_code_details['.$index.'][length]',
            'label' => 'Length',
            'rules' => 'trim|numeric')
    );
    return $rules;
  }
  public function update_print_status($records,$status) {
    if(!empty($records)){
      if($status==2){
        $status=0;
      }
      foreach ($records as $index => $qr_code_detail) {
        $qr_code_detail_obj = new qr_code_detail_model($qr_code_detail);
        if($qr_code_detail['print_status']==0) {
          $qr_code_detail_obj->attributes['print_status'] = $status;
          $qr_code_detail_obj->save(false);
        }else{
              $qr_code_detail_obj->attributes['print_status'] = $status;
          $qr_code_detail_obj->save(false);
            }
      }
    }
  }
}