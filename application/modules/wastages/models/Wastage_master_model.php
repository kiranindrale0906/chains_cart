<?php
class Wastage_master_model extends BaseModel{
	protected $table_name = 'wastage_masters';
	protected $id = 'id';
	public function __construct($data=array()) {
		parent::__construct($data);
		$this->load->model(array('wastages/wastage_master_detail_model'));
 
	}
	public function validation_rules($klass='') {

    $rules= array(array('field' => 'wastage_masters[customer_name]', 'label' => 'Customer Name',
                        'rules' => 'trim|required'));
    return $rules;
  }

   function after_save($action) {
	    if (isset($this->formdata['wastage_details'])) {
	      $this->wastage_master_detail_model->delete('', array('wastage_master_id' => $this->attributes['id']));
	      foreach ($this->formdata['wastage_details'] as $index => $wastage_detail) {
	      $wastage_master_detail_obj = new wastage_master_detail_model($wastage_detail);   
          $wastage_master_detail_obj->attributes['wastage_master_id'] = $this->attributes['id']; 
          $wastage_master_detail_obj->attributes['chain'] = $wastage_detail['chain']; 
          $wastage_master_detail_obj->attributes['category_name'] = $wastage_detail['category_name']; 
          $wastage_master_detail_obj->attributes['tone'] = $wastage_detail['tone']; 
          $wastage_master_detail_obj->attributes['purity'] = $wastage_detail['purity']; 
          $wastage_master_detail_obj->attributes['machine_size'] = $wastage_detail['machine_size']; 
          $wastage_master_detail_obj->attributes['design'] = $wastage_detail['design']; 
          $wastage_master_detail_obj->attributes['wastage'] = $wastage_detail['wastage']; 
          $wastage_master_detail_obj->attributes['factory_purity'] = $wastage_detail['factory_purity']; 
          $wastage_master_detail_obj->attributes['sequance'] = $wastage_detail['sequance']; 
          $wastage_master_detail_obj->save();
      	  }
	    }
	}
}