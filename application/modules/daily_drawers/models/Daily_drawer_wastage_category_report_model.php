<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_wastage_category_report_model extends BaseModel {
  protected $table_name = "loss_categories";
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }
}