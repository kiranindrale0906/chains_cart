<?php 
class Office_day_model extends BaseModel{
	protected $table_name= 'calendars';
	public $router_class = 'office_days';
	public function __construct($data = array()){
		parent::__construct($data);
		
	}


	public function validation_rules($klass='') {
    $rules= array(array('field' => 'office_days[selected_date]', 'label' => 'Selected Date',
                        'rules' => 'trim|required'),
                  array('field' => 'office_days[day]', 'label' => 'Day',
                        'rules' => 'trim|required'
                        ),
                  array('field' => 'office_days[open_time]', 'label' => 'Office Open Time',
                        'rules' => 'trim|required'
                        ),
                  array('field' => 'office_days[close_time]', 'label' => 'Office Close Time',
                        'rules' => 'trim|required'
                        ));
    return $rules;
  }
}