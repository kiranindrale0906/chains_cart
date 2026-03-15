<?php

class Linkedin_model extends BaseModel
{
  protected $table_name = 'users';
  protected $id = 'id';

  public function __construct() {
    parent::__construct();
  }
}
