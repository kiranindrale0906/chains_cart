<?php
class Qc_departments extends BaseController {
	public function __construct() {
		parent::__construct();
	}
	public function _after_save($formdata, $action){
		$this->data['redirect_url']= ADMIN_PATH.'qc_departments/qc_departments';
		return $formdata;
	}

}