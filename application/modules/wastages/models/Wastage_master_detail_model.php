<?php
class Wastage_master_detail_model extends BaseModel{
	protected $table_name = 'wastage_master_details';
	protected $id = 'id';
	public function __construct() {
		parent::__construct();
	}
	public function validation_rules($klass='') {

    $rules= array(array('field' => 'wastage_detail_masters[wastage_master_id]', 'label' => 'wastage detail',
                        'rules' => 'trim|required'));
    return $rules;
  }
}