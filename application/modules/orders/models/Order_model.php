<?php
class Order_model extends BaseModel{
  protected $table_name = 'orders';

  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function before_validate() {
    if ($this->router->method=='update'){
      if ($this->attributes['status'] == 0) {
        $this->attributes['status'] = 1;
      }
    } 
  }

  public function validation_rules($klass='') {
    $rules[] = array('field' => 'orders[weight]',
                     'label' => 'Weight',
                     'rules' => array('trim','required','numeric'));
    return $rules;
  }

  public function after_save($action) {
    if(!isset($_GET['from']) && $_GET['from']!='view') {
    	if(isset($this->formdata['order_details']))
  	    foreach($this->formdata['order_details'] as $index => $order_detail){
  	      if(isset($order_detail['delete']) AND $order_detail['delete']==1 && 
  	         !empty($order_detail['id']))
  	        $this->order_detail_model->delete($order_detail['id']);
  	      unset($order_detail['delete']);

  	      $order_details = new order_detail_model($order_detail);
  	      $order_details->attributes['order_id'] = $this->formdata['orders']['id'];
  	      $order_details->attributes['label_name'] = $order_detail['label_name'];
  	      $order_details->attributes['value'] = $order_detail['value'];
  	      $order_details->save();
  	    }
  	    redirect(ADMIN_PATH.'orders/orders');
    }else {
      if($this->attributes['status']==0) {
        $this->attributes['status']=1;
      }
      parent::save($after_save);
    }
  }
}