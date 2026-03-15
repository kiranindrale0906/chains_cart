<?php
class Factory_order_master_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Factory_order_detail_model')); 
    }
    public function listing_data($market_design_name='',$design_name='',$category_name='',$gauge='',$line=''){
        $this->db->select('*');
        $this->db->from(''.FACTORY_DB.'.ka_chain_factory_order_masters');
        if(!empty($market_design_name)){
            $this->db->like('market_design_name', $market_design_name);
        } if(!empty($design_name)){
            $this->db->like('design_name', $design_name);
        } if(!empty($market_design_name)){
            $this->db->like('market_design_name', $market_design_name);
        } if(!empty($category_name)){
            $this->db->like('category_name', $category_name);
        } if(!empty($gauge)){
            $this->db->like('gauge', $gauge);
        }if(!empty($line)){
            $this->db->like('line', $line);
        }
        return $this->db->get()->result_array();
    }

}