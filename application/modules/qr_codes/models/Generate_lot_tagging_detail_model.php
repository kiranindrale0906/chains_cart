<?php 
class Generate_lot_tagging_detail_model extends BaseModel{
	public $router_class = 'generate_lot_tagging_details';
	protected $table_name= 'generate_lot_tagging_details';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='', $index=0) {
    $rules = array(
      array('field' => 'generate_lot_tagging_details['.$index.'][net_weight]',
            'label' => 'Net Weight',
            'rules' => 'trim|numeric'),
      array('field' => 'generate_lot_tagging_details['.$index.'][weight]',
            'label' => 'Gross Weight',
            'rules' => 'trim|numeric'), 
      array('field' => 'generate_lot_tagging_details['.$index.'][total_stone]',
            'label' => 'Total Stone',
            'rules' => 'trim'),
      array('field' => 'generate_lot_tagging_details['.$index.'][less]',
            'label' => 'Less',
            'rules' => 'trim|numeric'),
      array('field' => 'generate_lot_tagging_details['.$index.'][length]',
            'label' => 'Length',
            'rules' => 'trim')
    );
    return $rules;
  }
  public function update_print_status($records,$status) {
    if(!empty($records)){
      if($status==2){
        $status=0;
      }
      foreach ($records as $index => $qr_code_detail) {
        $generate_lot_tagging_detail_obj = new generate_lot_tagging_detail_model($qr_code_detail);
        if($qr_code_detail['print_status']==0) {
          $generate_lot_tagging_detail_obj->attributes['print_status'] = $status;
          $generate_lot_tagging_detail_obj->save(false);
        }else{
              $generate_lot_tagging_detail_obj->attributes['print_status'] = $status;
          $generate_lot_tagging_detail_obj->save(false);
            }
      }
    }
  }
}
