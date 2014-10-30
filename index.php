<?php
include_once('CAS.php');
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"/cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
if (isset($_REQUEST['logout'])) {
       phpCAS::logout();
}
session_start();
$username="courier";
$password="###############";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");
$prof=0;
$usern=phpCAS::getUser();
$query="select * from Student where username='$usern'";
$result=mysql_query($query) or die("cannot find password");

$prof=$_GET['prof'];
$val=mysql_fetch_array($result);
$roll=$val['roll_no'];
$room=$val['room_no'];
list($hostel,$room_n)=split('-',$room);
if($room_n==""){	
	$prof=1;
}
$search=$_GET['search'];
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
<?php
$notfound="<br><br><br><br><br><br><br><font color='blue' size=4px><p>You have not been registered on the Courier Portal.</p>";
$notfound=$notfound."<form action='approve.php' method='post' name='testingform'>";
$notfound=$notfound."<p><font color='blue'>Enter Your Roll No : </font><input type='text' style='color: #000000; background-color: #98AFC7;' name='addroll' value=''>";
$notfound=$notfound."<input type='hidden' name='emailid' value='$usern'>";
$notfound=$notfound."<center><input type='submit' style='color: #000000; background-color: #4863A0;' 'value='Submit'></center>";
$notfound=$notfound."</form>";
$notfound=$notfound."<p><font size=2px color='blue'>( Login again to check your Profile )</font></p>";
//$qur="select * from Student where roll_no='$roll'";
//echo $qur;
$res=mysql_query("select * from Student where roll_no='$roll'")or die($notfound);


$val=mysql_fetch_array($res);
$name=$val['name'];
$room=$val['room_no'];

?>
<h2 id='sign'>Signed in as  : <?php echo "<font color='white'>$name</font>" ?></h2>
<!-- wrap starts here -->
<div id="wrap">

	<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="index.php" title="">IIIT COURIER PORTAL<span class="gray"></span></a></h1>	
		<h2 id="slogan">Couriers Made Easy</h2>		
		
		<!-- Menu Tabs -->
		<ul>
		<?php
			echo "<li><a href='index.php' id='current'>Home</a></li>";
			echo "<li><a href='?logout='>Logout</a></li>";
		?>
		</ul>	
	
	</div></div>
	
	<div class="headerphoto"></div>
				
	<!-- content-wrap starts here -->
	<div id="content-wrap"><div id="content">		
		
		<div id="sidebar" >
		
			<div class="sidebox">
