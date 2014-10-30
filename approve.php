<?php
$username="courier";
$password="##############";
$database="courier";
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$user=$_POST['emailid'];
$roll=$_POST['addroll'];


$query="update Student set username='$user' where roll_no='$roll'";
echo $query;
$result=mysql_query($query) or die("cannot add user");
//echo $roll;
//$_SESSION['useris']=$user;
header("Location:index.php?logout");
mysql_close();

?>
