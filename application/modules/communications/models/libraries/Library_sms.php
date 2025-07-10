<?php
require_once('application/vendor/autoload.php');
class Library_sms
{
  function __construct() {
      $this->CI = &get_instance();
      $this->CI->load->model(array('communications/configuration_model',
                                    'communications/Sms_log_model',
                                    'communications/Template_model'));
      //$this->CI->load->helper('array');
      $config  =   $this->CI->configuration_model->get();
      $this->config =$config[0];
      $this->url          = trim(SMS_API_URL);
      $this->from_number  = trim(SMS_API_FROM_NUMBER);
      $this->username     = trim(BULK_SMS_USERNAME);
      $this->password     = trim(BULK_SMS_PASSWORD);
      $this->temp_to      ='';
      $this->temp_smstext ='';
  }
  public function send($template,$input,$send_dummy_sms=false){
    if (empty($this->url) || empty($this->username) || empty($this->password)) {
          return array('Please Set up SMS Configurations');
    }

    if ($send_dummy_sms == true)
      $sms_data= $input;
    else
     $sms_data =$input['data'];
    
    $sms_input = array();
    $sms_input = $this->array_append($sms_input,$this->CI->Template_model->render_sms($template, $sms_data,false));
    
    if(empty($sms_input['mobile_no']) || $sms_input['mobile_no']==''){
      return true;
    }

    if(empty($sms_input['smstext']) || $sms_input['smstext']==''){
      return true;
    }

    if (strpos($sms_input['mobile_no'], '+') !== false) {
      $this->temp_to        = $sms_input['mobile_no'];
    }else{
      $this->temp_to        = '+'.$sms_input['mobile_no'];
    }
    $this->temp_smstext   = $sms_input['smstext'];
    $messages = array('To'=>$this->temp_to, 'From' => $this->from_number, 'Body'=>$sms_input['smstext']);
    $result = $this->send_message(http_build_query($messages),$this->url , $this->username, $this->password);

    if ($result['http_status'] != 201) {
      return array('status' => 'error', 'msg'=>$result['server_response']);
    } else {
      return array('status' => 'success', 'msg'=>'Message Successfully Send to '.$this->temp_to);
    }
  }

  private function send_message ( $post_body, $url, $username, $password) 
  {
  //if(ENVIRONMENT=='production'){
      $ch = curl_init();
      $headers = array(
          'Content-Type:application/json',
          'Authorization:Basic '.$username.':'.$password
      );
      curl_setopt ( $ch, CURLOPT_USERPWD, $username.':'.$password );
      curl_setopt ( $ch, CURLOPT_URL, $url );
      curl_setopt ( $ch, CURLOPT_POST, 1 );
      curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
      curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
      curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
      $output = array();
      $output['server_response'] = curl_exec( $ch );
      $curl_info = curl_getinfo( $ch );
      $output['http_status'] = $curl_info[ 'http_code' ];
      curl_close( $ch );
 /* }else{
      $output['server_response'] = 'Sms Functionality available only on Live.';
      $output['http_status'] = 'staging';
  }*/
    $this->store($output,$post_body);
    return $output;
  }

  private function store($output,$post_body) {
    
    $insert_array = array('smsto'       => $this->temp_to,
                          'smsfrom'     => $this->username,
                          'apiurl'      => $this->url,
                          'postfields'  => $post_body,
                          'created_at'  => date('Y-m-d H:i:s'),
                          'updated_at'  => date('Y-m-d H:i:s'),
                          'smstext'     => $this->temp_smstext,
                          );
    if ($output['http_status'] != 201) {
      $insert_array['curlresponse'] = $output['server_response'];
      $insert_array['status']       = 'error';
    }else{
      $insert_array['status']       = 'success';
      $insert_array['curlresponse'] = $output['server_response'];
    }
    $this->CI->Sms_log_model->save($insert_array);
  }

  private function array_append($source, $data) {
    foreach($data as $key => $value) {
      $source[$key] = $value;
    }
    return $source;
  }

}