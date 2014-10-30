<html>
<body>
<?php
$username="courier";
$password="##############";
$database="courier";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

//send mail script
function sendmail($to,$subject,$message,$premessage)
{
	$message=$premessage."\n".$message."\n";
	$headers = 'From: "Courier" < courier@students.iiit.ac.in >' . "\r\n" .
		'Reply-To: courier@students.iiit.ac.in' . "\r\n" .
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

// This function receives the details of the mail and invokes sendmail function
function courierInfo($to,$address,$name,$roll,$courid,$date){
//	$to="nitesh.surtani0606@gmail.com";
	echo $to;
	$subject="Courier From ".$address;
	$premessage="Dear ".$name.",\r\n";
	$message="You have received a courier from ".$address."  on ".$date." with courier id : ".$courid.". Kindly collect it from the security";
	$msg=$premessage."\n".$message."\n";
//	sendmail($to,$subject,$message,$premessage);
	system("python send_mail.py $to '$msg'");

}
function checkAlternate($roll){
	$query = "select otheremail from Student where roll_no='$roll'";
	$result=mysql_query($query) or die ( "not selected\n");
	$row = mysql_fetch_array($result);
	$mailid=$row['otheremail'];
	if(strlen($mailid)>4){
		return $mailid;
	}
	return "";
}

// Error Handling
/*
   ERR1 = Roll No is not Correct
   ERR2 = Mail Has Been Sent
   ERR3 = Courier Information has been updated
   ERR4 = Courier Id does not exist
   ERR5 = Address not given
   ERR6 = Courier Id not found
   ERR7 = Room Number not specified
   ERR8 = No Student specified for this room no.
   ERR9 = Please enter Student Name
 */
// Left: Checking whether the alternate id is valid email id or not.


$update=$_POST['update']; // For updating whether student has taken the courier or not
$change=$_POST['change']; // Whether the screen was switched or not
$roll1=$_POST['roll1']; // receives the roll_no when screen is switched
$name1=$_POST['name1']; // receives the entered name when the screen is switched
if($name1=="" and $change==1){
	header("Location:security.php?err=9");
}
else if($name1=="" and $change==0){
	$match=1;
}
else if($name!=""){
	$match=0;
}
//echo $change." ".$name1." ".$roll1."\n";
//echo $match;
//$to="nitesh.surtani0606@gmail.com";  // Just for testing
$nameroll=$_POST['name']; // receives the roll_no when the screen is not switched
$Room=$_POST['room_no'];
$hostel=$_POST['hostel'];
$type=$_POST['type'];
$date=$_POST['testinput3'];
$address=$_POST['address'];
$sent=0;  // To update the couier details if no information is given
if(strlen($Room)==0 and $update==0){
	header("Location:security.php?err=7");
}
else if(strlen($address)==0 and $update==0){
	header("Location:security.php?err=5");
}
else{
	$cid=$_POST['cid'];
	$room=$hostel."-".$Room;
	$q1="select * from Courier_Info";
	$r1=mysql_query($q1) or die("can't fetch data");
	$num=mysql_num_rows($r1);
	$cour_id=$num+1;
	//echo "C=".$change." roll1=".$roll1." name1=".$name1." room=".$Room." Cour_id=".$cour_id." nameroll=".$nameroll;
	if($update==1){
		$taken=$_POST['taken'];
		$sel = "update Courier_Info set taken='$taken' where courier_id='$cid'";
		$resu=mysql_query($sel) or die("can't find user");
		header( "Location: security.php?err=3" ) ;
		$sent=1;
	}
	else if($update==0){
		if($change=="1"){
			$fl=0;  // If roll no has been set but it is wrong, then send mail to the name. 
			if($roll1!="0"){  // When the security has entered the roll number of the receiver
				$sel = "select * from Student where roll_no='$roll1'";
				$resu=mysql_query($sel) or die("can't find user");
				$n=mysql_num_rows($resu);
				if($n==0){
				//	header( "Location: security.php?err=1" ) ;
					$fl=1;
					//no such roll no exist(display error)
				}
				else{
					$sel = "select * from Student where roll_no='$roll1'";
					$resu=mysql_query($sel) or die("can't find user");
					$row=mysql_fetch_array($resu);
					$name1=$row['name'];
					$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',0,'$roll1')";
					mysql_query($query) or die ( "not inserted\n");
					$to=$row['username'];
					courierInfo($to,$address,$name1,$roll1,$cour_id,$date);
					$alter=checkAlternate($roll1);
					if($alter!=""){
						courierInfo($alter,$address,$name1,$roll1,$cour_id,$date);
					}
					header( "Location: security.php?err=2" ) ;
					$sent=1;
					//send mail to this roll no.
				}
			}
			else if($roll1=="0" or $fl==1){  // If the roll number of the student is not known and the name also doesn't matches, then security sends the mail to room number and overlap becomes 1.
				$que="select * from Student where name='$name1'";
				$rst=mysql_query($que) or die("can't find user");
				$num=mysql_num_rows($rst);
				if($num==0){
					$quer="select * from Student where room_no='$room'";
					$res=mysql_query($quer) or die("can't find user");
					$n=mysql_num_rows($res);
					if($n==0){
						header( "Location: security.php?err=8" ) ;
						//no such roll no exist(display error)
					}
					else{
						while($row = mysql_fetch_array($res)){
							$rollno=$row['roll_no'];
							//send mail to this roll no
							$to=$row['username'];
							courierInfo($to,$address,$name1,$rollno,$cour_id,$date);	
							$alter=checkAlternate($rollno);
							if($alter!=""){
								courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
							}
						}
						$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',1,'$match')";
						mysql_query($query) or die ( "not inserted\n");
						header( "Location: security.php?err=2" ) ;
						$sent=1;
					}
				}


				else {
					$final=$rst;
					$final2=$rst;
					if($num==1){  //No overlap
						$row=mysql_fetch_array($rst);
						$rollno=$row['roll_no'];
						$to=$row['username'];
						$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',0,'$rollno')";
						mysql_query($query) or die ( "not inserted\n");

						courierInfo($to,$address,$name1,$rollno,$cour_id,$date);	
						$alter=checkAlternate($rollno);
						if($alter!=""){
							courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
						}
						header( "Location: security.php?err=2" ) ;
						$sent=1;
						//send mail to the person with his roll no $roll
					}
					else if($num>1){
						$flag=0;
						$rollno="";
						while($row = mysql_fetch_array($final)){
							$room_no=$row['room_no'];
							if($room==$room_no){
								$flag=1;
								$rollno=$row['roll_no'];
								$to=$row['username'];
								courierInfo($to,$address,$name1,$rollno,$cour_id,$date);	
								$alter=checkAlternate($rollno);
								if($alter!=""){
									courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
								}
								//send mail to the person with his roll no $roll
							}
						}
						if($flag==1){ // There are multiple students with same name but room number matches to one, so courier is send to only that person
							//	header( "Location: security.php?err=2" ) ;
							$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',0,$rollno)";
							mysql_query($query) or die ( "not inserted\n");
							$sent=1;
						}
						else if($flag==0){ // Room number doesn't matches with any student, so mail is sent to all of students with that name
							$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',1,'$match')";
							mysql_query($query) or die ( "not inserted\n");

							//send mails to all the roll no.s in the array final
							while($row = mysql_fetch_array($final2)){
								$rollno=$row['roll_no'];
								$to=$row['username'];
								courierInfo($to,$address,$name1,$rollno,$cour_id,$date);	
								$alter=checkAlternate($rollno);
								if($alter!=""){
									courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
								}
							}
							header( "Location: security.php?err=2" ) ;
							$sent=1;
						}
					}
				}
			/*	
				$quer="select * from Student where room_no='$room'";
				$res=mysql_query($quer) or die("can't find user");
				$n=mysql_num_rows($res);
				if($n==0){
					header( "Location: security.php?err=8" ) ;
					//no such roll no exist(display error)
				}
				else{
					while($row = mysql_fetch_array($res)){
						$rollno=$row['roll_no'];
						//send mail to this roll no
						courierInfo($to,$address,$name1,$rollno,$cour_id,$date);	
						$alter=checkAlternate($rollno);
						courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
					}
					$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',1,$match)";
					mysql_query($query) or die ( "not inserted\n");
					header( "Location: security.php?err=2" ) ;
				}
				*/
			}
		}
		else if($change==0){ // If security finds the students from the drop-down
			$qu="select * from Student where roll_no=$nameroll";
			$re=mysql_query($qu) or die("can'tt find user");
			$rw=mysql_fetch_array($re);
			$name=$rw['name'];
			$roll=$nameroll;
			echo "nameroll = ".$nameroll,"name= ".$name;
			$q = "select * from Student where name='$name'";
			$result=mysql_query($q) or die("can't find user");
			$final=$result;
			$final2=$result;
			$num=mysql_num_rows($result);
			if($num==1){  //No overlap
				$q = "select * from Student where name='$name'";
				$result=mysql_query($q) or die("can't find user");
				$row=mysql_fetch_array($result);
				$rollno=$row['roll_no'];
				$to=$row['username'];
				$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name','$date','$address',0,'$room',0,'$rollno')";
				mysql_query($query) or die ( "not inserted\n");

				courierInfo($to,$address,$name,$rollno,$cour_id,$date);	
				$alter=checkAlternate($rollno);
				if($alter!=""){
					courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
				}
				header( "Location: security.php?err=2" ) ;
				$sent=1;
				//send mail to the person with his roll no $roll
			}
			else if($num>1){
				$flag=0;
				$rollno="";
				while($row = mysql_fetch_array($final)){
					$room_no=$row['room_no'];
					if($room==$room_no){
						$flag=1;
						$rollno=$row['roll_no'];
						$to=$row['username'];
						courierInfo($to,$address,$name,$rollno,$cour_id,$date);	
						$alter=checkAlternate($rollno);
						if($alter!=""){
							courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
						}
						//send mail to the person with his roll no $roll
					}
				}
				if($flag==1){ // There are multiple students with same name but room number matches to one, so courier is send to only that person
				//	header( "Location: security.php?err=2" ) ;
					$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name','$date','$address',0,'$room',0,'$rollno')";
					mysql_query($query) or die ( "not inserted\n");
					$sent=1;
				}
				else if($flag==0){ // Room number doesn't matches with any student, so mail is sent to all of students with that name
					$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name','$date','$address',0,'$room',1,'$match')";
					mysql_query($query) or die ( "not inserted\n");

					//send mails to all the roll no.s in the array final
					while($row = mysql_fetch_array($final2)){
						$rollno=$row['roll_no'];
						$to=$row['username'];
						courierInfo($to,$address,$name,$rollno,$cour_id,$date);	
						$alter=checkAlternate($rollno);
						if($alter!=""){
							courierInfo($alter,$address,$name1,$rollno,$cour_id,$date);
						}
					}
					header( "Location: security.php?err=2" ) ;
					$sent=1;
				}
			}
		}
	}
	if($sent==0){
		$query = "INSERT INTO Courier_Info VALUES ('$cour_id','$type','$name1','$date','$address',0,'$room',1,'1')";
		mysql_query($query) or die ( "not inserted\n");
		header( "Location: security.php?err=10" ) ;
	}
}

mysql_close();
?>
</body>
</html>
