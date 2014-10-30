<?
function sendmail($to,$subject,$message,$premessage)
{

$headers = 'From: "Courier" < courier@students.iiit.ac.in >' . "\r\n" .
    'Reply-To: courier@students.iiit.ac.in' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//send the email

if($mail_sent = @mail( $to, $subject, $message, $headers ))
{
echo "Sent\n";
return true;
}
else
{
echo "Not Sent";
return false;
}

}

$to="ronanki@students.iiit.ac.in";
$subject="Re: IPL Match Tickets";
$premessage="Hey,\r\n";
$message="My Goa trip got cancelled just now :( \r\n Manager gave some work to my fellow-mates. So, we cancelled our tickets. Now, we can go to IPL match tomorrow. What do you say ?? \r\n";

sendmail($to,$subject,$message,$premessage);


?>
