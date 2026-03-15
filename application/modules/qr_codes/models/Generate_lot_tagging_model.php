<?php 
class Generate_lot_tagging_model extends BaseModel{
	public $router_class = 'generate_lot_taggings';
	protected $table_name= 'generate_lot_taggings';
	public function __construct($data = array()){
		parent::__construct($data);
	}

 public function validate($validation_klass='') {
    $rules = $this->validation_rules();
    if(!isset($this->formdata['generate_lot_tagging_details'])){
      $this->formdata['generate_lot_tagging_details'] = array(array());
    }
    if(isset($this->formdata['generate_lot_tagging_details'])){
      foreach($this->formdata['generate_lot_tagging_details'] as $index => $generate_lot_tagging_detail) {
        $generate_lot_tagging_detail_rules = $this->generate_lot_tagging_detail_model->validation_rules('', $index);
        $rules = array_merge($rules, $generate_lot_tagging_detail_rules);
      }
    }
    
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
  }

  public function validation_rules($klass='') {
    $rules = array(
              array('field' => 'generate_lot_taggings[purity]','label' => 'Purity',
                    'rules' => 'trim|required'),
            );
    return $rules;
  }

  function after_save($action) {
    if (isset($this->formdata['generate_lot_tagging_details'])) {
      $this->generate_lot_tagging_detail_model->delete('', array('generate_lot_tagging_id' => $this->attributes['id']));
      foreach ($this->formdata['generate_lot_tagging_details'] as $index => $generate_lot_tagging_detail) {
        if(!empty($generate_lot_tagging_detail['order_id'])){
          $order_details=$this->order_detail_model->find('',array('id'=>$generate_lot_tagging_detail['order_id']));

	 $order_detail_id=$generate_lot_tagging_detail['order_id'];
         unset($generate_lot_tagging_detail['order_id']);
          $generate_lot_tagging_detail_obj = new generate_lot_tagging_detail_model($generate_lot_tagging_detail);
          $generate_lot_tagging_detail_obj->attributes['purity'] = $this->attributes['purity'];

          if(!empty($order_details['item_code'])){
            $generate_lot_tagging_detail_obj->attributes['generate_lot_id'] = $this->attributes['generate_lot_id'];
            $generate_lot_tagging_detail_obj->attributes['order_detail_id'] = $order_detail_id;
            $generate_lot_tagging_detail_obj->attributes['item_code'] = $order_details['item_code'];
            $generate_lot_tagging_detail_obj->attributes['order_detail_image'] = $order_details['image'];
            $generate_lot_tagging_detail_obj->attributes['order_qty']=$order_details['quantity'];
            $generate_lot_tagging_detail_obj->attributes['dispatch_qty']=$generate_lot_tagging_detail['quantity'];
            $generate_lot_tagging_detail_obj->attributes['pending_qty'] = $order_details['balance_quantity']-$generate_lot_tagging_detail['quantity'];
          }
          $generate_lot_tagging_detail_obj->attributes['design_code'] = $this->attributes['design_code'];
          $generate_lot_tagging_detail_obj->attributes['percentage'] = $this->attributes['percentage'];
          $generate_lot_tagging_detail_obj->attributes['generate_lot_tagging_id'] = $this->attributes['id'];       
          $generate_lot_tagging_detail_obj->save();
        }
      }
    }
  }
}
