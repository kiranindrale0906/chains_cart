<?php
class Factory_order_detail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

   /**************************  START INSERT QUERY ***************/
    public function insert_data($data){
        $this->db->insert(''.FACTORY_DB.'.ka_chain_factory_orders', $data); 
        return TRUE;
    }
    /**************************  END INSERT QUERY ****************/

    
    /*************  START SELECT or VIEW ALL QUERY ***************/
    public function view_data($id){
        $this->db->select('`'.FACTORY_DB.'.ka_chain_factory_order_details`.*, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`category_name` as `category_name`, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`design_name` as `design_name`, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`gauge` as `gauge`, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`wt_in_18_inch` as `wt_in_18_inch`, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`wt_in_24_inch` as `wt_in_24_inch`, `'.FACTORY_DB.'.ka_chain_factory_order_masters`.`line` as `line`');
        $this->db->from(''.FACTORY_DB.'.ka_chain_factory_order_details');
        $this->db->join(''.FACTORY_DB.'.ka_chain_factory_order_masters', ''.FACTORY_DB.'.ka_chain_factory_order_details.market_design_name = '.FACTORY_DB.'.ka_chain_factory_order_masters.market_design_name', 'left');
        $this->db->where(''.FACTORY_DB.'.ka_chain_factory_order_details.ka_chain_factory_order_id', $id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function update_data($id,$data){
        $this->db->where('ka_chain_factory_order_id', $id);
        $this->db->delete(''.FACTORY_DB.'.ka_chain_factory_order_details');
        $factory_order_details=array();
        $this->data['factory_order_details']=!empty($data['factory_order_details'])?$data['factory_order_details']:array(array());
        foreach ($data['factory_order_details'] as $index => $value) {
          $factory_order_details=$value;
          $factory_order_details['ka_chain_factory_order_id']=$id;
          $this->db->insert(''.FACTORY_DB.'.ka_chain_factory_order_details', $factory_order_details);
        }

    }
}