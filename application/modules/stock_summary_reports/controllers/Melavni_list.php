<?php
class Melavni_list extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if(@$_GET['type_of'] == 'opening')
      $this->where = 'alloy_weight IS NOT NULL and created_at <"'.$_GET['start_date'].'"';

    if(@$_GET['type_of'] == 'in_weight')
      $this->where = "alloy_weight IS NOT NULL and 
                      created_at >= '".$_GET['start_date']."' and 
                      created_at < '".$_GET['end_date']."'";
    
    if(@$_GET['type_of'] == 'out_weight')
      $this->where = "alloy_weight IS NOT NULL and 
                      created_at >= '".$_GET['start_date']."' and 
                      created_at < '".$_GET['end_date']."'";

    if(@$_GET['type_of'] == 'balance')
      $this->where = "alloy_weight IS NOT NULL created_at <='".$_GET['end_date']."'";
    
    parent::index();
  }
}