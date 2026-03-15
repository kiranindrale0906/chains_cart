communications/<?php
  class Library_push_notification{

  function __construct() {
    $this->CI = &get_instance();
    $this->CI->load->model(array('communications/configuration_model',
                                 'communications/Template_model',
                                 'communications/Pushnotification_log_model',
                                 'user_device_token/user_device_token_model',
                                 'users/user_model'));
    $config  =   $this->CI->configuration_model->get();
    $this->config =$config[0];
    $this->pushtoken = trim($this->config['pushtoken']);
    $this->CI->load->helper('array');
  }
   
  public function send($template,$data,$send_dummy_notification=false) {
    if (empty($this->pushtoken)) 
      return array('Please set up configuration for push notifications.');
    
    $errors = $this->check_params($data['template']);
    if (!empty($errors))
      return $errors;

    $push_notifications_input = array();
    $push_notifications_input = $this->array_append($push_notifications_input,$this->CI->Template_model->render_pushnotification($template, $data['template']['data'],false));
    $user = $this->CI->user_model->find('id',array('email="'.$web_push_notifications_input['user_email'].'"'));
    if (!empty($user)){
     $user_id = $user['id'];
    }
    if(ENVIRONMENT!='production'){
      $web_push_notifications_input['user_email'] = 'sandip.bikkad@ascratech.in';
      $user = $this->CI->user_model->find('id',array('email_id='=>$web_push_notifications_input['user_email']));
       if (!empty($user)){
       $user_id = $user['id'];
       }
          
      } elseif ($send_dummy_notification == true) {
        $user_id = $data['user_id'];
      }
      $condition =array('user_id'=>$user_id);
      $push_notifications_input['user_device_tokens']  = $this->CI->user_device_token_model->get('device_token, device_type',$condition);
      $push_notifications_input['device_token'] = array_column($push_notifications_input['user_device_tokens'],'device_token');
      if (empty($push_notifications_input['user_device_tokens'])) 
        return array('status'=>'error','msg'=>'No tokens found');
      
      if(empty($push_notifications_input['user_email']) || $push_notifications_input['user_email'] ==''){
        return true;
      }

      if(empty($push_notifications_input['pushtext']) || $push_notifications_input['pushtext'] ==''){
       return true;
      }
      if(empty($push_notifications_input['url']) || $push_notifications_input['url'] ==''){
       return true;
      }
      if(empty($push_notifications_input['image']) || $push_notifications_input['image'] ==''){
       return true;
      }
      $response = array();
      $input    = elements(array('pushtext', 'url', 'image','device_token'), $push_notifications_input);
      $title="Coremvc";
      $fcmdata = array(
        'body'   => $input['pushtext'],
        'title'  => $title,
        'sound'  => "default",
        'color'  => "#203E78" ,
        'openURL'=> $input['url'],
        'image'  => $input['image']);
      $fcmFields = array(
        'registration_ids'  => (array)$input['device_token'],
        'priority'          => 'high',
        'notification'      => $fcmdata,
        'data'              => $fcmdata);
      if (!empty($input['image']))
        $fcmFields['mutable_content'] = true;
      foreach ($push_notifications_input['user_device_tokens'] as $user_device_token) {
        $fcmRequestData = $fcmFields;
        $device_tokens  = $user_device_token['device_token'];
        $device_type    = $user_device_token['device_type'];
        $badge_count    = 1; 

        $fcmRequestData['registration_ids'] = explode(',', $device_tokens);
        if (!empty($badge_count))
          $fcmRequestData['notification']['badge'] = $fcmRequestData['data']['badge'] = $badge_count;

        if ($device_type =="" || empty($device_type)) { //send to ios and then android
          $response[] = $this->send_push_notification($fcmRequestData, $title, $input);
          unset($fcmRequestData['notification']);
        } else if ($device_type!=md5('ios')) //andriod does not require notifications key
          unset($fcmRequestData['notification']);

        $response[] = $this->send_push_notification($fcmRequestData, $title, $input);
      }
      return $response;
      
    }

    private function send_push_notification($fcmFields,$title,$input)
    {
      $headers = array(
        'Authorization: key=' .$this->pushtoken,
        'Content-Type: application/json'
      );
      $ch = curl_init();
      curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
      curl_setopt( $ch,CURLOPT_POST, true );
      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
      $result = curl_exec($ch );
      curl_close($ch);
      if ($result === FALSE){
        return array('status'=>'error','msg'=>curl_error($ch));
      }else{
        $input['created_at']  = date('Y-m-d H:i:s');
        $input['title']       = $title;
        $input['device_token']= json_encode($fcmFields['registration_ids']);
        $input['fcm_response']= $result;
        $input['api_access_key']= $this->pushtoken;
        $input['msg'] = $input['pushtext'];
        unset($input['pushtext']);
        $this->CI->Pushnotification_log_model->save($input);
        return array('status'=>'success',$result);
      }
    }

    private function check_params($params) {
      $response =array();
      if (empty($params['data']))
        $response = array('status'=>'error', 'msg'=>'Template data is missing');
      
      if (empty($params['id'])) 
        $response = array('status'=>'error', 'msg'=>'Template id is missing');
      
      elseif (!empty(['id'])) {
        $template = $this->CI->Template_model->find('status',array('id' => $params['id']));
        if (empty($template))
          $response =array('status'=>'error', 'msg' => 'Template does not exists. Please check template ID');
      }
      return $response;
    }

    private function array_append($source, $data) {
      foreach($data as $key => $value) {
        $source[$key] = $value;
      }
      return $source;
    }
  }