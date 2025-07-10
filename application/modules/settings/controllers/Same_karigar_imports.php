<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Same_karigar_imports extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->data['file_data'] = array(
                                array('file_controller'=>'Same_karigar_imports','file_field_name'=>'import_files'));
  }

  public function _after_save($fromdata){
  	redirect(base_url().'settings/same_karigars');
  }
}