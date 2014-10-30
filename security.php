<?php
session_start();
$username="courier";
$password="##############";
$database="courier";
mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database\n");

// If not logged-in, redirect to main1.php
if(!isset($_SESSION['logged2'])){
	header("Location:main1.php");
}

// If search is enabled, find which option has user chosen for searching which are namely:
// - By CourierId
// - By Name
// - Between Dates (All, Taken, Not Taken)
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
<script type="text/javascript">

// To toggle between the Change link. This is done when the roll_no of the student is known.
// Hidden field : name=change with value='1' means that security has switched the to NAME and ROLLNO 

// name='roll no of the corresponding tuple' is the field that is passed to "insert.php" if the screen is not toggled
// name1='name entered' and roll1='roll no entered' are the fields that are passed to "insert.php" when screen is switched
flag=0;
function checkForm(){
	if(flag==0){
		document.getElementById('division').innerHTML="<input type='hidden' value='1' name='change'><td width='45%'>NAME : <input type='text' style='background-color: #FFFF66;'  name='name1'></td><td>ROLL NO. : <input type='text' style='background-color: #FFFF66;' name='roll1' value='0' size=20px><a href='javascript:void()' onclick='checkForm()'>change</a></td>";	
		flag=1;
	}
	else if(flag==1){
		document.getElementById('division').innerHTML="<input type='hidden' value='0' name='change'><td width='45%'>STUDENT NAME :</td><?php $q="select * from Student";$r=mysql_query($q); ?><td><select name='name' value='Choose Name' style='background-color: #FFFF66;' STYLE='width:200px'><?php while($row = mysql_fetch_array($r)){ $Name=$row['name'];$Roll=$row['roll_no'];echo "<option value=".$Roll.">".$Name."( ".$Roll." ) </option>"; }?></select><a href='javascript:void()' onclick='checkForm()'>change</a></td>";
		flag=0;
	}
}
</script>
<title>IIIT Courier Portal</title>	
</head>


<body>
<h3 id="sign">Signed in as  :<font color="white"> security</font></h3>
<div id="wrap">

	<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="security.php" title="">IIIT COURIER PORTAL<span class="gray"></span></a></h1>	
		<h2 id="slogan">Couriers Made Easy</h2>		
		
		<!-- Menu Tabs -->
		<ul>
		<?php
		// "td" refers to Today's couriers
		// "al" refers to All couriers
		if(isset($_GET['td'])){
			echo "<li><a href='security.php'>Home</a></li>";
			echo "<li><a href='security.php?al=1'>All</a></li>";
			echo "<li><a href='security.php?td=1' id='current'>Today</a></li>";
			echo "<li><a href='secout.php'>Logout</a></li>";
		}
		else if(isset($_GET['al'])){
			echo "<li><a href='security.php'>Home</a></li>";
			echo "<li><a href='security.php?al=1' id='current'>All</a></li>";
			echo "<li><a href='security.php?td=1'>Today</a></li>";
			echo "<li><a href='secout.php'>Logout</a></li>";
		}
		else{
			echo "<li><a href='security.php' id='current'>Home</a></li>";
			echo "<li><a href='security.php?al=1'>All</a></li>";
			echo "<li><a href='security.php?td=1'>Today</a></li>";
			echo "<li><a href='secout.php'>Logout</a></li>";
		}
		?>
</ul>	

	</div></div>
	
	<div class="headerphoto"></div>
	<div id="content-wrap"><div id="content">		
<div id="sidebar">

<div class="sidebox">
<form action="search.php" method="post">
<br><h1>Search By Name :</h1>
<ul class="sidemenu">
<li><input type="text" name="namesearch" size=20px>
<input type="Submit" value="Submit"></li></ul>
<input type="hidden" name="search" value="1">
<input type="hidden" name="rollno" value="2">
</form>
</div>
<div id="sidebox">
<form action="search.php" method="post">
<br><h1>Search By Courier Id : </h1>
<ul class="sidemenu">
<li>
<input type="text" name="cid" size=20px>
<input type="Submit" value="Submit">
</li></ul>
<input type="hidden" name="search" value="2">
<input type="hidden" name="rollno" value="2">
</div>

</form>

<div id="sidebox">

<h1><br>Search Courier</h1>	
<form action="search.php" method="post" name="testform">
<br>
<!--<table align="left">
<tr>
<td>--!>
From: </td><td><input name="testinput" id="datepicker"></td>
<!--</tr><br><tr>
<td>--!>
<br>
<br>
Till  :  </td> <input type="date" name="testinput2" id="datepicker1"></td></td></tr>
<br>
<!--</table>--!>
<center>
<input type="radio" name="select" value="1" checked=1>
All
<input type="radio" name="select" value="2">Taken
<input type="radio" name="select" value="3">Not Taken
<br>
<input type="hidden" name="search" value="3">
<input type="hidden" name="rollno" value="2">
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
	echo "<font color='red' size=3px><center>Roll No is not Correct<center></font>";
}
else if($err==2){
	echo "<font color='red' size=3px><center>Mail Has Been Sent<center></font>";
}
else if($err==3){
	echo "<font color='red' size=3px><center>Courier Information has been updated<center></font>";
}
else if($err==4){
	echo "<font color='red' size=3px><center>Courier Id does not exist<center></font>";
}
else if($err==5){
	echo "<font color='red' size=3px><center>Address not given<center></font>";
}
else if($err==6){
	echo "<font color='red' size=3px><center>Courier Id not found<center></font>";
}
else if($err==7){
	echo "<font color='red' size=3px><center>Room Number not specified<center></font>";
}
else if($err==8){
	echo "<font color='red' size=3px><center>No Student specified for this room no.<center></font>";
}
else if($err==9){
	echo "<font color='red' size=3px><center>Please enter Student Name<center></font>";
}
else if($err==10){
	echo "<font color='red' size=3px><center>Courier details have been added but no Mail has been sent<center></font>";
}
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
	echo "<br><br><br>";
	echo "<br><br><br>";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
	echo "<br><br><br>";
	echo "<br><br><br>";
}

