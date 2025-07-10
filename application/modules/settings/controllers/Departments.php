<?php

class Departments extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/department_worker_model','processes/process_model'));
  }
  
  public function _get_form_data() {//pd($_POST['department_workers']);
    $this->data['departments']  = $this->process_model->get('distinct(department_name) as name,department_name as id');//pd($this->data['departments']);
    $this->data['karigars']     = $this->process_model->get('distinct(karigar) as name,karigar as id');
    $this->data['types']        = array(array('name'=>'Select','id'=>''),
                                        array('name' => 'Pending Ghiss','id'=>'pending_ghiss'),
                                        array('name' => 'Ghiss','id'=>'ghiss'),
                                        array('name' => 'Hook','id'=>'hook_in'),
                                        array('name' => 'Loss','id'=>'loss')
                                      );
    $this->data['process']        = array(array('name' => 'Process','id'=>'process','selected'=>'selected'),
                                        array('name' => 'Process Details','id'=>'process_details')
                                      );
    if ($this->router->method=='create') {
      $this->data['department_workers'] = array(array());
    } elseif ($this->router->method=='edit')
      $this->data['department_workers'] = $this->department_worker_model->get('',array('department_id' =>$this->data['record']['id']));
    else
      $this->data['department_workers'] = !empty($_POST['department_workers']) ? $_POST['department_workers'] : '';
  }
}