<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/processes/controllers/Processes.php";
class Melting extends Processes {
  public function __construct(){
    parent::__construct();
    $this->data['layout'] = 'table';
    // $this->load->helper(array('processes/processes'));
    $this->load->model(array('processes/process_model','processes/process_field_model', 'processes/process_information_model', 
                             'processes/process_out_wastage_detail_model', 'processes/process_group_model',
                             'melting_lots/melting_lot_detail_model', 'issue_departments/issue_department_detail_model',
                             'users/user_model', 'settings/room_model'));
    }

  // public function get_ajax_success_data($model_obj, $action) {
  //   $model_name = get_model_name($model_obj->attributes['product_name'], $model_obj->attributes['process_name']);
  //   $this->load->model($model_name['module_name'].'/'.$model_name['model_name']);
  //   $process_obj = new $model_name['model_name'];
  //   $previous_process = $this->model->find('', array('id' => $model_obj->attributes['parent_id']));
  //   if(!empty($previous_process)){
  //   $previous_process_department_columns = @get_process_structures()[$previous_process['department_name']];
  //   }
  //   $current_process_department_columns = @get_process_structures()[$model_obj->attributes['department_name']];
  //   $last_department_name = end($process_obj->departments);


  //   $next_process = $this->model->find('', array('parent_id' => $model_obj->attributes['id']), '', 
  //                                             array('order_by' => 'id desc'));
  //   if (!empty($next_process))
  //     $next_process_department_columns = @get_process_structures()[$next_process['department_name']];
  //   $data = array('current_process' => 
  //                 array('view_html' => $this->load->view('processes/processes/form', 
  //                                                        array('process' => $model_obj->attributes,
  //                                                              'department_columns' => $current_process_department_columns,
  //                                                              'last_department_name' => $last_department_name), TRUE),
  //                       'row_id' => get_row_id($model_obj->attributes['row_id'], $model_obj->attributes['department_name'])),
  //                 'previous_process' => 
  //                   array('view_html' => $this->load->view('processes/processes/form', 
  //                                                          array('process' => $previous_process,
  //                                                                'department_columns' => @$previous_process_department_columns,
  //                                                                'last_department_name' => $last_department_name), TRUE),
  //                         'row_id' => get_row_id($previous_process['row_id'], $previous_process['department_name'])),
  //                 'next_process' => (empty($next_process)) ? array() :
  //                   array('view_html' => $this->load->view('processes/processes/form', 
  //                                                          array('process' => $next_process,
  //                                                                'department_columns' => $next_process_department_columns,
  //                                                                'last_department_name' => $last_department_name), TRUE),
  //                         'row_id' => get_row_id($next_process['row_id'], $next_process['department_name'])));
  //   return $data;
  // }
  // public function get_ajax_failure_data($model_obj, $action) {
  //   $current_process_department_columns = @get_process_structures()[$model_obj->attributes['department_name']];
  //   $last_department_name = end($model_obj->departments);
  //   $data = array('current_process' => 
  //                 array('view_html' => $this->load->view('processes/processes/form', 
  //                                                        array('process' => $model_obj->attributes,
  //                                                              'department_columns' => $current_process_department_columns,
  //                                                              'last_department_name' => $last_department_name), TRUE),
  //                       'row_id' => get_row_id($model_obj->attributes['row_id'], $model_obj->attributes['department_name'])),
  //                 );
  //   return $data;     
  // }
  // public function _after_save($formdata, $action) {
  //   $this->data['ajax_success_function'] = 'window.location.replace("'.ADMIN_PATH.'departments/melting?room=1&room_name=Melting Room")';
  //   return $formdata;
  // }
}