// Main page for sending the courier
else if($search==0){
	echo "<h2><font size=3px><b><u><center>DETAILS OF THE COURIERS</center></u></b></font></h2>";
	echo "<form action='insert.php' method='post' name='test'>";
	echo "<center><table border=0px align='center' width='100%'><font size=5px>";
	echo "<tr id='division'>";
	echo "<input type='hidden' value='0' name=change'>";
	echo "<td width='40%'>STUDENT NAME :</td>";
	$q="select * from Student ORDER BY name";
	$r=mysql_query($q) or die("can't fetch data");
	echo "<td><select name='name' style='background-color: #FFFF66;' value='Choose Name' STYLE='width:200px'>";
	while($row = mysql_fetch_array($r)){
		$Name=$row['name'];
		$Roll=$row['roll_no'];
		echo "<option value=".$Roll.">".$Name." ( ".$Roll." ) </option>";
	}
	echo "</select>";
	echo "<a href='javascript:void()' onclick='checkForm()'>change</a>";
	echo "</td></tr><br><br>"; 
	echo "<tr>";
	echo "<td>HOSTEL : </td>";
	echo "<td><select name='hostel' style='background-color: #FFFF66;' ><option value='OBH'>OBH</option><option value='OBHD'>OBHD</option><option value='OBHE'>OBHE</option><option value='NBH'>NBH</option><option value='BAKUL'>BAKUL</option><option value='GH'>GH</option><option value='GHEB'>GHEB</option><option value='NBH Cellar'>NBH Cellar</option></SELECT></td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>ROOM NO : </td><td><input type='text' style='background-color: #FFFF66; border='1px solid #000000;' name='room_no'></td><br>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>COURIER TYPE:</td><td><input type='text' style='background-color: #FFFF66;' name='type'></td><br>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>DATE :</td>";
	$today=date('Y-m-d');
	echo "<td><input type='text' name='testinput3' style='background-color: #FFFF66;' id='datepicker2' value='$today'>
		</td>
		<br>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>ADDRESS :</td>
		
		<td><input type='text' style='background-color: #FFFF66;' name='address'></td>
		<br>";
	echo "</tr></table>";
	echo "<input type='hidden' name='update' value=0><br>";
	echo "<input type='Submit' STYLE='color: #FFFFFF; font-family: Verdana;  font-size: 15px; background-color: #72A4D2;' value='Submit'>";
	echo "</center></font></form>";
	
}

// For displaying the results of searching by name
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
		$check_partial_name=$check_partial_name." student_name LIKE '%".$par."%'";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
	echo "<br><br><br>";
}

// For displaying the results of searching by COURIER_ID
else if($search==2){
	if(isset($_GET['val'])){
		$cid=$_GET['val'];
	}
	else{
		$cid=$_SESSION['cid'];
	}
	$query = "select * from Courier_Info where courier_id=$cid";
	$result=mysql_query($query) or die ( "not selected\n");
	$count = mysql_num_rows ($result);
	if($count==0){
		echo "<p><font size=4px><b><center>NO COURIER WITH COURIER ID = ".$cid." EXISTS</center></b></font><br></p>";
	}
	else{
		echo "<p><font size=4px><b><u>DETAILS OF THE COURIER WITH COURIER ID = ".$cid." IS :</u></b></font><br></p>";
		$row=mysql_fetch_array($result);
		list($hostel,$room)=split('-',$row['room']);
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
		echo "<select name='taken'> <option value=".$take.">".$s1."</option>	 <option value=".$nottake.">".$s2."</option>	 </SELECT></td></tr></table><br>";
		echo "<input type='hidden' name='update' value=1>";
		echo "<input type='Submit' value='Submit'></form><center>";
	}
}

// For displaying the results of searching between DATES
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
		echo "<td><a href='security.php?val=".$row['courier_id']."&search=2'>".$row['courier_id']."</a></td>";
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
	echo "<br><br><br>";
}
if($search==0){
	echo "<br><br><br>";
}
else{
	echo "<br><br><br>";
	echo "<br><br><br><br><br><br><br><br>";
}

$result=mysql_query("SELECT * from Courier_Info ORDER BY courier_id");
$take=mysql_query("SELECT * from Courier_Info where taken=1 ORDER BY courier_id");
$row_count = mysql_num_rows ($result);
$take_count = mysql_num_rows ($take);
echo "<br><br><br><br><p><code>";
echo "Total Courier : ".$row_count;
echo "<br>";
echo "Couriers Taken : ".$take_count;
echo "<br>";
echo "Couriers Yet Not Taken : ".($row_count-$take_count);
echo "</code></p>";	
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
