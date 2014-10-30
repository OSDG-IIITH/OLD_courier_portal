<?
function sendmail($to,$subject,$message,$premessage)
{

$postmessage="Regards\r\nAnonymous\n\n";
$postmessage.="\r\n\r\n For any queries you can contact anonymous@gmail.com ";
$message=$premessage."\n".$message."\n".$postmessage;

//define the subject of the email
//define the message to be sent. Each line should be separated with \n
//define the headers we want passed. Note that they are separated with \r\n
//$headers = "From: sinhaakash@alumnicell.ac.in\r\nReply-To: webmaster@example.com";
$headers = 'From: "Vennela Miriyala" < moonlightias@gmail.com >' . "\r\n" .
    'Reply-To: moonlightias@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//send the email

if($mail_sent = @mail( $to, $subject, $message, $headers ))
{
	echo "Sent\n";
	return true;
}
else
{
	echo "Not Sent\n";
	return false;
}

}

// Do file read here and take all emails into a variable seperated by comma as you can see below

$to="srikanth.143.iiit@gmail.com";
$subject="Test mail";
$premessage="Hi\r\n";
$message=" \r\n";

sendmail($to,$subject,$message,$premessage);

?>
