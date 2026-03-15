<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Choco_chain_bom_setting_model extends BaseModel {
  protected $table_name = "choco_chain_bom_settings";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function before_validate() {
    $this->load->library('excel_lib');

    if(!empty($this->filedata['name']['import_files'])){
      $this->formdata['import_data']=$this->excel_lib->get_records($this->filedata, 'import_files',array(),1);
    }
  }

  public function validation_rules($validation_klass='record') {
    if(!empty($this->formdata['import_data']))
      $prefix="";
    else
      $prefix="choco_chain_bom_settings";

    $rules['record'] = array(
              array('field' => $prefix.'[type]', 'label' => 'type',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[chain]', 'label' => 'chain',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_1_code]', 'label' => 'die 1 code',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_2_code]', 'label' => 'die 2 code',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[melting]', 'label' => 'melting',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[wt_in_18_inch]', 'label' => 'weight in 18 inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[no_of_die_pcs_in_18_inch]', 'label' => 'no of die pieces in 18 inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_pcs_wt_in_18_inch]', 'label' => 'die pieces weight in 18 inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_pcs_per_18_inch]', 'label' => 'die 1 pieces per 18 inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_wt_per_pcs]', 'label' => 'die 1 weight per pieces',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_wt]', 'label' => 'die 1 weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_pcs_per_18_inch]', 'label' => 'die 2 pieces per 18 inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_wt_per_pcs]', 'label' => 'die 2 weight per pieces',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_wt]', 'label' => 'die 2 weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_strip_per_pc_width]', 'label' => 'die 1 strip per piece width',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_strip_per_pc_thickness]', 'label' => 'die 1 strip per piece thickness',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_strip_precentage]', 'label' => 'die 1 strip precentage',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_strip_per_pc_wt]', 'label' => 'die 1 strip per piece weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_strip_per_pc_width]', 'label' => 'die 2 strip per piece width',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_strip_per_pc_thickness]', 'label' => 'die 2 strip per piece thickness',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_strip_precentage]', 'label' => 'die 2 strip precentage',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_strip_per_pc_wt]', 'label' => 'die 2 strip per piece weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_strip_to_langari_percentage]', 'label' => 'die 1 strip to langari percentage',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_1_langari_name]', 'label' => 'die 1 langari name',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_1_langari_per_pc_size]', 'label' => 'die 1 langari per piece size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_1_langari_per_pc_wt]', 'label' => 'die 1 langari per piece weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_strip_to_langari_percentage]', 'label' => 'die 2 strip to langari percentage',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[die_2_langari_name]', 'label' => 'die 2 langari name',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_2_langari_per_pc_size]', 'label' => 'die 2 langari per piece size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[die_2_langari_per_pc_wt]', 'label' => 'die 2 langari per piece weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[hook_per_chain_size]', 'label' => 'hook per chain size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[hook_per_chain_qty]', 'label' => 'hook per chain quantity',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[hook_per_chain_wt]', 'label' => 'hook per chain weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[lock_per_chain_size]', 'label' => 'lock per chain size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[lock_per_chain_qty]', 'label' => 'lock per chain quantity',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[lock_per_chain_wt]', 'label' => 'lock per chain weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[kdm_per_inch]', 'label' => 'kdm per inch',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[solid_wire_per_inch_size]', 'label' => 'solid wire per inch size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[solid_wire_per_inch_wt]', 'label' => 'solid wire per inch weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[pipe_type_size]', 'label' => 'pipe type size',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[pipe_finish]', 'label' => 'pipe finish',
                    'rules' => array('trim', 'required')),
              array('field' => $prefix.'[pipe_pcs]', 'label' => 'pipe pieces',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[pipe_wt_per_pc]', 'label' => 'pipe weight per piece',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[pipe_total_wt]', 'label' => 'pipe total weight',
                    'rules' => array('trim', 'required', 'numeric')),
              array('field' => $prefix.'[wt_per_inch]', 'label' => 'weight per inch',
                    'rules' => array('trim', 'required', 'numeric'))
            );

    $rules['import_file'] = array(
      array('field' => 'choco_chain_bom_settings[import_files]', 'label' => 'Upload File',
          'rules'   => array('trim',
                             array('validate_file_required',array($this,'check_import_file_is_attached')),
                             array('validate_file_extension',array($this,'check_import_file_extension')),
                             array('validate_excel_headers',array($this,'check_import_file_headers'))),
          'errors'  => array("validate_file_required"  => "The file is required.  Kindly use the sample file to import the data.",
                             "validate_file_extension" => "Invalid file extension 'csv'. Kindly use the sample file to import the data.")));
    
    if ($validation_klass=='import_file' && isset($this->formdata['import_data'])) {
      if(!empty($this->formdata['import_data'])){
        foreach($this->formdata['import_data'] as $index => $set_import) {
            $rules['import_file'] = array_merge($rules['import_file'], $this->add_prefix_to_validation_rules('import_data['.$index.']', 'record'));   
        }
      }
    }

    return $rules[$validation_klass];
  }

  public function check_import_file_is_attached($field_value) {
    return parent::check_file_is_attached('import_files');
  }

  public function check_import_file_extension($field_value) {
    return parent::check_file_extension('import_files', array('CSV'));
  }

  public function check_import_file_headers($field_value) {
    if (function_exists('import_headers')) {
      $table_headers=$this->excel_lib->format_import_headers(import_headers());
      $excel_headers=$this->excel_lib->get_records($this->filedata,'import_files','',1,true);
      if(!empty($table_headers)) {
        $difference=array_diff($excel_headers,$table_headers);
        if(!empty($difference)) {
          $this->form_validation->set_message('validate_excel_headers','Import file is not valid. Please check headers in excel.');
          return false;
        }
        else 
          return true;
      }
      else{
        $this->form_validation->set_message('validate_excel_headers','Import file is not valid. Please check headers in excel.');
        return false;
      }
    }
    else
    {
      $this->form_validation->set_message('validate_excel_headers','Please set headers in helper');
      return false;
    }
  }

  public function save($after_save=false) {
    if(isset($this->formdata['import_data'])) {
      foreach ($this->formdata['import_data'] as $setting_records) {
        $this->attributes = $setting_records;
        $this->store();
      }
    }
    else
      parent::save();
  }
}