<?php
session_start();
$username="courier";
$password="#############";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");

@mysql_select_db($database) or die( "Unable to select database\n");
if(!isset($_SESSION['logged1'])){
	header("Location:main1.php?err=2");
}
if(isset($_GET['search'])){
	$search=1;
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

$("#datepicker").datepicker({
onSelect: function(dateText, inst) {
}
});

});
</script>
<!--<title>Pixel Green</title>--!>
<title>IIIT Courier Portal</title>	
	
</head>

<body>
<h2 id='sign'>Signed in as  : <font color='white'>admin</font></h2>
<!-- wrap starts here -->
<div id="wrap">

	<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="admin.php" title="">IIIT COURIER PORTAL<span class="gray"></span></a></h1>	
		<h2 id="slogan">Couriers Made Easy</h2>		
		
		<!-- Menu Tabs -->
		<ul>
		<?php
		if(isset($_GET['td'])){	
			echo "<li><a href='admin.php'>Home</a></li>";
			echo "<li><a href='admin.php?search=1&td=1' id='current'>Today</a></li>";
			echo "<li><a href='adminout.php'>Logout</a></li>";
		}
		else{	
			echo "<li><a href='admin.php' id='current'>Home</a></li>";
			echo "<li><a href='admin.php?search=1&td=1'>Today</a></li>";
			echo "<li><a href='adminout.php'>Logout</a></li>";
		}
		?>
		</ul>	
	
	</div></div>
	
	<div class="headerphoto"></div>
				
	<!-- content-wrap starts here -->
	<div id="content-wrap"><div id="content">		
		
		<div id="sidebar" >
		
			<div class="sidebox">
<?php 
if(isset($_GET['ad'])){
	echo "<br><Br><h1>Add/Delete User</h1>";
			echo "<ul class='sidemenu'>";
echo "<li><a href='admin.php?dl=1'>Delete User</a></li></ul>";
}
else if(isset($_GET['dl'])){
	echo "<br><Br><h1>Add/Delete User</h1>";
			echo "<ul class='sidemenu'>";
echo "<li><a href='admin.php?ad=1'>Add User</a></li></ul>";
}
else{
	echo "<br><Br><h1>Add/Delete User</h1>";
			echo "<ul class='sidemenu'>";
echo "<li><a href='admin.php?dl=1'>Delete User</a></li>";
echo "<li><a href='admin.php?ad=1'>Add User</a></li></ul>";
}
?>
</div>
			<div class="sidebox">	
						
				<h1><br>Search Courier</h1>	
				
<form action="search.php" method="post" name="testform">
From Date: <input name="testinput" id="datepicker"><br>

<br>
Till Date:<input type="date" name="testinput2" id="datepicker1"><br>

<center>
<input type="radio" name="select" value="1" checked=1>
All
<input type="radio" name="select" value="2">Taken
<input type="radio" name="select" value="3">Not Taken
<br>
</center>
<center><input type="submit" value="Submit"></center>
<input type="hidden" name="rollno" value="1">
</form>
			</div>
					
		</div>	
	
		<div id="main">		
		
			<div class="post"><br><br>
<?php
$err=$_GET['err'];
if($err==1){
	echo "<center>User has been Successfully added<center>";
}
else if($err==2){
	echo "<center>User has been Successfully deleted<center>";
}
else if($err==3){
	echo "<center>No Such Roll No Exist<center>";
}
if(isset($_GET['ad'])){
	echo "<p><font size=3px><b><u><center>ADD USER</center></u></b></font></p>";
	echo "<form action='add.php' method='post' name='test'><center>";
	echo "<table id='notab'>";
	echo "<tr><td>STUDENT NAME :</td><td><input type='text' name='name'><br></td></tr><br><tr><td>ROLL NO. :</td><td><input type='text' name='roll'><br></td></tr><br>";
	echo "<tr><td>ROOM NO. : </td><td><input type='text' name='room_no'><br></td></tr><tr><br<td>USERNAME : </td>";
	echo "<td><input type='text' name='id'><br></td></table></tr>";
	echo "<input type='Submit'></center></form><br><br>";
}
else if(isset($_GET['dl'])){
	echo "<h2><font size=3px><b><u><center>DELETE USER</center></u></b></font></h2>";
	echo "<form action='delete.php' method='post' name='test'><center>";
	echo "<table id='notab'>";
	echo "<tr><td>STUDENT NAME :</td><td><input type='text' name='name'><br></td></tr><br>";
	echo "<tr><td>ROLL NO. :</td><td><input type='text' name='rollno'><br></td></tr><br>";
	echo "</table><input type='Submit'></center></form><br><br><br><br><br><br><br>";
}
else {
	if($search==0){
		$query = "select * from Courier_Info ORDER BY courier_id";
	}
	else{
		$from=$_SESSION['fromdate'];
		$to=$_SESSION['todate'];
		$select=$_SESSION['select'];
		if(isset($_GET['td'])){
			$from=date('Y-m-d');
			echo "<p><font size=4px><b><u>TODAY's COURIERS ARE</u> : </b></font><br></P>";
			$query = "select * from Courier_Info where date='$from' ORDER BY courier_id";
		}
		else if($select==1){
			echo "<p><font size=3px><b><u>COURIERS BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
			$query = "select * from Courier_Info where date>='$from' and date<='$to' ORDER BY courier_id";
		}
		else if($select==2){
			echo "<p><font size=3px><b><u>COURIERS TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></P>";
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=1 ORDER BY courier_id";
		}
		else if($select==3){
			echo "<p><font size=3px><b><u>COURIERS NOT TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> :</b></font><br></P>";
			$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=0 ORDER BY courier_id";
		}
	}
	$q1=mysql_query($query);
	echo "<table><tr>";
	echo "<th class='first'>";
	echo "CId</th>";
	echo "<th>Name</th>";
	echo "<th>Hostel</th>";
	echo "<th>Room No.</th>";
	echo "<th>Type</th>";
	echo "<th>Date</th>";
	echo "<th>Address</th>";
	echo "<th>Taken</th>";
	echo "</tr>";
	$change=0;
	while($row = mysql_fetch_array($q1)){
		$take=$row['taken'];
		if($change==0){

			$Room=$row['room'];
			list($hostel,$room)=split('-',$Room);
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
				$count_taken=$count_taken+1;
			}
			else if($row['taken']==0){
				$received="no";
			}
			echo "<td>".$received."</td>";
			echo "</tr>";
			$change=1;
		}
		else if($change==1){
			$Room=$row['room'];
			list($hostel,$room)=split('-',$Room);
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
				$count_taken=$count_taken+1;
			}
			else if($row['taken']==0){
				$received="no";
			}
			echo "<td>".$received."</td>";
			echo "</tr>";
			$change=0;
		}
	}
	echo "</table><br>";
	echo "<br><br><br><br><br><br><br><p><code>";
	$query = mysql_query("select * from Courier_Info");
	$num1=mysql_num_rows($query);
	$query = mysql_query("select * from Courier_Info where taken=1");
	$num2=mysql_num_rows($query);
	echo "Total Courier : ".$num1;
	echo "<br>";
	echo "Couriers Taken : ".$num2;
	echo "<br>";
	echo "Couriers yet not taken : ".($num1-$num2);
	echo "</code></p>";	
}	

mysql_close();
?>
</div>
<!-- footer starts here -->
<div id="footer"><div id="footer-content">
<br><br>
<p><center>© Copyright by IIIT-Hyderabad | Design by Nitesh Surtani
</center></p>
</div></div>
<!-- footer ends here -->
	
<!-- wrap ends here -->

</body>
</html>
