<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
//   header("Access-Control-Allow-Origin: *");
//   header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS, PUT");
//   header("Access-Control-Allow-Headers: Authorization, authToken, hash");
//   die();
// }

class Factory_orders extends CI_Controller {


    public function __construct()
    {  
     // header('Access-Control-Allow-Origin: *');
        parent::__construct();
        $this->load->helper('url');  
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation')); 
        $this->load->model(array('Factory_order_model')); 
    }


    /**************************  START FETCH OR VIEW FORM DATA ***************/
    public function index()
    {
        $this->data['factory_orders']= $this->Factory_order_model->listing_data();
        $this->load->view('factory_orders', $this->data, FALSE);
    }
    /****************************  END FETCH OR VIEW FORM DATA ***************/


    /****************************  START OPEN ADD FORM FILE ******************/
    public function add_data()
    {   $this->data['meltings']= array(array('id'=>'92','name'=>'92'),
                                       array('id'=>'75','name'=>'75'));
        $this->data['factory_order_details']=array(array());
        $this->data['action']= 'submit_data';

        $this->load->view('factory_order_add', $this->data, FALSE);
    }
    /****************************  END OPEN ADD FORM FILE ********************/

    
    /****************************  START INSERT FORM DATA ********************/
    public function submit_data()
    {   $this->data['meltings']= array(array('id'=>'92','name'=>'92'),
                                       array('id'=>'75','name'=>'75'));
        $this->data['action']= 'submit_data';
        $this->data['factory_orders']=$this->input->post('factory_orders');
        $this->data['factory_order_details']=$this->input->post('factory_order_details');
        $this->data['factory_order_details']=!empty($this->data['factory_order_details'])?$this->data['factory_order_details']:array(array());
        $this->form_validation->set_rules('factory_orders[customer_name]','Customer Name','required'); 
        $this->form_validation->set_rules('factory_orders[melting]','Melting','required');
        $this->form_validation->set_rules('factory_orders[date]','Date','required');
        $this->form_validation->set_rules('factory_orders[due_date]','','callback_validate_market_design_name');
        $this->form_validation->set_message('validate_market_design_name','selected market design name not exist in master.');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('factory_order_add', $this->data, FALSE);
        } 
        else 
        {
            $insert = $this->Factory_order_model->insert_data($this->input->post());
            $this->session->set_flashdata('message', 'Your data inserted Successfully..');
            redirect('factory_orders/index');
        }
        
    }
    /****************************  END INSERT FORM DATA ************************/


    /****************************  START FETCH OR VIEW FORM DATA ***************/
    public function view_data($id)
    {
        $this->data['factory_orders']= $this->Factory_order_model->view_data($id);
        $this->data['factory_order_details']= $this->Factory_order_detail_model->view_data($id);
        $this->load->view('factory_order_views', $this->data, FALSE);
    }
    /****************************  END FETCH OR VIEW FORM DATA ***************/

    
    /****************************  START OPEN EDIT FORM WITH DATA *************/
    public function edit_data($id)
    {   $this->data['action']= 'update_data';
        $this->data['meltings']= array(array('id'=>'92','name'=>'92'),
                                       array('id'=>'75','name'=>'75'));
        $this->data['record']= $this->Factory_order_model->edit_data($id);
        $this->data['factory_order_details']= $this->Factory_order_model->factory_order_detail_data($id);
        $this->data['factory_order_details']=!empty($this->data['factory_order_details'])?$this->data['factory_order_details']:array(array());
        $this->load->view('factory_order_add', $this->data, FALSE);
    }
    /****************************  END OPEN EDIT FORM WITH DATA ***************/


    /****************************  START UPDATE DATA *************************/
    public function update_data($id)
    {
        $this->data['meltings']= array(array('id'=>'92','name'=>'92'),
                                       array('id'=>'75','name'=>'75'));
        $this->data['action']= 'update_data';
        $this->data['record']= $this->Factory_order_model->edit_data($id);
        $this->data['factory_orders']=$this->input->post('factory_orders');
        $this->data['factory_order_details']=$this->input->post('factory_order_details');
        $this->form_validation->set_rules('factory_orders[customer_name]','Customer Name','required'); 
        $this->form_validation->set_rules('factory_orders[melting]','Melting','required');
        $this->form_validation->set_rules('factory_orders[date]','Date','required');
        $this->form_validation->set_rules('factory_orders[due_date]','','callback_validate_market_design_name');
        $this->form_validation->set_message('validate_market_design_name','selected market design name not exist in master.');


        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('factory_order_add', $this->data, FALSE);
        } 
        else 
        {
            $data = $this->input->post();
            $this->Factory_order_model->update_data($id,$data);
            $this->Factory_order_detail_model->update_data($id,$data);
            $this->session->set_flashdata('message', 'Your data updated Successfully..');
            redirect('factory_orders/index');
        }
    }
    /****************************  END UPDATE DATA ****************************/


    /****************************  START DELETE DATA **************************/
    public function delete_data($id)
    {  
        $this->db->where('id', $id);
        $this->db->delete(''.FACTORY_DB.'.ka_chain_factory_orders');
        $this->db->where(''.FACTORY_DB.'.ka_chain_factory_order_id', $id);
        $this->db->delete('ka_chain_factory_order_details');
        $this->session->set_flashdata('message', 'Your data deleted Successfully..');
        redirect('factory_orders/index');
    }
    /****************************  END DELETE DATA ***************************/
    public function factory_order_master_list(){
        $postData = $this->input->post();
        $data = $this->Factory_order_model->get_factory_order_master_data($postData);
        echo json_encode($data);
    }
    public function validate_market_design_name(){

       if(!empty($this->data['factory_order_details']))
            {
                // Loop through hotels and add the validation
                $counter=0;
                foreach($this->data['factory_order_details'] as $index => $factory_order_detail)
                {  
                    
                    if(!empty($factory_order_detail['market_design_name'])){
                        $market_design_name = $this->Factory_order_model->is_market_design_name_exist($factory_order_detail['market_design_name']);
                        if(!empty($market_design_name)){
                            $counter++;
                        } else{
                            $counter=0;
                        }   
                    }
                }
            }
            if($counter==0){
                return false;
            }else{
                return true;
            }
        
    }

}