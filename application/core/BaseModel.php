<?php

/*************************************************************************
*
* ASCRA TECHNOLOGIES CONFIDENTIAL
* __________________
*
*  All Rights Reserved.
*
* NOTICE:  All information contained herein is, and remains
* the property of Ascra Technologies and its suppliers,
* if any.  The intellectual and technical concepts contained
* herein are proprietary to Ascra Technologies
* and its suppliers and may be covered by U.S. and Foreign Patents,
* patents in process, and are protected by trade secret or copyright law.
* Dissemination of this information or reproduction of this material
* is strictly forbidden unless prior written permission is obtained
* from Ascra Technologies.
* version = 1.4
*/

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "core/logic_traits/Validation_trait.php";
require_once APPPATH . "core/Listing_trait.php";

class BaseModel extends CI_Model {
  use validation_trait;
  use listing_trait;

  protected $maintain_log = true;
  protected $log_columns = array();
  public $router_class = '';
  public $attributes = array();
  public $formdata_batch = array();
  public $formdata = array();
  public $filedata = array();
  protected $load_trigger = false;
  public $db_name = 'default';


  public function __construct($data=array()) {
    parent::__construct();
    $this->db_conn = $this->db;
    if(!empty($data)) $this->set_formdata_and_attributes($data);
  }
  

  public function set_database_name($db_name){
    require(APPPATH.'config/'.ENVIRONMENT.'/database.php');
    $this->db_conn = $this->load->database($db[$db_name],TRUE);

  }

  public function validate($validation_klass='') {
    $this->before_validate();
    $rules = $this->validation_rules($validation_klass);
    if(empty($rules)) return false;
    $this->form_validation->reset_validation();
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_data($this->formdata);
    return $this->form_validation->run();
   //pr($this->form_validation->error_array());
    //echo validation_errors();die;
  }

  public function save($after_save=true) { 
    if (empty($this->attributes['id']))
      $this->store($after_save);
    else
      $this->update($after_save);
  }

  public function store($after_save=true) {
   
    $this->attributes['created_at'] = date('Y-m-d H:i:s');
    $this->attributes['updated_at'] = $this->attributes['created_at'];
    $this->attributes['created_by'] = @$_SESSION['user_id'];
    $this->before_save('store');
    if ($this->db_conn->insert($this->table_name, $this->attributes)) {
      $this->attributes['id'] = $this->db_conn->insert_id();
      // if ($this->maintain_log) $this->Change_log_model->save_record($data, 'store', $this->model_name);
      if ($after_save) $this->after_save('store');
      if($this->load_trigger == true)
        $this->call_triggers('store',$this->attributes,'','');
      return $this->attributes;
    } else
      return array('status' => 'failure');
  }

  public function update($after_save=true, $conditions=array(), $action='update', $update_user_and_time = true) {
    $id = @$this->attributes['id'];
    if (empty($id) && empty($conditions)) return false;
    
    if ($update_user_and_time) {
      $this->attributes['updated_at'] = date('Y-m-d H:i:s');
      $this->attributes['updated_by'] = @$_SESSION['user_id'];
    }
    if ($action=='update') $this->before_save('update');
   
    if (!empty($id)) {
      $existing_attributes = $this->find('', array('id' => $id));
      if (empty($existing_attributes)) $existing_attributes= array();
      $changed_attributes = array_diff_assoc($this->attributes, $existing_attributes);
      $this->attributes = $changed_attributes;
    }
    unset($this->attributes['id']);

    $this->db_conn->set($this->attributes);
    if (!empty($id)) $conditions['where']['id'] = $id;
    $this->db_conditions($conditions);  
    /*if($this->maintain_log) $this->Change_log_model->save_record($data, 'update', $this->model_name);*/
   
    if (empty($this->attributes) || ($this->db_conn->update($this->table_name, $this->attributes))) {

      $this->attributes['id'] = $id;
     
      if (!empty($id)) {
        $missed_attributes = array_diff_key($existing_attributes, $this->attributes);
        $this->attributes = array_merge($this->attributes, $missed_attributes);
      }
      
      if ($after_save) $this->after_save('update');
  
      if($this->load_trigger == true)
        $this->call_triggers('update',$this->attributes,$changed_attributes,$existing_attributes);
      return $this->attributes;
    } else
      return array('status' => 'failure', 'id' => $id);
  }


  public function find($select = '*', $conditions = array(), $joins = array(), $operations=array()) {
    $operations['row_array'] = true;
    return $this->get($select, $conditions, $joins, $operations);
  }

  public function get($select = '*', $conditions = array(), $joins = array(), $operations=array()) {
    //$this->db->reset_query();
    //$this->db_conn->reset_query();
    if(!empty($operations['table'])) $this->table_name = $operations['table'];
    $this->db_conn->select($select);
    $this->db_conn->from($this->table_name);
    if(!empty($joins))
      foreach ($joins as $index => $join)
        $join = $this->db_conn->join($join[0], $join[1], (isset($join[2])) ? $join[2] :'inner');
    $this->db_conditions($conditions,$operations);

    if(isset($operations['order_by'])) $this->db_conn->order_by($operations['order_by']);
    if(isset($operations['limit']) && !empty($operations['limit'][1])) $this->db_conn->limit($operations['limit'][1],$operations['limit'][0]);
    if(isset($operations['group_by'])) $this->db_conn->group_by($operations['group_by']);
    if(isset($operations['having'])) $this->db->having($operations['having']);
    $this->db_conn->where($this->table_name.'.is_delete !=',1);
   
    $query = $this->db_conn->get();
    if(isset($operations['row_array']) && $operations['row_array'])
      return $query->row_array();    
    else
      return $query->result_array();
  }

