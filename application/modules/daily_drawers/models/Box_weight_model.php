<?php 
class Box_weight_model extends BaseModel{
	public $router_class = 'box_weights';
	protected $table_name= 'box_weights';
	public function __construct($data = array()){
		parent::__construct($data);
	}

	public function validation_rules($klass='') {
    $rules= array(array('field' => 'box_weights[purity]', 'label' => 'Melting',
									      'rules' => 'trim|required|numeric|greater_than[0]'),
                  array('field' => 'box_weights[weight]', 'label' => 'Weight',
                        'rules' => 'trim|required|numeric|greater_than[0]'
                        ),
                  array('field' => 'box_weights[daily_drawer_type]', 'label' => 'Type',
                        'rules' => 'trim|required'
                        ),
                  array('field' => 'box_weights[karigar]', 'label' => 'Karigar',
                        'rules' => 'trim|required'
                        ));
    return $rules;
  }
}