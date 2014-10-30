<?
function sendmail($to,$subject,$message,$premessage)
{

$postmessage="Regards\r\nAlumni Cell\nInternational Institute of Information Technology - Hyderabad\nAP,India.\r\nhttp://alumni.iiit.ac.in\n";
$postmessage.="\r\n\r\n For any queries you can contact alumnicell@students.iiit.ac.in ";
$message=$premessage."\n".$message."\n".$postmessage;

//define the subject of the email
//define the message to be sent. Each line should be separated with \n
//define the headers we want passed. Note that they are separated with \r\n
//$headers = "From: sinhaakash@alumnicell.ac.in\r\nReply-To: webmaster@example.com";
$headers = 'From: "IIIT-H Alumni Cell" < alumnicell@students.iiit.ac.in >' . "\r\n" .
    'Reply-To: alumnicell@students.iiit.ac.in' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//send the email

if($mail_sent = @mail( $to, $subject, $message, $headers ))
{
echo "Sent";
return true;
}
else
{
echo "Not Sent";
return false;
}

}

$to="nitesh.surtani0606@gmail.com";
$subject="New Account Registration at Alumni Association of IIIT Hyderabad";
$premessage="Dear Akash,\r\n";
$message="Thank you  for joining the growing network of IIIT Hyderabad Alumni Association.\r\nYour account will soon be activated after reviewing your provided credentials .\r\n";

sendmail($to,$subject,$message,$premessage);


?>
