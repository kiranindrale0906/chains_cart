<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_into_library_communication_configurations extends CI_Model {

  public function up()
  {
  	$sql = "INSERT INTO `library_communication_configurations` (`id`, `hostname`, `username`, `password`, `smtpsecure`, `port`, `fromemail`, `fromname`, `cc`, `bcc`, `created_at`, `updated_at`, `pushtoken`, `smsusername`, `smspassword`, `smsapiurl`, `twilio_sid`, `twilio_auth_token`, `twilio_phone_number`, `twilio_twiml_bin_url`, `sengrid_api_key`, `is_delete`) VALUES
(1, 'smtp.sendgrid.net', 'ascratech1', 'Ascratech1', 'tls', 587, 'info@e.automateamerica.com', 'coremvc', '', '', '2018-10-26 01:54:54', '2019-11-05 17:35:41', 'AIzaSyAsXCv2Cu0XNWXxtTn4YBgWuYWiLvjx4VI', 'atul@ascratech.com', 'Ascra123456789', 'https://api.bulksms.com/v1/messages', 'AC3eac3be2422bceba52a88e6a5c3ef0b6', '88ee6b2676dbe71ee7094e3052c8d417', '+19152282003', 'https://handler.twilio.com/twiml/EH4f7fbd205cc3fc18856095fcc0e306c3', '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', 0);";

  $this->db->query($sql);
  }
}

?>