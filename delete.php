<?
$username="courier";
$password="##############";
$database="courier";

//get the roll no from name+roll_no
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$name=$_POST['name'];
$roll=$_POST['rollno'];
$query1="select * from Student where roll_no='$roll'";
$result1=mysql_query($query1);
$num=mysql_num_rows($result1);
if($num==1){
	$query="delete from Student where roll_no='$roll'";
	$result=mysql_query($query) or die("cannot delete user");
	header( "Location: admin.php?err=2");
}
else{
	header( "Location: admin.php?err=3");
}
mysql_close();
?>
