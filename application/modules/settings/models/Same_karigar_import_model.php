<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Same_karigar_import_model extends BaseModel {
  protected $table_name = 'karigars';
  public $router_class = 'same_karigar_imports';
  protected $id = 'id';
  protected $truncate_table = true;
  function __construct($data = array()){
    parent::__construct($data);
  }

   public function before_validate() {
    if (!empty($this->filedata['name']['import_files'])){
      $this->formdata['import_data'] = @$this->excel_lib->get_records($this->filedata, 'import_files', array(),1);  
      $set_import_data = $this->set_import_data();
    }
  }

  private function set_import_data($header=false){
    $new_data = array();
    if($header == true)
      return import_headers();
    if(isset($this->formdata['import_data']) && !empty($this->formdata['import_data'])){
     	foreach($this->formdata['import_data'] as $key => $import_data){
     		$get_hours = str_replace(array('h','s','m','day','days'),"",$import_data['due_duration']);
     		$get_day = explode(" ",$get_hours);
     		$day = $get_day[0];
     		$get_hours_minutes = explode(":",$get_day[1]);
     		$h = $get_hours_minutes[0];
     		$m = $get_hours_minutes[1];
     		$s = $get_hours_minutes[2];
     		$seconds = (86400*$day) + (3600*$h) + (60*$m) + $s;
     		$this->formdata_batch[$key]['due_duration'] = $seconds; 
     		$this->formdata_batch[$key]['id'] = $import_data['id']; 
     		$this->formdata_batch[$key]['product_name'] = $import_data['product_name']; 
     		$this->formdata_batch[$key]['process_name'] = $import_data['process_name']; 
     		$this->formdata_batch[$key]['department_name'] = $import_data['department_name']; 
     		$this->formdata_batch[$key]['karigar_name'] = $import_data['karigar_name']; 
     		$this->formdata_batch[$key]['capacity'] = $import_data['capacity']; 

     	}
    }
  }

  public function store($after_save = false){
  	parent::store_batch(false,false);
  }

  public function validation_rules($klass='') {
      $rules = array(
        array('field'  => 'same_karigar_imports[import_files]', 'label' => 'Upload File',
       'rules'  => array('trim',
                  array('validate_file_required',array($this,'check_import_file_is_attached')),
                  array('validate_file_extension',array($this,'check_import_file_extension')),
                  array('validate_excel_headers',array($this,'check_import_file_headers'))),
       'errors' => array("validate_file_required" => "Please Upload required file",
                         "validate_file_extension" => "Please provide valid file of extension xls,csv")));

    return $rules;
  }

  public function check_import_file_is_attached($field_value) {
    return parent::check_file_is_attached('import_files');
  }

  public function check_import_file_extension($field_value) {
    return parent::check_file_extension('import_files', array('CSV',"XLSX","XLS"));
  }

  public function check_import_file_headers($field_value) {
    if(function_exists('import_headers')) {
      $table_headers = $this->excel_lib->format_import_headers(import_headers());
      $excel_headers = $this->set_import_data(true);
      if(!empty($table_headers) && !empty($excel_headers)) {
        $difference = array_diff($excel_headers,$table_headers);
        if($difference || empty($this->formdata['import_data'])) {
          $this->form_validation->set_message('validate_excel_headers','Import file is not valid. Please check headers in excel.');
          return false;
        }else 
          return true;
      }
      else{
        $this->form_validation->set_message('validate_excel_headers','Import file is not valid. Please check headers in excel.');
        return false;
      }
    }else {
      $this->form_validation->set_message('validate_excel_headers','Please set headers in helper');
      return false;
    }
  }

}