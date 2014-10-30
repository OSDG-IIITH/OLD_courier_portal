<?php

$username="courier";
$password="################";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");

$result=mysql_query("select * from Student where roll_no LIKE '20083%'");
while($row = mysql_fetch_array($result)){
	$arr=split("@",$row['username']);
	if($arr[0][strlen($arr[0])-1]!="8"){
		$roll=$row['roll_no'];
		echo "OLD USER      : ".$roll."    ".$row['username']."\n";
		$user=$arr[0]."ug08@".$arr[1];
		echo "NEW USER      : ".$user."\n";
		$query="update Student set username='$user' where roll_no='$roll'";
		echo $query;
		mysql_query($query);
	}

}
?>
