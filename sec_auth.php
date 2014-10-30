<?
session_start();  
$username="courier";
$password="#############";
$database="courier";


mysql_connect(localhost,$username,$password) or die("can't connect");
@mysql_select_db($database) or die( "Unable to select database");
$name=$_POST['user'];
$pass=$_POST['pass'];
echo $name,$pass;
if($name=="admin"){
	$query="select * from information where username='admin'";
	$result=mysql_query($query) or die("cannot find password");
	$row = mysql_fetch_array($result);
	$password=$row['password'];
	if($pass!=$password){
		header( "Location:main1.php?err=1" ) ;
	}
	/*else{
		$q1="update information set logged=1 where username='admin'";
		mysql_query($q1);
		$_SESSION['path'] = 1;
		header( "Location:http://localhost/portal/admin.php" ) ;
	}*/
	else{
		$_SESSION['logged1']=1;
	header( "Location:admin.php" ) ;
	}
}
else if($name=="security"){
	$query="select * from information where username='security'";
	$result=mysql_query($query) or die("cannot find password");
	$row = mysql_fetch_array($result);
	$password=$row['password'];
	echo $password;
	if($pass!=$password){
		header( "Location:main1.php?err=1" ) ;
	}
	else{
		$_SESSION['logged2']=1;
/*
		$q1="update information set logged=1 where username='security'";
		mysql_query($q1) or die("can't log in");
		$_SESSION['path'] = 1;
		header( "Location:http://localhost/portal/security.php" ) ;
	*/
		header( "Location:security.php" ) ;
	}
}
else{
header("Location:main1.php?err=2");
}

mysql_close();

//$query="select * from information where roll_no='200831006'";
//$result=mysql_query($query) or die("cannot find password");
/*
   $row_count = mysql_num_rows ($resuyylt);
   echo $row_count;
   $row = mysql_fetch_array($result);
   echo $row['password'];
 */
/*
 */

?>
