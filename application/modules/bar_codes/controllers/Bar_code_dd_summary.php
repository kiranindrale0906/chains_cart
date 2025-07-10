<?php
class Bar_code_dd_summary extends BaseController {
  protected $load_helper = false;
  public function __construct() {
    parent::__construct();
  }

  public function index(){
    if(!empty($_GET['type'])){
      if(!empty($_GET['type'])){
      $exploded = explode("_",$_GET['type']);
        $two_characters_type = "";
        foreach ($exploded as $w) {
          $two_characters_type .= strtoupper($w[0]);
        }
      }
    }
    else $two_characters_type = '';

    $get_conditional_convention = get_conditional_convention($_GET['type']);
    //pr($get_conditional_convention);
    
    if(!empty($get_conditional_convention))
      $two_characters_type = $get_conditional_convention;
    
    $get_purity_code = !empty($_GET['purity'])?'-'.purities_code($_GET['purity']):'';

    $barcode = $_GET['barcode'].$get_purity_code.(!empty($two_characters_type)?'-'.$two_characters_type:'');

    $data['barcode_data'] = $barcode;
    $data['purity'] = 'Purity: '.$_GET['purity'];
    $data['bottom_text'] =$barcode;
    $data['type'] = !empty($_GET['type'])?'Type: '.$_GET['type']:'';
    $data['layout'] = 'application';
    echo json_encode(array('js_function'=>'genrate_bar_code('.json_encode($this->load->view('bar_codes/bar_codes/dd_sumary_view',$data,true)).')')); exit;
  }

  public function view($barcode){
    $explode_data = explode('-',strtoupper($barcode));
    $code = $explode_data[0];
    $purity = code_purities(strtoupper($explode_data[1]));
    $type = get_type_full_form_from_sort_name($explode_data[2]);

    $get_redirect_controller_module = get_controller_using_code($code)['controller'];
    $column = get_controller_using_code($code)['column'];

    $url = base_url().$get_redirect_controller_module.'?type='.$type.'&column='. $column.'&purity='.$purity;
    
    redirect($url);

  }
}