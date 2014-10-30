<?php
$username="courier";
$password="##############";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");
$query="select * from Student where roll_no='200802026'";
$res=mysql_query($query);

while($row=mysql_fetch_array($res)){
	echo $row['name'];
}
?>
