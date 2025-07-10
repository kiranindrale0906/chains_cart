<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_wastages extends BaseController {	
	public function __construct(){
	 parent::__construct();
   $this->load->model(array('settings/same_karigar_model', 'processes/process_model', 'settings/karigar_model'));
  }  

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
  public function _get_form_data() {
    $this->data['karigars']=$this->same_karigar_model->get('distinct(karigar_name) as name,karigar_name as id',
     array('where_in'=>array('department_name'=>array('"AU+FE"','"Chain Making"','"Filing"','"Hook"','"Joining Department"','"Lobster"','"Lobster In"','"Lobster Out"','"Machine Department"','"Refresh-Repairing"','"Refresh-Repairing"','"Stamping"','"Spring"'))));
    //$this->data['karigars'] = $this->karigar_model->get('distinct(karigar_name) as name ,karigar_name as id');
    $this->data['chains'] = $this->process_model->get('DISTINCT(chain_name) as name, chain_name as id',array('chain_name!='=>''));
    $this->data['karigars']=array_merge($this->data['karigars'],array(array('id'=>'Refresh','name'=>'Refresh'),array('id'=>'Rnd','name'=>'Rnd')));
    // array_push($this->data['chains'] , array('name' => 'Fancy Chain','id' => 'Fancy Chain'));
  }

  public function _before_validate($formdata, $action) {
    $formdata['daily_drawer_wastages']['process_sequence'] = 0;
    $formdata['daily_drawer_wastages']['melting_lot_id'] = 0;
    $formdata['daily_drawer_wastages']['row_id'] = rand();
    $formdata['daily_drawer_wastages']['department_name'] = 'Daily Drawer Wastage';
    $formdata['daily_drawer_wastages']['daily_drawer_out_weight'] = $formdata['daily_drawer_wastages']['in_weight'];
    $formdata['daily_drawer_wastages']['daily_drawer_wastage'] = $formdata['daily_drawer_wastages']['in_weight'];
    $formdata['daily_drawer_wastages']['in_weight'] = $formdata['daily_drawer_wastages']['in_weight'] + $formdata['daily_drawer_wastages']['in_weight'];
    $this->attributes['hook_kdm_purity'] = $formdata['daily_drawer_wastages']['in_weight']['in_lot_purity'];
    return $formdata;
  }
}
