<?php
/*********************************************************************************************
*
* A simple Mailer module.
* This script isn't complete.
*
* For better use, you can add other validate & filter clauses
* Either your improve your website ergonomy yourself, just the regular way, or you can
* just integrate this script
*
* file : display.php
* @author Med Amine Ben Asker [YuriLz]- mail : ben[dot]asker[dot]amine[at]gmail[dot]com
*
**********************************************************************************************/
 function email_valid($email)
{
	if (strlen($email) > 50)
		return false;

	return preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $email);
}

function send_email($to, $arg, &$messages){

 //$status = mail($to, $arg['subject'], $arg['message'], $arg['header']);
 $status = rand(1,9)%2;
 $messages[] = ($status) ? "[ S ] Message sent successfully to " . $to . "\n"
                         : "[ E ] Message could not be sent to " . $to . "\n";
}

function validate_adresses($adresses){

$result = preg_replace('/\r\n/', '', $adresses);
$result = preg_replace('/\s+/', ' ', $result);

$result =  explode(' ', $result);
 foreach ($result as $key => $value) {
   if (! email_valid($value))
    unset($key); 
 }
 return $result;
}


$adresses = ( isset($_POST['to'] ) )? $_POST['to'] : NULL ; 
$from     = ( isset($_POST['from'] ) )? $_POST['from'] : NULL ; 
$message  = ( isset($_POST['message'] ) )? $_POST['message'] : NULL ; 
$subject  = ( isset($_POST['subject'] ) )? $_POST['subject'] : NULL ; 



$adresses = validate_adresses($adresses);
if ( ! empty( $adresses ) )
{
  $logmsgs = array();
  $content = array('subject' => $_POST['subject'],
                   'message' => $_POST['message'],
                   'header' => "From:".$_POST['from']." \r\n",
                   );

foreach($adresses as $key => $to)
  send_email($to, $content, $logmsgs);

		
 // Save traffic in a JSON file  
$contentToJSON = array("to" =>  implode(";",$adresses),
                   "subject" => $subject,
                      "from" => $from,
                   "message" => $message,
                       "log" => implode(";", $logmsgs)
                       );
				
$tojson = json_encode($contentToJSON);
file_put_contents("logs/js"
                          .md5($contentToJSON['message'])
                          ."_"
                          .time()
                          .".json",
                  $tojson);

} 
?>
