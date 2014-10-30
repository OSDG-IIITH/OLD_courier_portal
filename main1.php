<?php
session_start();
$username="courier";
$password="###############";
$database="courier";
mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database\n");
if(isset($_GET['search'])){
	$search=$_GET['search'];
}
else{
	$search=0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />



<link rel="icon" href="/scratch/portal/favicon.ico" type="text/ico" />
<link rel="stylesheet" href="images/PixelGreen.css" type="text/css" />
<link type="text/css" href="jquery-ui-1.8.custom.css" rel="stylesheet" />

<script type="text/javascript" src="jquery-1.4.2.js"></script>
        <script type="text/javascript" src="jquery.ui.core.js"></script>
	<script type="text/javascript" src="jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="jquery.ui.datepicker1.js"></script>
	<script type="text/javascript" src="jquery.ui.datepicker2.js"></script>

	<script type="text/javascript">

	$('document').ready(function (){
$("#datepicker1").datepicker({
onSelect: function(dateText, inst) {
}
});

$("#datepicker2").datepicker({
onSelect: function(dateText, inst) {
}
});

$("#datepicker").datepicker({
onSelect: function(dateText, inst) {
}
});

});
</script>
<title>IIIT-H Courier Portal</title>	
</head>


<body>
<!--	<div class="iiit"></div>--!>
<h3 id="sign"><font color='white'>NOT SIGNED IN </font></h3>
<div id="wrap">

	<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="main1.php" title="">IIIT-H COURIER PORTAL<span class="gray"></span></a></h1>	
		<h2 id="slogan">Couriers Made Easy</h2>		
		
		<!-- Menu Tabs -->
		<ul>
		<?php
			if(isset($_GET['td'])){
			echo "<li><a href='main1.php'>Home</a></li>";
			echo "<li><a href='main1.php?al=1'>All</a></li>";
			echo "<li><a href='main1.php?td=1' id='current'>Today</a></li>";
			}
			else if(isset($_GET['al'])){
			echo "<li><a href='main1.php'>Home</a></li>";
			echo "<li><a href='main1.php?al=1' id='current'>All</a></li>";
			echo "<li><a href='main1.php?td=1'>Today</a></li>";
			}
			else{
			echo "<li><a href='main1.php' id='current'>Home</a></li>";
			echo "<li><a href='main1.php?al=1'>All</a></li>";
			echo "<li><a href='main1.php?td=1'>Today</a></li>";
			}
		?>
		</ul>	
	
	</div></div>
	<div class="headerphoto"></div>
	<div id="content-wrap"><div id="content">		
<div id="sidebar">

<div id="sidebox">
<h1><br>Security Login</h1>	
<form action="sec_auth.php" method="post">
Username : <input type="text" name="user">
<br>
<br>
Password : <input type="password" name="pass">
<br>
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
<!--
<div class="sidebox">
<form action="search.php" method="post">
<br><h1>Search By Name :</h1>
<ul class="sidemenu">
<li><input type="text" name="namesearch" size=20px>
<input type="Submit" value="Submit"></li></ul>
<input type="hidden" name="search" value="1">
<input type="hidden" name="rollno" value="0">
</form>
</div>
--!>
<!--
<div id="sidebox">
<form action="search.php" method="post">
<br><h1>Search By Courier Id : </h1>
<ul class="sidemenu">
<li>
<input type="text" name="cid" size=20px>
<input type="Submit" value="Submit">
</li></ul>
<input type="hidden" name="search" value="2">
<input type="hidden" name="rollno" value="0">
</div>

</form>
--!>
<div id="sidebox">

<h1><br>Search Courier</h1>	
<form action="search.php" method="post" name="testform">
<br>
From Date: <input name="testinput" id="datepicker"><br>
<br>
Till Date   :   <input type="date" name="testinput2" id="datepicker1"><br>
<br>
<center>
<input type="radio" name="select" value="1" checked=1>
All
<input type="radio" name="select" value="2">Taken
<input type="radio" name="select" value="3">Not Taken
<br>
<input type="hidden" name="search" value="3">
<input type="hidden" name="rollno" value="0">
<input type="Submit" value="Submit">
</center>
</form>

</div>

</div>
				

	<div id="main">		

	<div class="post"><br><br>
<?php 
$err=$_GET['err'];
if($err==1){
	echo "<center>Username/Password is not correct<center>";
}
if($err==2){
	echo "<center>This login is not for students !! Check the below one !!<center>";
}
/*
else if($err==2){
	echo "<center>Mail Has Been Sent<center>";
}
else if($err==3){
	echo "<center>Courier Information has been updated<center>";
}
else if($err==4){
	echo "<center>Courier Id does not exist<center>";
}
else if($err==5){
	echo "<center>Address not given<center>";
}
else if($err==6){
	echo "<center>Courier Id not found<center>";
}
*/
?>


<?php
if(isset($_GET['td'])){
	echo "<p><font size=4px><b><u>TODAY's COURIERS ARE </u> : </b></font><br></P>";
	$today=date('Y-m-d');
	$query = "select * from Courier_Info where date='$today' ORDER BY courier_id";
	$result=mysql_query($query) or die ( "not selected\n");
	echo "<table>";
	echo "<tr>";
	echo "<th class='first'>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	$change=0;
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		if($change==0){
		echo "<tr class='row-a'>";
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
		$change=1;
		}
		else if($change==1){
		echo "<tr class='row-b'>";
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
		$change=0;
		}
	}
	echo "</table>";
}

