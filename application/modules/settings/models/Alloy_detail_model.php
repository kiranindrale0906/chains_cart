<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Alloy_detail_model extends BaseModel {
  protected $table_name = 'alloy_settings';
  protected $id = 'id';
  public $router_class = 'alloy_details';
  public $truncate_table = false;

  function __construct($data = array()){
    parent::__construct($data);
  	$this->load->library('excel_lib');
  }
    public function before_validate() {
	    $this->load->library('excel_lib');
	    if (!empty($this->filedata['name']['import_files']))
	      $this->formdata['import_data'] = @$this->excel_lib->get_records($this->filedata, 'import_files', array(),1);
	  	if(!empty($this->formdata['import_data'])){
	  		foreach ($this->formdata['import_data'] as $index => $value) {
	  			if(!empty($value['alloy_name'])){
		  			$alloy_details=$this->alloy_type_model->find('id',array('alloy_name'=>$value['alloy_name']));
		  			if(!empty($alloy_details)){
		  				unset($this->formdata['import_data'][$index]['alloy_name']);
		  				$this->formdata['import_data'][$index]['alloy_id']=$alloy_details['id'];
		  			}
	  			}
	  		}
	  	}

    }
    public function validation_rules($validation_klass='record') {
    // if(!empty($this->formdata['import_data']))
    //   $prefix="";
    // else
      $prefix="alloy_details";
    $rules = array(
    				array('field' => $prefix.'[product_name]',
                         'label' => 'Product name',
                         'rules' => array('trim','required')),
                    array('field' => $prefix.'[alloy_id]',
                         'label' => 'Alloy Name',
                         'rules' => array('trim','required')),
                    array('field' => $prefix.'[tone]',
                         'label' => 'Tone',
                         'rules' => array('trim','required')),
                    array('field' => $prefix.'[weight]',
                         'label' => 'Weight',
                         'rules' => array('trim','required')),
         
            );
    // $rules[] = array('field'  => 'alloy_details[import_data]', 'label' => 'Upload Data',
    //                                'rules'  => array(array('unique_row_data',array($this,'check_unique_row_data')),array('row_data_exists',array($this,'check_row_data_exists'))),
    //                                'errors' => array());

    // if (empty($this->formdata['import_data'])) {
    //   $rules[] = array('field'  => 'alloy_details[product_name]', 'label' => 'Product Name',
    //                               'rules'  => array(array('product_name_unique',array($this,'check_unique_product_name'))),
    //                               'errors'  => array("product_name_unique"  => "Product Name already exists."));
    // }
    
    // $rules['import_file'] = array(
    // array('field'  => 'alloy_details[import_files]', 'label' => 'Upload File',
    //       'rules'  => array('trim',
    //                         array('validate_file_required',array($this,'check_import_file_is_attached')),
    //                         array('validate_file_extension',array($this,'check_import_file_extension')),
    //                         array('validate_excel_headers',array($this,'check_import_file_headers'))),
    //       'errors' => array("validate_file_required" => "The file is required.  Kindly use the sample file to import the data.",
    //                          "validate_file_extension" => "Invalid file extension 'csv'. Kindly use the sample file to import the data.")));
    
    // if ($validation_klass=='import_file' && isset($this->formdata['import_data'])) {
    //   if(!empty($this->formdata['import_data'])){
    //     foreach($this->formdata['import_data'] as $index => $set_import) {
    //         $rules['import_file'] = array_merge($rules['import_file'], $this->add_prefix_to_validation_rules('import_data['.$index.']', 'record'));   
    //     }
    //   }
    // }
    // pd($rules[$validation_klass]);
    return $rules;
  }  
  public function check_row_data_exists() {
    $duplicate_rows = array();
    if(!empty($this->formdata['import_data'])){

      foreach ($this->formdata['import_data'] as $import_data_key => $import_value) {
			$where = array('product_name'=>$import_value['product_name'],
										'tone'=>!empty($import_value['tone'])?$import_value['tone']:'',
										'category_one'=>!empty($import_value['category_one'])?$import_value['category_one']:"",
										'alloy_purity'=>!empty($import_value['alloy_purity'])?$import_value['alloy_purity']:'',
										'alloy_id'=>!empty($import_value['alloy_id'])?$import_value['alloy_id']:'',
										'chain'=>!empty($import_value['chain'])?$import_value['chain']:'');
		$chk_duplicate_rec = $this->find('id',$where);

        if(!empty($chk_duplicate_rec))
          $duplicate_rows[] = $import_data_key; 
      }

      if(!empty($duplicate_rows)) {
        $this->form_validation->set_message('row_data_exists', 'Market Design Name  already exists in row no '.implode(',', $duplicate_rows));
        return false;
      } else {
        return true;
      }
    }
  }
  public function check_unique_row_data($str) {
    $duplicate_rows = array();
    if(!empty($this->formdata['import_data'])){
      foreach ($this->formdata['import_data'] as $import_data_key => $import_value) {
        foreach ($this->formdata['import_data'] as $duplicate_chk_import_data_key => $duplicate_chk__value) {
          if(@$duplicate_chk__value['product_name']==@$import_value['product_name'] && 
            $duplicate_chk_import_data_key==($import_data_key+1)) {
              $duplicate_rows[] = $duplicate_chk_import_data_key;    
          }
        }
      }
    }
  }

    public function check_unique_product_name($product_name){
		if(isset($this->attributes['id'])){
			$where = array('product_name'=>$this->attributes['product_name'],
											'tone'=>$this->attributes['tone'],
											'category_one'=>$this->attributes['category_one']
											,'id !='=>$this->attributes['id'],
											'alloy_purity'=>$this->attributes['alloy_purity'],
											'alloy_id'=>$this->attributes['alloy_id'],
											'chain'=>$this->attributes['chain']);
		}else{
			$where = array('product_name'=>$this->attributes['product_name'],
										'tone'=>!empty($this->attributes['tone'])?$this->attributes['tone']:'',
										'category_one'=>!empty($this->attributes['category_one'])?$this->attributes['category_one']:"",
										'alloy_purity'=>!empty($this->attributes['alloy_purity'])?$this->attributes['alloy_purity']:'',
										'alloy_id'=>!empty($this->attributes['alloy_id'])?$this->attributes['alloy_id']:'',
										'chain'=>!empty($this->attributes['chain'])?$this->attributes['chain']:'');
		}
		$get_alloy_data = $this->find('id',$where);

		if($get_alloy_data['id'])
			return FALSE;
		else
			return true;
		
	}


	public function save($after_save=TRUE) {
	    if ($this->attributes['category_one']=='All') {
	      $category_records=isset(get_category_one()[$this->attributes['product_name']])?get_category_one()[$this->attributes['product_name']]:array();
     foreach ($category_records as $index => $category_record) {
	        $attributes=$this->attributes;
	        $attributes['category_one']=$category_record['name'];
	        $alloy_details_obj = new alloy_detail_model($attributes);
	        $alloy_details_obj->before_validate();
	        if($alloy_details_obj->validate()){
	          $alloy_details_obj->save(false);
	        }
	      }
	    }elseif(isset($this->formdata['import_data'])) {
	      foreach ($this->formdata['import_data'] as $setting_records) {
	        $this->attributes = $setting_records;
	        $this->store();
	      }
	    }
	    else
	      parent::save($after_save);
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
}