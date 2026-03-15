<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Factory_order_masters extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');                    /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->model(array('Factory_order_master_model')); /* LOADING MODEL * Welcome_model as welcome */
    }


    /**************************  START FETCH OR VIEW FORM DATA ***************/
      public function index()
    {
        $market_design_name=!empty($_GET['market_design_name'])?$_GET['market_design_name']:'';
        $design_name=!empty($_GET['design_name'])?$_GET['design_name']:'';
        $category_name=!empty($_GET['category_name'])?$_GET['category_name']:'';
        $gauge=!empty($_GET['gauge'])?$_GET['gauge']:'';
        $line=!empty($_GET['line'])?$_GET['line']:'';

        $this->data['factory_order_masters']= $this->Factory_order_master_model->listing_data($market_design_name,$design_name,$category_name,$gauge,$line);
        $this->load->view('factory_order_masters', $this->data, FALSE);
    }
}
   