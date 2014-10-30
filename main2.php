<?php

$username="courier";
$password="###############";
$database="courier";
mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database\n");
/*
session_start();
$error=$_GET['err'];
$logout=$_GET['lo'];
$roll=$_GET['roll'];
if($logout==1){
	$query="update information set logged=0 where roll_no='$roll'";
}
else if($logout==2){
	$query="update information set logged=0 where username='admin'";
}
else if($logout==3){
	$query="update information set logged=0 where username='security'";
}
mysql_query($query);
*/
?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>IIIT Courier Portal</title>	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<LINK REL=stylesheet href="style.css" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_db.js"></script>
<link rel="stylesheet" href="tigra_calendar/calendar.css">
<script type="text/javascript">
/*
function check1(){
	<?php $_SESSION['rollno']=3;?>
	return true;
}
*/
</script>
</head>
<body>
<center>
<div id="main">
<div id="header">
<center><h3 id="courier1"><b>COURIERS MADE EASY !!!</b></h3></center>
<center>
<img src="./back_image/tree.jpeg" height=100px width=140px>
<img src="./back_image/IIIT.jpeg" height=70px>
</center>
</div>
<div id="welcome">
<center><h2><b>Welcome To Postal Management Portal</b></h2> </center>
</div>
<div id="content">
<p><font size=4px><b><u>RECENT COURIERS</u> : </b></font><br></P>
<?php
/*
$username="root";
$password="nitesh";
$database="try";
mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database\n");
*/
$result=mysql_query("SELECT * from Courier_Info");
$take=mysql_query("SELECT * from Courier_Info where taken=1");
$row_count = mysql_num_rows ($result);
$take_count = mysql_num_rows ($take);
$count=0;
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<table border=2>";
echo "<tr>";
echo "<th><center>CId</center></th>";
echo "<th><center>Name</center></th>";
echo "<th><center>Room No.</center></th>";
echo "<th><center>Hostel</center></th>";
echo "<th><center>Type</center></th>";
echo "<th><center>Date</center></th>";
echo "<th><center>Address</center></th>";
echo "<th><center>Taken</center></th>";
echo "</tr>";
while(($row = mysql_fetch_array($result)) and $count<=50){
	$Room=$row['room'];
	list($hostel,$room)=split('-',$Room);
	echo "<tr>";
	echo "<td>".$row['courier_id']."</td>";
	echo "<td>".$row['student_name']."</td>";
	echo "<td>".$room."</td>";
	echo "<td>".$hostel."</td>";
	echo "<td>".$row['courier_type']."</td>";
	echo "<td>".$row['date']."</td>";
	echo "<td>".$row['sender_add']."</td>";
	if($row['taken']==1){
		$received="yes";
	}
	else if($row['taken']==0){
		$received="no";
	}
	echo "<td>".$received."</td>";

	echo "</tr>";
	$count=$count+1;
}
echo "</table>";
echo "Total Courier : ".$row_count;
echo "<br>";
echo "Couriers Taken : ".$take_count;
echo "<br>";
echo "Couriers yet not taken : ".($row_count-$take_count);

mysql_close();
?>
</div>
<div id="left">
<div id="top">
<br>
<br>
<h2><font color="green"><center>Sign In !</center></font></h2>
<form action="user_auth.php" method="post">
Username : <input type="text" name="user"><br>
<br>
Password : <input type="password" name="pass"><br>
<br>
<center>
<input type="Submit" value="Submit">
</center>
</form>
<?php
if($error==1){
	echo "<font color='red' size=3>";
	echo "Username or Password didn't match";
	echo "</font>";
}
?>
</div>
<div id="bottom">

<h2><font color="green"><center>Search Couriers !</center></font></h2>
<form action="search.php" method="post" name="testform">
From Date: <input name="testinput"><br>
	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'testform',
		// input name
		'controlname': 'testinput'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>
<br>
 To Date   :   <input type="date" name="testinput2"><br>
	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'testform',
		// input name
		'controlname': 'testinput2'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>

<br>
<input type="radio" name="take" value="1" checked=1>
All
<input type="radio" name="take" value="2">Taken
<input type="radio" name="take" value="3">Not Taken
<br>
<input type="hidden" name="rollno" value=3>
<input type="Submit" value="Submit">
</form>
</div>

</div>
<div id="footer">
</div>
</div>
</center>
</body>
</html>