  public function delete($id, $conditions=array(), $permanent_delete=TRUE, $after_delete=TRUE) {
    if (empty($id) && empty($conditions)) return false;
    $this->before_delete($id);
    //if($this->maintain_log) $this->Change_log_model->save_record($data, 'delete', $this->model_name);
    $this->attributes = array();
    if($permanent_delete == false):
      if ($id !='') $this->attributes['id'] = $id;
      $this->attributes['is_delete'] = 1;
      $this->update(false, $conditions, 'delete');
    else:
      if ($id !='')
        $this->db_conn->where('id', $id);
      else
        $this->db_conditions($conditions);
      $this->db_conn->delete($this->table_name);
    endif;
    if($after_delete == TRUE) $this->after_delete($id, $conditions);
    return true;
  }

  public function before_validate(){}
  public function before_save($action){}
  public function after_save($action){}
  public function before_delete($id){}
  public function after_delete($id, $conditions){}
  public function get_ajax_success_data($action) {return $this->attributes;}
 
  public function set_formdata_and_attributes($data) {
    if(empty($this->router_class)) $this->router_class = $this->table_name;
    if(!isset($data[$this->router_class])) $data = array($this->router_class => $data);
    $this->formdata = $data;
    $this->attributes = &$this->formdata[$this->router_class];
   
    if (!empty($this->attributes['id'])) {
      $this->db->reset_query();
      $existing_attributes = $this->find('', array('id' => $this->attributes['id']));

      $missed_attributes = array_diff_key($existing_attributes, $this->attributes);
      $this->attributes = array_merge($this->attributes, $missed_attributes);
    }

    if (isset($_FILES[$this->router_class])) $this->filedata = $_FILES[$this->router_class];
  }

  private function db_conditions($conditions,$operations=array()) {

    if(isset($operations['protected_identifier']))
      $protected_identifier = $operations['protected_identifier'];
    else $protected_identifier = true;
    $this->db_conn->_protect_identifiers =  $protected_identifier;
    
    if(isset($operations['is_string']) && $operations['is_string'] == true) $is_string_type = true; else $is_string_type = false;

    if(isset($conditions['where'])) $this->db_conn->where($conditions['where']);
    if(isset($conditions['or_where'])) $this->db_conn->or_where($conditions['or_where']);
    if(isset($conditions['where_in'])) $this->db_conn->where_in($conditions['where_in'],'',$is_string_type);
    if(isset($conditions['where_not_in'])) $this->db_conn->where_not_in($conditions['where_not_in'],'',$is_string_type);
    if(isset($conditions['like']) && !is_array($conditions['like']))
      $this->db_conn->like($conditions['like']);
    if(isset($conditions['like']) && is_array($conditions['like'])){
      $this->db_conn->group_start();
      foreach ($conditions['like'] as $like_key => $like_value) {
        foreach ($like_value as $value_key => $like) {
          $this->db_conn->like($like_key,$like);
        }
      }
      $this->db_conn->group_end();
    }
    foreach($conditions as $field => $value){
      //var_dump(in_array($field, array('where', 'where_in', 'like','where_not_in')));die;
      if (in_array($field, array('where', 'where_in', 'like','where_not_in','or_where')) == false){
        if(!is_array($value)){
          if(isset($operations['is_string'])) $is_string = $operations['is_string'];else $is_string = true;
          $this->db_conn->where($field,$value,$is_string);
        }
        if(is_array($value)){
          $implode_array = implode(',',$value);
          if(strpos($field, 'NOT IN') !== false)
            $this->db_conn->where_not_in(str_replace("NOT IN","",$field),$value);
          else
            $this->db_conn->where_in(str_replace("IN","",$field),$value,true);
          if(strpos($field, 'IN') !== false){
      
            $this->db_conn->where($field,$value);
          }
        }
      }
    }
  }

  private function call_triggers($action, $attributes, $changed_attributes='', $previous_attributes=''){
    if(isset($this->trigger_model) AND !empty($this->trigger_model))
      $model_name = $this->trigger_model;
    else
      $model_name = singular($this->router_class).'_trigger_model';
    $this->load->model('triggers/'.$model_name);
    $model_name::execute_event($action,$attributes,$changed_attributes,$previous_attributes);
  
  }

  public function truncate(){
    $this->db->truncate($this->table_name);
  }


  public function store_batch($after_save=true,$before_save=true){
     if ($before_save) $this->before_save('store_batch');
    if($this->truncate_table == true && !empty($this->formdata_batch)){
      $this->truncate();
    }
    //pr($this->formdata_batch);
    $this->db->insert_batch($this->table_name, $this->formdata_batch);
    if ($after_save) $this->after_save('store_batch');
    return $this->formdata_batch;
  }
  /*public function blacklisted($action){
    if(!empty($action) AND ($action == 'store' || $action == 'update')){
      $blacklisted['store'] = array('id');
      $blacklisted['update'] = array('created_at');
      return $blacklisted[$action];
    }
  }

  public function whitelisted($action){}

  private function unsetBlackListWhiteList($listed_array,$action){
    foreach($this->formdata as $form_index => $formdata):
      if(is_array($formdata)):
        foreach($formdata as $field_name => $field_value):
          if($action == 'blacklisted'):
            if(in_array($field_name,$listed_array)) unset($this->formdata[$form_index][$field_name]);
            else $this->formdata[$form_index][$field_name] = $field_value;
          else:
            if(in_array($field_name,$listed_array)) $this->formdata[$form_index][$field_name] = $field_value;
            else unset($this->formdata[$form_index][$field_name]);
          endif;
        endforeach;
      endif;
    endforeach;
  }*/
}