else if(isset($_GET['al'])){
	echo "<p><font size=4px><b><u>LIST OF ALL COURIERS </u> : </b></font><br></P>";
	$query = "select * from Courier_Info ORDER BY courier_id";
	$result=mysql_query($query) or die ( "not selected\n");
	echo "<table>";
	echo "<tr>";
	echo "<th class='first'>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	$change=0;
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		if($change==0){
		echo "<tr class='row-a'>";
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
		$change=1;
		}
		else if($change==1){
		echo "<tr class='row-b'>";
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
		$change=0;
		}
	}
	echo "</table>";
}
else if($search==0){
	echo "<center>";
	echo "<form action='search.php' method='post'>";
	echo "<br><h1>Search By Name :</h1><br><br>";
	echo "<input type='text' name='namesearch' size=20px>";
	echo "<input type='Submit' value='Submit'>";
	echo "<input type='hidden' name='search' value='1'>";
	echo "<input type='hidden' name='rollno' value='0'>";
	echo "</form>";
	echo "<br><b>IIIT-H Students can <a href=\"index.php\">login</a> here.</b>";
	echo "</center><br><br><br><br><br>";
}

else if($search==1){
	if(isset($_SESSION['namesearch'])){
		$name=$_SESSION['namesearch'];
	}
	echo "<p><font size=4px><b><u>COURIERS FOR ".strtoupper($name)." ARE </u> : </b></font><br></P>";
$partialname=split(" ",$name);
	$check_partial_name="";
	$len=count($partialname);
	$i=0;
	foreach($partialname as $par){
		$check_partial_name=$check_partial_name." student_name LIKE '%".$par."%' ";
		$i=$i+1;
		if($i!=$len){
			$check_partial_name=$check_partial_name." or ";
		}
	}
	$query = "select * from Courier_Info where (".$check_partial_name.") ORDER BY courier_id";
	
	$result=mysql_query($query) or die ( "not selected\n");
	echo "<table>";
	echo "<tr>";
	echo "<th class='first'>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	$change=0;
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		if($change==0){
		echo "<tr class='row-a'>";
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
		$change=1;
		}
		else if($change==1){
		echo "<tr class='row-b'>";
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
		$change=0;
		}
	}
	echo "</table>";
}
/*
else if($search==2){
	if(isset($_GET['val'])){
		$cid=$_GET['val'];
	}
	else{
		$cid=$_SESSION['cid'];
	}
	echo "<p><font size=4px><b><u>DETAILS OF THE COURIER WITH COURIER ID = ".$cid." IS :</u></b></font><br></p>";
	$query = "select * from Courier_Info where (courier_id='$cid') ORDER BY courier_id";
	$result=mysql_query($query) or die ( "not selected\n");
	$count = mysql_num_rows ($result);
	if($result==0){
		//no such courier_id exist
		header("Location:main1.php?err=4");
	}
	$row=mysql_fetch_array($result);
	list($room,$hostel)=split('-',$row['room']);
	
	echo "<center><form action='insert.php' method='post' name='test'>";
echo "<table id='notab'>";
echo "<tr>";
echo "<td>";
echo "COURIER ID :</td>";
	echo "<td><input type='text' name='cid' value='".$row['courier_id']."' readonly></td></tr><br>";
	echo "<tr><td>STUDENT NAME :</td>";
	echo "<td><input type='text' value='".$row['student_name']."' readonly></td></tr>";
	echo "<br>";
	echo "<tr><td>HOSTEL :</td>";
	echo "<td><input type='text' value='".$hostel."' readonly></td></tr>";
	echo "<br><tr><td>ROOM NO :</td><td>";
	echo "<input type='text' value='".$room."' readonly></td></tr>";
	echo "<br><tr><td>COURIER TYPE:</td>";
	echo "<td><input type='text' value='".$row['courier_type']."' readonly></td></tr>";
	echo "<br><tr><td>DATE :</td>";
	echo "<td><input type='text' value='".$row['date']."' readonly></td></tr>";
	echo "<br><tr><td>ADDRESS :</td>";
	echo "<td><input type='text' value='".$row['sender_add']."' readonly></td></tr>";
	echo "<br><tr><td>TAKEN :</td><td>";
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
	echo "<input type='text' value='$s1' readonly></td></tr></table><br>";
	echo "<input type='hidden' name='update' value=1>";
	echo "<input type='Submit' value='Submit'></form><center>";
	
}
*/
else if($search==3){
	$from=$_SESSION['fromdate'];
	$to=$_SESSION['todate'];
	if(isset($_SESSION['select'])){
		$select=$_SESSION['select'];
	}
	else{
		$select=0;
	}
	if($select==1){
		echo "<p><font size=3px><b><u>ALL COURIERS BETWEEN DATES ".$from." to ".$to." ARE </u> : </b></font><br></P>";
		$query = "select * from Courier_Info where (date>='$from' and date<='$to') ORDER BY courier_id";
	}
	else if($select==2){
		echo "<p><font size=3px><b><u>COURIERS TAKEN BETWEEN DATES ".$from." to ".$to." ARE </u> : </b></font><br></P>";
		$query = "select * from Courier_Info where (date>='$from' and date<='$to' and taken=1) ORDER BY courier_id";
	}
	else if($select==3){
		echo "<p><font size=3px><b><u>COURIERS NOT TAKEN BETWEEN DATES ".$from." to ".$to." ARE </u> : </b></font><br></P>";
		$query = "select * from Courier_Info where (date>='$from' and date<='$to' and taken=0) ORDER BY courier_id";
	}
	$result=mysql_query($query) or die ( "not selected\n");
	echo "<table>";
	echo "<tr>";
	echo "<th class='first'>CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	$change=0;
	while($row = mysql_fetch_array($result)){
		$Room=$row['room'];
		list($hostel,$room)=split('-',$Room);
		if($change==0){
	
		echo "<tr class='row-a'>";
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
		$change=1;
		}
		else if($change==1){
	
		echo "<tr class='row-b'>";
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
		$change=0;
		}
	}
	echo "</table>";
}
if($search==0){
	echo "<br><br><br>";
	echo "<br><br>";
}
else{
	echo "<br><br><br><br><br><br><br><br>";
}

$result=mysql_query("SELECT * from Courier_Info ORDER BY courier_id");
$take=mysql_query("SELECT * from Courier_Info where taken=1 ORDER BY courier_id");
$row_count = mysql_num_rows ($result);
$take_count = mysql_num_rows ($take);
echo "<br><br><br><br><br><br><br>";
echo "<br><br><br><br><br>";
echo "<br><br><br><br><p><code>";
echo "Total Courier : ".$row_count;
echo "<br>";
echo "Couriers Taken : ".$take_count;
echo "<br>";
echo "Couriers Yet Not Taken : ".($row_count-$take_count);
echo "</code></p>";	
echo "<br>";
?>
</div>
<?php
mysql_close();
?>
<div id="footer"><div id="footer-content">
<br><br>
<p><center>© Copyright by IIIT-Hyderabad | Design by Nitesh Surtani
</center></p>
</div></div>
</body>
</html>
