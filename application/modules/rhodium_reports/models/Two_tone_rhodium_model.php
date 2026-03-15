<?php 

class Two_tone_rhodium_model extends BaseModel{
    public $router_class = 'two_tone_rhodiums';
	protected $table_name= 'processes';
	public function __construct($data = array()){
		parent::__construct($data);
	}
}
