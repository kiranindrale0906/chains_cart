<?php
class Daily_drawer_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('users/account_model','settings/same_karigar_model', 'settings/karigar_model','processes/process_archive_model'));
  }

  // public function create() {
  //   if (HOST != 'ARC' && ENVIRONMENT == 'production'){
  //     echo 'Create daily drawer receipts from Accounts.';
  //     die;
  //   }else{
  //     parent::create();
  //   }
  // }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _get_form_data() {
    if(HOST=='ARC'){
      $this->data['karigars']=array(array('id'=>'Factory','name'=>'Factory'));
    }else{
      //$this->data['karigars']=$this->same_karigar_model->get('distinct(karigar_name) as name,karigar_name as id',array('where_in'=>array('department_name'=>array('"Stamping"'))));
      $this->data['karigars'] = $this->karigar_model->get('distinct(karigar_name) as name ,karigar_name as id');
    }
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'daily_drawers/daily_drawer_receipts';
    return $formdata;
  }
  
  public function delete($id, $conditions = array(), $permanent_delete = true, $after_delete = true){
    parent::delete($id,$conditions,$permanent_delete,$after_delete);
  } 
}