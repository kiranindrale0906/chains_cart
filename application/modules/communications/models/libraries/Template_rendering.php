  <?php
  class Template_rendering {

   protected $CI;

    public function __construct()
    {
      $this->CI =& get_instance();    
    }

    public function get($html_contents,$data)
    {
      $html_contents = $this->put_all_values_of_variables($html_contents,@$data['variables']);
      $html_contents = $this->run_all_foreach_iterations($html_contents,@$data['each']);
      $html_contents = $this->check_if_condiration($html_contents);
      return $html_contents;
    }

  /***************************************************************************************************************************/
  /*  PUT VARIABLES                                                                                                          */
  /***************************************************************************************************************************/
    private function put_all_values_of_variables($html_contents,$data=array())
    {
      /*$data['FRONTEND_PATH']        = CLI_FRONTEND_PATH;
      $data['FRONTEND_ASSETS_PATH'] = CLI_FRONTEND_ASSETS_PATH;*/
      if (!empty($data)) {
        foreach ($data as $key => $value){
          if(!is_array($value)){
            $html_contents = str_replace('{{'.$key.'}}', $value, $html_contents);
          }else{
            foreach ($value as $second_key => $second_value) {
              $html_contents = str_replace('{{'.$key.'.'.$second_key.'}}', $second_value, $html_contents);
            }
          }
        }
      }
      return $html_contents;
    }

  /***************************************************************************************************************************/
  /*  FOREACH PART                                                                                                           */
  /***************************************************************************************************************************/
    private function run_all_foreach_iterations($html_contents,$data=array())
    {
      $all_lines = explode("\n", $html_contents);
      $response =array();
      $append_html = true;
      foreach ($all_lines as $line_no => $line) {
        if (strpos($line, '{#each') !== false) { /*check for exists*/
          $append_html=false;
          $each_array_name = trim(str_replace(array('{#each','#}'), '', $line));
          $each_array=array();
        }
        if ($append_html==true){ /*append line by line*/
          $response[] = $line;
        }
        if (strpos($line, '{#endeach#}') !== false) {
           $append_html=true; 
           $looping_content = $this->get_each_block_content(@$data[$each_array_name],$each_array);
           $response = array_merge($response,$looping_content);
           $each_array=array();
           $$each_array_name="";
        }

        if(!empty($each_array_name)){ /*loop part*/
          $each_array[]=$line;
        }
      }
      return  implode("\n", $response);
    }

    private function get_each_block_content($array_name=array(),$html_content)
    {
      unset($html_content[0]);
      $response_array = array();
      $iteration_html =  implode("\n", $html_content);
      if(!empty($array_name)){
        foreach ($array_name as $key) {
          $html =$iteration_html;
          foreach ($key as $colimn => $value) {
            $html = str_replace('{{this.'.$colimn.'}}', $value, $html);
          }
          $response_array[]=$html;
        }
      }
        return $response_array;
    }



  /***************************************************************************************************************************/
  /*  IF Part                                                                                                                */
  /***************************************************************************************************************************/

  private function check_if_condiration($html_content)
  {
    $all_lines = explode("\n", $html_content);
    //print_r($all_lines);die();
    $response =array();
    $append_html = true;
    $if_condition =0;
    $first_if_result = false;
    foreach ($all_lines as $line_no => $line) {
      $skip_row='show';
      if (strpos($line, '{#if') !== false) { /*check if conditions*/
        $append_html=false;
        $if_condition++;
        $where_condition[$if_condition] = str_replace(array('{#if','#}'), '', $line);
        $where_condition_data[$if_condition] = $this->get_where_condition_data($where_condition[$if_condition]);
        $skip_row='hide';
        
      }

      if ($append_html==true){ /*append line by line*/
        $response[] = $line;
      }


      if (strpos($line, '{#endif') !== false){ /* check end if */
        $append_html=true;
        if(!empty($if_lines[$if_condition]) && $first_if_result==true){
          $response= array_merge($response,$if_lines[$if_condition]);
        }
        if($if_condition != 1){
          $append_html=false;
          $skip_row='hide';
        }
        if(!empty($if_lines[$if_condition])){
          unset($if_lines[$if_condition]);
        }
        unset($where_condition_data[$if_condition]);
        $if_condition--;

      }


      if (!empty($where_condition_data[$if_condition])) { /*check condtion is true or not */
        $first_param          = trim($where_condition_data[$if_condition][0]);
        $second_param         = trim($where_condition_data[$if_condition][1]);
        $comaprsion_operator  = trim($where_condition_data[$if_condition][2]);
        $if_condition_result = $this->get_check_if_condition($first_param,$second_param,$comaprsion_operator);
        if($if_condition==1){
          $first_if_result = $if_condition_result;
        }
        if ($if_condition_result) {
          if($skip_row=='show'){
            $if_lines[$if_condition][] = $line;
          }
        }
      }
    }
    return implode("\n", $response);
  }

  private function get_check_if_condition($first_param,$second_param,$comaprsion_operator)
  {
        switch ($comaprsion_operator) {
            case '<'  : { if($first_param < $second_param){   return true; } break; }
            case '==' : { if($first_param == $second_param){  return true; } break; }
            case '>'  : { if($first_param > $second_param){   return true; } break; }
            case '!=' : { if($first_param != $second_param){  return true; } break; }
            default   : return false;  break;
        }
    }

  private function get_where_condition_data($line)
  {
      $separtor=" ";
      if (strpos($line, '==') !== false) {
        $separtor="==";
      }
      if (strpos($line, '!=') !== false) {
        $separtor="!=";
      }
      if (strpos($line, '>') !== false) {
        $separtor=">";
      }
      if (strpos($line, '<') !== false) {
        $separtor="<";
      }
        $where_condition = explode($separtor, $line);
        $where_condition[] =$separtor;
        return $where_condition;
  }


  /***************************************************************************************************************************/
  /*  END IF PART                                                                                                            */
  /***************************************************************************************************************************/
}