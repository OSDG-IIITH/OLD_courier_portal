<?php

session_start();

$username="courier";
$password="###############";
$database="courier";
mysql_connect(localhost,$username,$password);


@mysql_select_db($database) or die( "Unable to select database\n");
$from=$_POST['testinput'];
$to=$_POST['testinput2'];
$search=$_POST['search']; // Tells which kind of search is the user making ( On NAME, on CID , between DATES )
$roll=$_POST['rollno'];  // Tells who has sent the request for search 
// Main page : 0
// Admin : 1
// security :2
// student : their roll_no

$namesearch=$_POST['namesearch']; // Tells the name of the person whose couriers are to be searched
$cid=$_POST['cid']; // Tells the courier_id which is being searched
$select=$_POST['select']; // Tells whether All, Taken or Not Taken couriers are being searched
$_SESSION['fromdate']=$from;
$_SESSION['todate']=$to;
$_SESSION['select']=$select;
$_SESSION['cid']=$cid;
$_SESSION['namesearch']=$namesearch;
if($roll==0){
	header("Location:main1.php?search=$search");
}
else if($roll==1){
	header("Location:admin.php?search=1");
}
else if($roll==2){
	header("Location:security.php?search=$search");
}
else{
	$_SESSION['student']=$roll;
	header("Location:index.php?search=1");
}
if(!is_numeric($cid) and isset($cid)){
	header("Location:security.php?err=6");
}
/*
$roll=$_POST['rollno'];
$flag=0;
iselect * from Student where roll_no=$rollf($roll==1){
	$q="select * from information where username='admin'";
	$flag=1;
}
else if($roll==2){
	$q="select * from information where username='security'";
	$flag=1;
}
else if($roll==3){
	$flag=0;
}
else{
	$q="select * from information where roll_no='$roll'";
	$flag=1;
}
if($flag==1){
	$r=mysql_query($q);
	$arr = mysql_fetch_array($r);
	$l=$arr['logged'];
	if($l==0){
		header("Location:http://localhost/portal/main.php");
	}
}

?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>IIIT Courier Portal</title>	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<LINK REL=stylesheet href="style.css" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_db.js"></script>
<link rel="stylesheet" href="tigra_calendar/calendar.css">

</head>
<body>
<center>
<div id="main">
<div id="header">
<center><h3><b>COURIERS MADE EASY !!!</b></h3></center>
<center>
<img src="./images/tree.jpeg" height=100px width=140px>
<img src="./images/IIIT.jpeg" height=70px>
</center>
</div>
<div id="welcome">
<center><h2><b>Welcome To Postal Management Portal</b></h2> </center>
</div>
<div id="content">
<?php
$result=mysql_query("SELECT * from Courier_Info");
$row_count = mysql_num_rows ($result);


$from=$_POST['testinput'];
$to=$_POST['testinput2'];
$take=$_POST['hid'];
$hidden=$_GET['hidden'];
if($hidden!=0){
	$take=$hidden;
}
$rol=$_GET['roll'];
if($rol!=0){
	$roll=2;
}
$name=$_POST['namesearch'];
$val=$_GET['val'];
$cid=$_POST['cid'];
if($val!=0){
	$cid=$val;
}
if($cid>$row_count){
	header("Location:security.php?err=6");
}
echo "take= ".$take,"roll = ".$roll,"cid = ".$cid;

if($take==1){
	echo "<p><font size=4px><b><u>COURIERS FOR ".$name." ARE </u> : </b></font><br></P>";
	$query = "select * from Courier_Info where student_name='$name'";
}

else if($take==3&&($roll==1||$roll==2||$roll==3)){
	echo "<p><font size=4px><b><u>COURIERS BETWEEN DATES ".$from." to ".$to." ARE </u> : </b></font><br></P>";
	$query = "select * from Courier_Info where date>='$from' and date<='$to'";
}
else if($take==2){
//	echo "<p><font size=4px><b><u>COURIERS WITH COURIER ID = ".$cid." ARE </u> : </b></font><br></P>";
	$query = "select * from Courier_Info where courier_id='$cid'";
}
else{
	$select=$_POST['take'];
	if($roll==1||$roll==2||$roll==3){
		if($select==1){
			$query = "select * from Courier_Info where date>='$from' and date<='$to'";
			echo "<p><font size=4px><b><u>ALL COURIERS BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
		else if($select==2){
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=1";
			echo "<p><font size=4px><b><u>COURIERS TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
		else if($select==3){
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=0";
			echo "<p><font size=4px><b><u>COURIERS NOT TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
	}
	else{
		$query1="select * from Student where roll_no='$roll'";
		$res=mysql_query($query1);
		$row=mysql_fetch_array($res);
		$name=$row['name'];
		if($select==1){
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and student_name='$name'";
			echo "<p><font size=4px><b><u>ALL COURIERS FOR ".$name." BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
		else if($select==2){
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=1 and student_name='$name'";
			echo "<p><font size=4px><b><u>COURIERS TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
		else if($select==3){
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=0 and student_name='$name'";
			echo "<p><font size=4px><b><u>COURIERS NOT TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
		}
	}
}
$result=mysql_query($query) or die ( "not selected\n");
if($roll==1||$roll==3||$roll==2 && $take==0){
	echo "<table border=2>";
	echo "<tr>";
	echo "<th>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		echo "<tr>";
		echo "<td>".$row['courier_id']."</td>";
		echo "<td>".$row['student_name']."</td>";
		echo "<td>".$hostel."</td>";
		echo "<td>".$room."</td>";
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
	}
	echo "</table>";

	$result=mysql_query("SELECT * from Courier_Info");
	$take=mysql_query("SELECT * from Courier_Info where taken=1");
	$row_count = mysql_num_rows ($result);
	$take_count = mysql_num_rows ($take);
	echo "Total Courier : ".$row_count;
	echo "<br>";
	echo "Couriers Taken : ".$take_count;
	echo "<br>";
	echo "Couriers yet not taken : ".($row_count-$take_count);
}

else if($roll==2 && ($take==1||$take==3)){
	echo "<table border=2>";
	echo "<tr>";
	echo "<th>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		echo "<tr>";
		echo "<td><a href='http://localhost/portal/search.php?val=".$row['courier_id']."&hidden=2 & roll=2'>".$row['courier_id']."</a></td>";
		echo "<td>".$row['student_name']."</td>";
		echo "<td>".$hostel."</td>";
		echo "<td>".$room."</td>";
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
	}
	echo "</table>";


	$result=mysql_query("SELECT * from Courier_Info");
	$take=mysql_query("SELECT * from Courier_Info where taken=1");
	$row_count = mysql_num_rows ($result);
	$take_count = mysql_num_rows ($take);
	echo "Total Courier : ".$row_count;
	echo "<br>";
	echo "Couriers Taken : ".$take_count;
	echo "<br>";
	echo "Couriers yet not taken : ".($row_count-$take_count);
}


else if($roll==2 && $take==2){
	$count = mysql_num_rows ($result);
	if($result==0){
		//no such courier_id exist
		header("Location:security.php?err=4");
	}
	$row=mysql_fetch_array($result);
	list($room,$hostel)=split('-',$row['room']);
	echo "<h2><font size=3px><b><u><center>DETAILS OF THE COURIERS</center></u></b></font></h2>";
	echo "<form action='insert.php' method='post' name='test'>";
	echo "<div class='attr'>Courier Id :</div><div class='val'>";
	echo "<input type='text' name='cid' value='".$row['courier_id']."' readonly></div><br>";
	echo "<div class='attr'>";
	echo "Student Name :</div><div class='val'>";
	echo "<input type='text' value='".$row['student_name']."' readonly>";
	echo "</div><br>";
	echo "<div class='attr'>HOSTEL :</div><div class='val'>";
	echo "<input type='text' value='".$hostel."' readonly>";
	echo "</div><br><div class='attr'>Room No : </div><div class='val'>";
	echo "<input type='text' value='".$room."' readonly>";
	echo "<br></div><br><div class='attr'>Courier Type:</div><div class='val'>";
	echo "<input type='text' value='".$row['courier_type']."' readonly>";
	echo "</div><br><div class='attr'>Date :</div><div class='val'>";
	echo "<input type='text' value='".$row['date']."' readonly>";
	echo "</div><br><div class='attr'>Address :</div><div class='val'>";
	echo "<input type='text' value='".$row['sender_add']."' readonly>";
	echo "</div><br><div class='attr'>Taken :</div><div class='val'>";
	$take=$row['taken'];
	if($take==0){
		$s1="No";
		$s2="Yes";
		$nottake=1;
	}
	else{
		$s2="No";
		$s1="Yes";
		$nottake=0;
	}
	echo "<select name='taken'> <option value=".$take.">".$s1."</option>	 <option value=".$nottake.">".$s2."</option>	 </SELECT></div><br>";
	echo "<input type='hidden' name='update' value=1>";
	echo "<input type='Submit' value='Submit'></form>";
	$result=mysql_query("SELECT * from Courier_Info");
	$take=mysql_query("SELECT * from Courier_Info where taken=1");
	$row_count = mysql_num_rows ($result);
	$take_count = mysql_num_rows ($take);
	echo "Total Courier : ".$row_count;
	echo "<br>";
	echo "Couriers Taken : ".$take_count;
	echo "<br>";
	echo "Couriers yet not taken : ".($row_count-$take_count);
}
else{
	echo "<table border=2>";
	echo "<tr>";
	echo "<th>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		echo "<tr>";
		echo "<td>".$row['courier_id']."</td>";
		echo "<td>".$row['student_name']."</td>";
		echo "<td>".$hostel."</td>";
		echo "<td>".$room."</td>";
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
	}
	echo "</table>";

	$result=mysql_query("SELECT * from Courier_Info where student_name='$name'");
	$take=mysql_query("SELECT * from Courier_Info where taken=1 and student_name='$name'");
	$row_count = mysql_num_rows ($result);
	$take_count = mysql_num_rows ($take);
	echo "Total Courier : ".$row_count;
	echo "<br>";
	echo "Couriers Taken : ".$take_count;
	echo "<br>";
	echo "Couriers yet not taken : ".($row_count-$take_count);
}
?>


</div>
<div id="left">
<div id="top">
<br>
<br>

<br>
<br>
<?php
if($roll==1){
	echo "<a href='http://localhost/portal/admin.php'>BACK</a>";
	echo "<ul>";
	echo "<li><a href='http://localhost/portal/add_user.php'>ADD USER</a></li>";
	echo "<li><a href='http://localhost/portal/delete_user.php'>DELETE USER</a></li>";
	echo "</ul>";
}
else if($roll==2){
	echo "<a href='http://localhost/portal/security.php'>BACK</a><br><br>";
	echo "<form action='search.php' method='post'>";
	echo "Name : ";
	echo "<input type='text' name='namesearch' size=15px>";
	echo "<input type='Submit' value='Submit'>";
	echo "<input type='hidden' name='hid' value=1>";
	echo "<input type='hidden' name='rollno' value=2>";
	echo "</form>";
	echo "<br>";
	echo "<form action='search.php' method='post'>";
	echo "Courier Id : <input type='text' name='cid'></font>";
	echo "<input type='hidden' name='hid' value=2>";
	echo "<input type='hidden' name='rollno' value=2>";
	echo "	<input type='Submit' value='Submit'>";
	echo "<br>";
	echo "<br>";
	echo "</form>";
}
else if($roll==3){
	echo "<a href='http://localhost/portal/main.php'>BACK</a></text>";
	echo "<form action='authenticate.php' method='post'>";
	echo "Username : <input type='text' name='user'><br>";
	echo "<br>";
	echo "Password : <input type='password' name='pass'><br>";
	echo "<br>";
	echo "<center>";
	echo "<input type='Submit' value='Submit'>";
	echo "</center>";
	echo "</form>";
}
else{
	echo "<a href='http://localhost/portal/index.php?roll=$roll'>BACK</a>";
}
*/
mysql_close();
?>
<!--
</div>
<div id="bottom">

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
<input type="radio" name="take" value="1" checked=1>All
<input type="radio" name="take" value="2">Taken
<input type="radio" name="take" value="3">Not Taken
<br>
<input type="hidden" value="<?php echo $roll?>" name="rollno">
<input type="hidden" name="hid" value="3">
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
--!>
