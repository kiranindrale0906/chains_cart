<?php
class Factory_order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Factory_order_detail_model')); 
    }

   /**************************  START INSERT QUERY ***************/
    public function insert_data($data){
        $factory_orders=$this->db->insert(''.FACTORY_DB.'.ka_chain_factory_orders', $data['factory_orders']);
        $factory_order_id=$this->db->insert_id();
        $factory_order_details=array();
        
        foreach ($data['factory_order_details'] as $index => $value) {
          $factory_order_details=$value;
          $factory_order_details['ka_chain_factory_order_id']=$factory_order_id;
          $this->db->insert(''.FACTORY_DB.'.ka_chain_factory_order_details', $factory_order_details);
        }
        return TRUE;
    }
    /**************************  END INSERT QUERY ****************/

    
    /*************  START SELECT or VIEW ALL QUERY ***************/
    public function listing_data(){
        $query=$this->db->query("SELECT *
                                 FROM ".FACTORY_DB.".ka_chain_factory_orders 
                                 ORDER BY id DESC");

        return $query->result_array();
    }
    public function view_data($id){
        $query=$this->db->query("SELECT *
                                 FROM ".FACTORY_DB.".ka_chain_factory_orders 
                                 WHERE ".FACTORY_DB.".ka_chain_factory_orders.id = $id");

        return $query->row_array();
    }
    /***************  END SELECT or VIEW ALL QUERY ***************/

    
    /*************  START EDIT PARTICULER DATA QUERY *************/
    public function edit_data($id){
        
        $query=$this->db->query("SELECT *
                                 FROM ".FACTORY_DB.".ka_chain_factory_orders  
                                 WHERE ".FACTORY_DB.".ka_chain_factory_orders.id = $id");
        return $query->row_array();
    }

    public function factory_order_detail_data($id){
        $query=$this->db->query("SELECT *
                                 FROM ".FACTORY_DB.".ka_chain_factory_order_details  
                                 WHERE ka_chain_factory_order_id = $id");
        return $query->result_array();
    }
    public function get_factory_order_master_data($postData){

      $response = array();

      if(isset($postData['search']) ){
         // Select record
       $this->db->select('*');
       $this->db->where("market_design_name like '%".$postData['search']."%' ");

       $records = $this->db->get(''.FACTORY_DB.'.ka_chain_factory_order_masters')->result();

       foreach($records as $row ){
          $response[] = array("value"=>$row->id,"label"=>$row->market_design_name);
       }

      }

       return $response;
    }
    public function is_market_design_name_exist($name){
        $query=$this->db->query("SELECT *
                                 FROM ".FACTORY_DB.".ka_chain_factory_order_masters  
                                 WHERE ".FACTORY_DB.".ka_chain_factory_order_masters.market_design_name = '".$name."'");
        return $query->row_array();
    }
    public function update_data($id,$data){
        $this->db->where('id', $id);
        $this->db->update(''.FACTORY_DB.'.ka_chain_factory_orders', $data['factory_orders']);
        return TRUE;
    }
}