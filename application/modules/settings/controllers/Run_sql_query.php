<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH . "modules/settings/helpers/run_sql_query_helper.php");

class Run_sql_query extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() { 
    ini_set('max_execution_time', 3000);
    if(isset($_GET) && !empty($_GET)) {
      if(isset($_GET['type'])&&!empty($_POST['sql_query_statement'])) {
        $sql_query_statement = $_POST['sql_query_statement'];
        if( strpos($sql_query_statement, ';') !== false ) {
          echo "Error";die;
        }
        $this->data['results'] = $this->db->query("Select ".$sql_query_statement)->result_array();
        $this->data['layout']        = 'application';
        $this->load->render('settings/run_sql_query/result_view',$this->data);
      } elseif(isset($_GET['query'])&&!empty($_GET['query'])) {
        $sql_query_statement = strstr($_GET['query']," ");
        if( strpos($sql_query_statement, ';') !== false ) {
          echo "Error";die;
        }
        $this->data['results'] = $this->db->query("Select ".$sql_query_statement)->result_array();
        $this->data['layout']        = 'application';
        $this->load->render('settings/run_sql_query/result_view',$this->data);
      } else {
        echo "No Result";
      }
    } else {
      $this->load->view('run_sql_query/run_sql_query_view');
    }
  }
}