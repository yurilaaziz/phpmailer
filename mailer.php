<?php
 function email_valid($email)
{
	if (strlen($email) > 50)
		return false;

	return preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $email);
}

   
   $action = isset($_POST['to'])
				AND isset($_POST['from'])
				AND isset($_POST['message'])
				AND isset($_POST['subject']); 
   
   

	/**
	*	INITIALISATION
	*/
			$errorMessage = "";
			$succMessage  = "";


			if ($action)
		{
	
    $mails = explode(';', $_POST['to']);
    $subject = $_POST['subject'];
    $message = $_POST['message'];
	$header = "From:".$_POST['from']." \r\n";
	
	   foreach($mails as $to){
		if (email_valid($to)){
		//$resp = mail($to,$subject,$message,$header);
		$resp = true;
	
			if( $resp)  
			$succMessage.="Message sent successfully to ".$to."\n";
			else
			$errorMessage.= "Message could not be sent to ".$to."\n";
		}
		else
		$errorMessage.= $to." isn't a valid adress mail \n";
		}
		
	// JSON out put 
	
	
	$contentToJSON = array("to" => $mails,
					  "subject" => $subject,
				         "from" => $_POST['from'],
				      "message" => $message,
				          "log" => $succMessage.$errorMessage);
				
	$tojson = json_encode($contentToJSON);
	
	file_put_contents("logs/js".
							md5($contentToJSON['message']).
							"_".
							time().
							".json"
						,
					  $tojson);

	
	
   } // end action 
?>