<?php 
if(isset($_GET['prof'])){
	echo "<br><Br><h1>Home</h1>";
			echo "<ul class='sidemenu'>";
echo "<li><a href='index.php'>Go Back</a></li></ul>";
}
else{
			echo "<br><br><h1>Change Profile</h1>";
			echo "<ul class='sidemenu'>";
	echo "<li><a href='index.php?prof=1'>Change Profile</a></li></ul>";
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
<input type="hidden" name="rollno" value="<?php echo $roll?>">
</form>
			</div>
					
		</div>	
	
		<div id="main">		
		
			<div class="post"><br><br>
<?php
$message=$_GET['msg'];
if($message==1){
	echo "<p><font size=3px color='red'>";
	echo "<center>Profile Successfully updated</center>";
	echo "</font></p>";
}
else if($message==2){
	echo "<p><font size=3px color='red'>";
	echo "<center>Room No entered is not correct</center>";
	echo "</font></p>";
}
else if($message==3){
	echo "<p><font size=3px color='red'>";
	echo "<center>Phone No entered is not correct</center>";
	echo "</font></p>";
}
else if($message==4){
	echo "<p><font size=3px color='red'>";
	echo "<center>Email Id is not valid</center>";
	echo "</font></p>";
}

else if($message==5){
	echo "<p><font size=3px color='red'>";
	echo "<center>Name is not valid</center>";
	echo "</font></p>";
}

if(isset($_GET['search'])){
	$from=$_SESSION['fromdate'];
	$to=$_SESSION['todate'];
	$select=$_SESSION['select'];
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
	echo "<br><br><br>";
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

// Courier Between dates for only that particular user
/*
   $num1=0;
   $num2=0;
   $no=0;
   $i=0;
   $today=date('Y-m-d');
   $q1=mysql_query("SELECT * from Courier_Info where ((matched='$roll' or (matched=0 and room='$room') or (student_name='$name' and room='$room' and matched=2 and overlap=0) or (matched=1 and student_name='$name' and overlap=0) or (matched=1 and student_name='$name' and overlap=1)) and date>='$from' and date<='$to') ORDER BY courier_id");
   $num1=mysql_num_rows($q1);
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
   $count_taken=0;
   $change=0;
   while($row = mysql_fetch_array($q1)){
   $take=$row['taken'];
   $flag2=0;
   if($select==1){
   $flag2=1;
   }
   else if($select==2 and $take==1){
   $flag2=1;
   }
   else if($select==3 and $take==0){
   $flag2=1;
   }
   if($flag2==1){
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

}
echo "</table><br>";
echo "<br><br><br><br><p><code>";
echo "Total Courier : ".$num1;
echo "<br>";
echo "Couriers Taken : ".$count_taken;
echo "<br>";
echo "Couriers yet not taken : ".($num1-$count_taken);
echo "</code></p>";	
*/	
}

else if($prof==1){
	echo "<p><font size=4px><b><u>YOUR PROFILE</u> : </b></font></P>";
	$query1="select * from Student where roll_no='$roll'";
	$result1=mysql_query($query1);
	$array1 = mysql_fetch_array($result1);
	$name=$array1['name'];
	$room=$array1['room_no'];
	$phone=$array1['phone'];
	$otherid=$array1['otheremail'];
	list($hostel,$room_no)=split('-',$room);
	if($room_no!="" and isset($_GET['auth'])){
		$_SESSION['student'];
		header("Location:index.php");
	}
	$user=$array1['username'];

	echo "<center><form action='profile.php' method='post' name='test'>";
	echo "<table id='notab'>";
	echo "<tr>";
	echo "<td>";
	echo "<font color='red'>*</font> NAME :";
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='name' value='$name'>";
	echo "<br>";
	echo "</td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>";
	echo "<font color='red'>*</font> ROLL NO. :";
	echo "</td>";
	echo "<td><input type='text' name='roll' value='$roll' readonly><br>";
	echo "</td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>";
	echo "<font color='red'>*</font> USERNAME :"; 
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='user' value='$user' readonly><br>";
	echo "</td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>";
	echo "ALTERNATE ID :";
	echo "</td>";
	echo "<td><input type='text' name='otherid' value='$otherid'><br>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<font color='red'>*</font> HOSTEL :"; 
	echo "</td>";
	echo "<td>";
	echo "<select name='hostel' value='$hostel'>";
	echo "<option value='$hostel'>$hostel</option>";
	if($hostel!="OBH"){echo "<option value='OBH'>OBH</option>";}
	if($hostel!="OBHD"){echo "<option value='OBHD'>OBHD</option>";}
	if($hostel!="OBHE"){echo "<option value='OBHE'>OBHE</option>";}
	if($hostel!="NBH"){echo "<option value='NBH'>NBH</option>";}
	if($hostel!="BAKUL"){echo "<option value='BAKUL'>BAKUL</option>";}
	if($hostel!="GH"){echo "<option value='GH'>GH</option>";}
	if($hostel!="GHEB"){echo "<option value='GHEB'>GHEB</option>";}
	if($hostel!="NBH Cellar"){echo "<option value='NBH Cellar'>NBH Cellar</option>";}
	echo "</SELECT>";
	echo "</td><br>";
	echo "</tr>";
	echo "<tr><td><font color='red'>*</font> ROOM NO. : </td><td>";
	echo "<input type='text' name='room_no' value='$room_no'><br>";
	echo "</td></tr><tr><td>PHONE NO. :</td><td>";
	echo "<input type='text' name='phone' value='$phone'><br>";
	echo "</td></tr></table>";
	echo "<input type='Submit'>";
	echo "</form></center><br>";
}

else{


	echo "<p><font size=4px><b><u>RECENT COURIERS</u> : </b></font><br></P>";

	$num1=0;
	$num2=0;
	$no=0;
/*	$i=0;
	$partialname=split(" ",$name);
	$check_partial_name="";
	$len=count($partialname);
	$i=0;
	foreach($partialname as $par){
		$check_partial_name=$check_partial_name." student_name LIKE '%".$par." %' ";
		$i=$i+1;
		if($i!=$len){
			$check_partial_name=$check_partial_name." or ";
		}
	}
	*/
//	$q1=mysql_query("SELECT * from Courier_Info where matched='$roll' or (matched=0 and room='$room') or ((".$check_partial_name.") and room='$room' and matched=2 and overlap=0) or ((".$check_partial_name.") and overlap=0 and matched=1) or (matched=1 and student_name='$name' and overlap=1)  ORDER BY courier_id");
	$q1=mysql_query("SELECT * from Courier_Info where (overlap=0 and matched='$roll') or (overlap=1 and ((matched=1 and student_name='$name') or (matched=0 and (student_name='$name' or room='$room')))) ORDER BY courier_id");
	$num1=mysql_num_rows($q1);
	$count_taken=0;
	$change=0;
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
	while($row = mysql_fetch_array($q1)){
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
	echo "</table>";
	echo "<br><br><br><br><br><p><code>";
	echo "Total Courier : ".$num1;
	echo "<br>";
	echo "Couriers Taken : ".$count_taken;
	echo "<br>";
	echo "Couriers yet not taken : ".($num1-$count_taken);
	echo "</p></code>";
}
mysql_close();
?>
</div>
</div>
<!-- footer starts here -->
<div id="footer"><div id="footer-content">
<br><br>
<p><center>© Copyright by IIIT-Hyderabad | Design by Nitesh Surtani
</center></p>
</div>
</div>
</div>
<!-- footer ends here -->

<!-- wrap ends here -->

</body>
</html>
