<?php
  require_once('application/vendor/autoload.php');
  class Library_email {
  protected $CI;

  public function __construct() {
    $this->CI =& get_instance();
    $this->CI->load->model(array('communications/configuration_model',
                                'communications/Template_model',
                                'communications/Email_log_model',
                                'communications/Bounced_email_model',
                                'communications/Unsubscribe_model',
                                'users/user_model'));
    $config  =   $this->CI->configuration_model->get();
    $this->config =$config[0];
  }

	public function send($template, $input, $mail_via='api', $send_dummy_mail=false, $cron=false,
                       $is_attachment =false){

    if (empty($this->config))
      return array('status' => 'error', 'msg' => 'Please Set up Email Configurations');

		if (empty($template)) 
			return array('status' => 'error', 'msg' => 'No template available. Check template id.');
    
    $config = $this->config;
    $email_cc = $config['cc'];
    $email_bcc = $config['bcc'];
    if($send_dummy_mail == true)
      $email_data = $input;
    else
      $email_data = $input['data'];

		$email_input = array();
    $email_input = $this->array_append($email_input,$this->CI->Template_model->render_email($template,
                                                                                            $email_data,false));
    if($is_attachment ==true){
      $email_input['attachment_url'] = $email_data['variables']['attachment_url'];
      $email_input['attachment_name'] = $email_data['variables']['attachment_name'];;
      $email_input['attachment'] =1 ;
    }
    unset($email_input['emailbody']);
    $additiona_email_ids =  $this->additiona_email_ids(array('addCC'=>$email_input['cc'],
                                                             'addBCC'=>$email_input['bcc']));
    if(ENVIRONMENT!='production'){
      if($this->config['fromemail'] =='ahmed@ascratech.com')
        $email_input['emailto'] = $this->config['fromemail'];
      else 
        $email_input['emailto'] = 'ahmed@ascratech.com';

      $additiona_email_ids    =  array();
    }

    if ($send_dummy_mail == true) {
	 	  $additiona_email_ids    =  array();
 			$email_input['emailto'] = $input['emailto']; /*send to given mail id*/
    }

    $unsubscribes =$this->CI->Unsubscribe_model->get('',array('email='=>$email_input['emailto']));
    $userStatus = $this->CI->user_model->find('status',array('email_id='=>$email_input['emailto']));
    $bounceRecordExists = $this->CI->Bounced_email_model->get('id', array('email_address='=>$email_input['emailto']));
    if(!empty($unsubscribes) 
       || $userStatus['status'] == 'Disabled' 
       || !empty($bounceRecordExists)
       || (empty($email_input['emailto']) || $email_input['emailto']=='')){
			return true;
    }

    if(empty($email_input['email_body']) || $email_input['email_body']==''){
      return true;
    }

		$email_input['additional_email_ids'] = $additiona_email_ids;
		$log_array = array( 'toemail' => $email_input['emailto'],
                        'fromemail'=>$email_input['fromemail'],
                        'fromname'=>$email_input['fromname'],
                        'subject'=>$email_input['emailsubject'],
                        'emailhash'=>$email_input['email_hash'],
                        'emailbody'=>json_encode($email_input['email_body']),
                        'additiona_email_ids'=>json_encode(@$additiona_email_ids),
                        'template_id'=>(!empty($template['id'])) ? $template['id'] : '',
                        'template_name'=>(!empty($template['name'])) ? $template['name'] : '');

    if($mail_via == 'api') {
      if(ENVIRONMENT!='production' && $cron==true){
        $result['status']="success";
        $result['sendgrid_message_id']='';
      }else{
        $result = $this->send_via_api($email_input);
      }
      $log_array['hostname'] = $this->config['hostname'];
      $log_array['username'] = $this->config['username'];
      $log_array['sendgrid_message_id'] = @$result['sendgrid_message_id'];
    }else {
      if(ENVIRONMENT!='production' && $cron==true){
        $result['status']="success";
      }else{
        $result = $this->send_via_smtp($email_input);
      }
      $log_array['hostname'] = $this->config['hostname'];
      $log_array['username'] = $this->config['username'];
    }
    if($result['status'] == 'success') {
      $log_array['status']="success";
      $sentemails = $this->CI->Template_model->find('sentemails',array('id' => $template['id']));
      $data =$sentemails['sentemails'];
      $this->CI->Template_model->update_sentemails_status($data,$template['id']);
      $r = array('status'=>'success','msg'=>'mail send to '.$email_input['emailto']);
    } else {
      $log_array['status']="error";
      $r = array('status'=>'error','msg'=>'Error in sending Email');
    }
    $log_array['created_at']=date('Y-m-d H:i:s');
		$this->CI->Email_log_model->save($log_array);
		return $r;
	}
          
	private function send_via_api($data) {
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom($data['fromemail'], $data['fromname']);
		$email->setSubject($data['emailsubject']);
		$email->addTo($data['emailto']);
		$email->addContent("text/html", $data['email_body']);
		$sendgrid = new \SendGrid($this->config['sengrid_api_key']);
          
		$cc = array();
		$bcc = array();
    
    if(isset($data['attachment']) && $data['attachment'] ==1){
      $attachment = $data['attachment_url'];
      $content    = file_get_contents($attachment);
      $content    = base64_encode($content);

      $attachment = new SendGrid\Mail\Attachment();
      $attachment->setContent($content);
      $attachment->setType("application/pdf");
      $attachment->setFilename($data['attachment_name']);
      $attachment->setDisposition("attachment");
      $email->addAttachment($attachment);
    }

    foreach ((array)$data['additional_email_ids'] as $email_id => $email_type) {
			if($email_type == 'addCC')
				$cc[$email_id] = $email_id;
			else 
				$bcc[$email_id] = $email_id;
    }

		if(!empty($cc))
			$email->addCcs($cc);
		if(!empty($bcc))
			$email->addBccs($bcc);
		
		$log = array();
		try {
			$response = $sendgrid->send($email);
			if($response->statusCode() == 202) {
				$res_headers = $response->headers();
				$example = array('An example','Another example','Last example');
				$searchword = 'X-Message-Id';
				$matches = array_filter($res_headers, function($var) use ($searchword) {
					return preg_match("/\b$searchword\b/i", $var); 
				});
				$log['status']="success";
				$log['sendgrid_message_id']=str_replace('X-Message-Id: ','',$matches[key($matches)]);
			}
			else{
				$log['status']="error";
				$response_body = $response->body();
			}
		} catch (Exception $e) {
			//echo 'Caught exception: '. $e->getMessage() ."\n";
		}
		return $log;
  }

  public function send_via_smtp($data) {
    $mail = new PHPMailer;
    $mail->ClearAddresses();
    $mail->ClearAttachments();
    $mail->isSMTP();
    $mail->Host         =   $this->config['hostname'];
    $mail->SMTPAuth     =   true;
    $mail->Username     =   $this->config['username'];
    $mail->Password     =   $this->config['password'];
    $mail->SMTPSecure   =   $this->config['smtpsecure'];
    $mail->Port         =   $this->config['port'];
    $mail->From         =   $this->config['fromemail'];
    $mail->FromName     =   $this->config['fromname'];
    $mail->addAddress($data['email_to']);
    $mail->IsHTML(true); 
    $mail->Subject      =   $data['subject'];
    $mail->Body         =   $data['email_body'];
    if(isset($data['attachment']) && $data['attachment'] ==1){
    $mail->AddAttachment($data['attachment_url'],$data['attachment_name']);
    }
    foreach ((array)$data['additional_email_ids'] as $email_id => $email_type) {
        $mail->$email_type($email_id);/*addCC,addBCC*/
    } 

    if($mail->send()){
	     $log_array['status'] = "success";
    } else {
      $log_array['status'] = "error";
      $log_array['status'] = $mail->ErrorInfo;
    }
    return $log_array;
  }

  private function additiona_email_ids($email_ids=array()) {
    $response =array();
    foreach ($email_ids as $type => $value) {
      foreach (explode(',', $value) as $email_id) {
        if (!empty($email_id)) {
          $response[$email_id]=$type;
        }
      }
    }
    return array_filter($response);
  }
  
  private function array_append($source, $data) {
    foreach($data as $key => $value) {
      $source[$key] = $value;
    }
    return $source;
  }

}
