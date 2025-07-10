
<?php
    // Account details
  $apiKey = urlencode('CcXWXK5zxzo-DHXQGcaux72FfittoIrvQFfWkmiwpU');

  // Message details
  $numbers = array(919892680959);
  $sender = urlencode('DKTHCR');
  $message = 'this is a test message';
  $numbers = implode(',', $numbers);

  // Prepare data for POST request
  $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
  
  // Send the POST request with cURL
  $ch = curl_init('https://api.textlocal.in/send/');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  echo $response;
  curl_close($ch);
?>

<?php

// $DBUSER="user";
// $DBPASSWD="password";
// $DATABASE="accounts_development";

// $filename = "backup-" . date("d-m-Y") . ".sql.gz";
// $mime = "application/x-gzip";

// header( "Content-Type: " . $mime );
// header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

// $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip  --result-file={$filename}";   

// passthru( $cmd );

// exit(0);
?>