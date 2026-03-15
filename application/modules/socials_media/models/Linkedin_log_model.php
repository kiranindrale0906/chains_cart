<?php

class Linkedin_log_model extends BaseModel
{
  public function __construct() {
    parent::__construct();
  
  }

    public function insert_log($value,$respose_return ){
	    $data = array(
	          'email' => $value['email'],
	          'linkedin_title'=>@$value['linkedin_title'],
	          'linkedin_link'=> (isset($respose_return['update-url'])? $respose_return['update-url']:''),
	          'linkedin_response' => json_encode($respose_return),
	          'is_share' => (isset($respose_return['update-url'])?'Yes':'No'),
	          'shared_by' => $this->user_id,
	          'created_at'=> date('Y-m-d h:s:i')
	        );
	    $this->db->insert('linkedin_log',$data); 
    }

}