<?php
date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

$full_name = $_POST['full_name'];
$radio_input = $_POST['request_summary'];
$request_date = $_POST['request_date'];

if(isset($_POST["choose_cat"]) ) {
  $choose_cat = $_POST["choose_cat"];
}

switch ($choose_cat) {
   case 'reseller':
       // echo "Requested Category: Service Provider";
       // echo "<br>";
        break;
   case 'customer':
       // echo "Requested Category: Customer";
       // echo "<br>";
        break;
    case 'user':
      // echo "Requested Category: User";
      // echo "<br>";
        break;
    case 'sales':
      //echo "Requested Category: Sales";
     // echo "<br>";
        break;
    case 'marketing':
      // echo "Requested Category: Marketing";
      // echo "<br>";
        break;
     case 'support':
     // echo "Requested Category: Support";
     // echo "<br>";
        break;
      case 'extensions':
      // echo "Requested Category: Extensions";;
     // echo "<br>";
        break;
      case 'infrastructure':
       // echo "Requested Category: Infrastructure";
       // echo  "<br>";
        break;
}

if(isset($_POST["choose_type"]) ) {
  $choose_type = $_POST["choose_type"];
}

switch ($choose_type) {
   case 'report':
       // echo "Requested Report Type: Report";
       // echo "<br>";
        break;
   case 'dashboard':
       // echo "Requested Report Type: Dashboard";
       // echo "<br>";
        break;
    case 'rawData':
      // echo "Requested Report Type: Raw Data";
      // echo "<br>";  
        break;
   
}

if (isset($_POST['submit'])) {
  
  $selected_radio = $_POST['priority'];

  if ($selected_radio=='high') {
    $high_priority = 'checked';
    //echo "High priority: ".$high_priority;
  }
  else if ($selected_radio=='moderate') {
    $moderate_priority = 'checked';
    //echo "Moderate priority: ".$moderate_priority;
  }
  else if ($selected_radio=='low') {
    $low_priority = 'checked';
    //echo "Low priority: ".$low_priority;
  }
}


if (isset($full_name) && is_string($full_name)) {

$body =  '<hr><h2>New Data Request</h2><br /><strong>User: </strong>'.$full_name.'<br />'.
         '<hr><h4>Request Is As Follows: </h4><br />'.$radio_input.'<br />'.
         '<hr><h4>Type: </h4><br />'.$choose_type.'<br />'.
         '<hr><h4>Category: </h4><br />'.$choose_cat.'<br />'.
         '<hr><h4>Priority: </h4><br />'.$selected_radio.'<br />'.
         '<hr><h4>Request Date By: </h4><br />'.$request_date.'<br />'.


         '<h4><br />This Email Was Sent By The Gods.... Please do not fret...</h4>'.
         '<img src="http://wallbot.net/walls/preview/4240.jpg" alt="Smiley face" width="750" height="350"><hr>';

}

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Port = 465; //587
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

$mail->Host = 'smtp.gmail.com';

$mail->SMTPSecure = 'ssl'; // tls
$mail->SMTPAuth = true;

$mail->Username = "mmarshall@coredial.com";
$mail->Password = "asBloodRunsBlack874824";

$mail->setFrom('mmarshall@coredial.com', 'Data Request');
$mail->addReplyTo('mmarshall@coredial.com', 'Data Request');
$mail->addAddress('mmarshall@coredial.com', 'Data Request');
$mail->Subject = 'Data Request';

// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->msgHTML($body);
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  #  header('Location: http://localhost/coredial/dataservice/portal/');
     header('Location: ../../index.php');
}


?>
