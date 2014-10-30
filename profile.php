<?php
session_start();

$username="courier";
$password="#############";
$database="courier";

$name=$_POST['name'];
$roll=$_POST['roll'];
$id=$_POST['id'];
$hostel=$_POST['hostel'];
$room=$_POST['room_no'];
$phone=$_POST['phone'];
$_SESSION['student']=$roll;
$otherid=$_POST['otherid'];

if(!is_numeric($room)){
	header( "Location:index.php?msg=2" ) ; 
}
else if(strlen($name)==0){
	header( "Location:index.php?msg=5" ) ; 
}
else if((!is_numeric($phone) or strlen($phone)!=10) and strlen($phone)!=0){
	header( "Location:index.php?msg=3" ) ; 
}
else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $otherid) and $otherid!=""){
	header( "Location:index.php?msg=4" ) ; 
}
else{
	$user=$_POST['user'];
	/*
	   $pass=$_POST['pass'];
	   $npass=$_POST['npass'];
	   $rnpass=$_POST['rnpass'];
	 */
	$Room=$hostel."-".$room;
	mysql_connect(localhost,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	mysql_query("UPDATE Student SET room_no = '$Room' WHERE roll_no='$roll'") or die("not updated");
	mysql_query("UPDATE Student SET phone = '$phone' WHERE roll_no='$roll'") or die("not updated");
	mysql_query("UPDATE Student SET name = '$name' WHERE roll_no='$roll'") or die("not updated");
	mysql_query("UPDATE Student SET otheremail = '$otherid' WHERE roll_no='$roll'") or die("not updated");

	/*
	   if(strlen($pass)>0){
	   $result=mysql_query("SELECT * from information where roll_no=$roll");
	   $row = mysql_fetch_array($result); 
	   $password=$row['password'];
	   if($pass!=$password){
	   header( "Location: http://localhost/portal/change_prof.php?roll=$roll&msg=2" ) ; //Password entered is wrong
	   }
	   else if($npass!=$rnpass){
	   header( "Location: http://localhost/portal/change_prof.php?roll=$roll&msg=3" ) ; //Passwords do not match
	   }
	   else if(strlen($npass)<6){
	   header( "Location: http://localhost/portal/change_prof.php?roll=$roll&msg=5" ) ; //Passwords too short
	   }
	   else{
	   mysql_query("UPDATE information SET password = '$npass' WHERE roll_no='$roll'") or die("password not updated");
	   header( "Location: http://localhost/portal/change_prof.php?roll='$roll'&msg=4" ) ;
	   }
	   }
	   else{
	   header( "Location: http://localhost/portal/change_prof.php?roll=$roll&msg=1" ) ;
	   }
	 */
	//	header( "Location: http://localhost/scratch/portal/student.php?roll=$roll&msg=1" ) ;
	header( "Location: index.php?msg=1" ) ;
}
mysql_close();
?>

