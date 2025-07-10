<?php
class Email_logs extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('email_log_model',
                             'template_model',
                             'bounced_email_model',
                             'unsubscribe_model','configuration_model'));
     $config  =   $this->configuration_model->get();
      $this->config =$config[0];
  }
  public function view($id) {
    $data = $this->email_log_model->find('emailbody', array('id'=>$id));
    echo json_decode($data['emailbody']);
  }

  public function update($id='') {
    $sendgridResponse = json_decode(file_get_contents('php://input'), TRUE);
   // log_event($sendgridResponse);
    if(empty($sendgridResponse)) return;
  
    foreach($sendgridResponse as $event) {
      list($msg_id) = explode('.', $event['sg_message_id']);
      $email_log = array();
      switch($event['event']) {
        case 'delivered':
          $email_log = array('delivered_at' => date('Y-m-d H:i:s', $event['timestamp']));
          break;
        case 'open':
          $email_log = array('opened_at' => date('Y-m-d H:i:s', $event['timestamp']), 'openemail' => 1);
          break;
        case 'click':
          $email_log = array('clicked_at' => date('Y-m-d H:i:s', $event['timestamp']));
          break;
        case 'processed':
          break;
        case 'dropped':
          break;
        case 'deferred':
          break;
        case 'bounce':
          $email_log = array('bounced_at' => date('Y-m-d H:i:s', $event['timestamp']));
          $bounced_emails = $this->bounced_email_model->get('id', array('email_address="'.$event['email'].'"'));
          $record = array('id' => @$bounced_emails[0]['id'], 'email_address' => $event['email']);
          $this->bounced_email_model->save($record);
          break;
        case 'unsubscribe':
          $email_log = array('unsubscribe_at' => date('Y-m-d H:i:s', $event['timestamp']));
          $unsubscribes = $this->unsubscribe_model->get('id', array('email="'.$event['email'].'"'));
          $record = array('id' => $unsubscribes[0]['id'], 'email' => $event['email']);
          $this->unsubscribe_model->save($record);
          break;
        default : 
          break;
      }

      if (isset($event['event']) && !empty($event['event'])) {
        $email_log['sendgrid_status'] = $event['event'];
        $this->email_log_model->update($email_log, false, array('toemail="'.$event['email'].'"', 
                                                                'sendgrid_message_id="'.$msg_id.'"'));
      }
    }
  
  }
}
