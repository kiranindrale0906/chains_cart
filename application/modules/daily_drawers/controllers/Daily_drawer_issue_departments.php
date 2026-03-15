<?php
class Daily_drawer_issue_departments extends BaseController {
  public function __construct() {
    $this->_model='daily_drawer_issue_department_model';
    parent::__construct();
    $this->load->model(array('settings/same_karigar_model', 'settings/karigar_model'));
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _get_form_data() {
    if(isset($_GET)){
      $this->data['record']['karigar'] = @$_GET['karigar'];
      $this->data['record']['account'] = @$_GET['chain_name'];
      $this->data['record']['type'] = @$_GET['type'];
    }
    
  	// $this->data['accounts'] = get_process_for_issue_daily_drawer($accounts);

    //$this->data['karigars'] = get_karigars();
    $this->data['karigars'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));
    // $this->data['karigars'] = array_merge($this->data['karigars'], get_account_name());
  }
}