<?php

class Core_user_role_model extends BaseModel
{
  protected $table_name = 'user_roles';
  protected $id = 'id';

  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function after_save($action) {
    $user_role_permissions = $this->formdata['user_role_permissions'];
    $this->User_role_permission_model->delete('', array('user_role_id'=>$this->attributes['id']), TRUE);
    foreach ($user_role_permissions as $module_name => $role_permission) {
      $controller_list = $this->get_controller_list($module_name);
      foreach($controller_list as $controller_name){
        $user_role_permission = new User_role_permission_model($role_permission);
        $user_role_permission->attributes['module_name'] = $module_name;
        $user_role_permission->attributes['controller_name'] = $controller_name;
        $user_role_permission->attributes['user_role_id'] = $this->attributes['id'];
        $user_role_permission->store();
      }
    }
  }

  public function validation_rules($klass='') {
    return array( array( 'field' => 'user_roles[name]',
                         'label' => 'Name',
                         'rules' => 'trim|required'));
  }

  public function get_controller_list($module_name='') {
    $modules = array('masters' => array('clients','approval_authorities','vendors','address_types','business_verticals',
                                        'currencies','department','end_clients','grades','hsn_codes','material_types','products',
                                        'quality_standards','sections','structure_types','sub_grades','unit_matrixs','uoms',
                                        'vendor_types'),
                     'iwos' => array('iwos','sub_iwos','bom_datas','lot_matrixs','section_summaries'),
                     'users' => array('users','user_roles'));
    return (!empty($module_name) ? $modules[$module_name] : $modules);
  }


  public function delete($id, $conditions=array(), $permanent_delete=TRUE, $after_delete=TRUE){
    $get_user_role_exists = $this->users_user_role_model->get('',array('user_role_id'=>$id));
    if(empty($get_user_role_exists)){
      parent::delete($id, $conditions=array(), $permanent_delete=TRUE, $after_delete=TRUE);
    }else{
      return true;
    }
  }

}
