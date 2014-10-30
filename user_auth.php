<?
session_start();  
$username="courier";
$password="############";
$database="courier";
mysql_connect(localhost,$username,$password) or die("can't connect");
@mysql_select_db($database) or die( "Unable to select database");
$name=$_POST['user'];

$query="select * from Student where username='$name'";
$result=mysql_query($query) or die("cannot find password");
$row = mysql_fetch_array($result);
$roll=$row['roll_no'];
$_SESSION['student']=$roll;
header( "Location:index.php?prof=1&auth=1" ) ;
mysql_close();
?>
