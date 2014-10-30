<?
$username="courier";
$password="#############";
$database="courier";

$name=$_POST['name'];
$roll=$_POST['roll'];
$room=$_POST['room_no'];
$email=$_POST['id'];
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="insert into Student values('$roll','$name','$email','$room','','')";
$result=mysql_query($query) or die("cannot add user");
header( "Location: admin.php?err=1");
mysql_close();
?>
