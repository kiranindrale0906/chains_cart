<?php 

class Pen_rhodium_model extends BaseModel{

    public $router_class = 'pen_rhodiums';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}
}
