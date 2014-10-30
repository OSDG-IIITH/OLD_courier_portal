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
$password="#################";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");
//$roll=$_GET['roll'];
//$search=$_GET['search'];
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
$res=mysql_query("select * from Student where roll_no=$roll")or die( "can't select");
$val=mysql_fetch_array($res);
$name=$val['name'];
$room=$val['room_no'];

?>
<h2 id='sign'>Signed in as  : <?php echo "<font color='white'>$name</font>" ?></h2>
<!-- wrap starts here -->
<div id="wrap">

	<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="student.php" title="">IIIT COURIER PORTAL<span class="gray"></span></a></h1>	
		<h2 id="slogan">Couriers Made Easy</h2>		
		
		<!-- Menu Tabs -->
		<ul>
		<?php
			echo "<li><a href='student.php' id='current'>Home</a></li>";
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
echo "<li><a href='student.php'>Go Back</a></li></ul>";
}
else{
			echo "<br><br><h1>Change Profile</h1>";
			echo "<ul class='sidemenu'>";
	echo "<li><a href='student.php?prof=1'>Change Profile</a></li></ul>";
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

if(isset($_GET['search'])){

	$from=$_SESSION['fromdate'];
	$to=$_SESSION['todate'];
	$select=$_SESSION['select'];
	/*
	   if(isset($_GET['td'])){
	   echo "<p><font size=4px><b><u>TODAY's COURIERS ARE</u> : </b></font><br></P>";
	   }
	 */
	if($select==1){
		echo "<p><font size=3px><b><u>COURIERS BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></p>";
	}
	else if($select==2){
		//		$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=1 and student_name='$name'";
		echo "<p><font size=3px><b><u>COURIERS TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> : </b></font><br></p>";
	}
	else if($select==3){
		//		$query = "select * from Courier_Info where date>='$from' and date<='$to' and taken=0 and student_name='$name'";
		echo "<p><font size=3px><b><u>COURIERS NOT TAKEN BETWEEN DATES ".$from." AND ".$to ."</u> :</b></font><br></p>";
	}
	$flag1=0;
	$num1=0;
	$num2=0;
	$no=0;
	$i=0;
	$today=date('Y-m-d');
	/*	if(isset($_GET['td'])){
		$today=date('Y-m-d');
		echo $today;
		$q1=mysql_query("select * from Courier_Info where date='$today' ORDER BY courier_id");
		}*/
	//else{
	$q1=mysql_query("SELECT * from Courier_Info where (((matched='$roll') or (matched=0 and room='$room') or (student_name='$name' and room='$room')) and date>='$from' and date<='$to')  ORDER BY courier_id");
	$num1=mysql_num_rows($q1);
	$q2=mysql_query("select * from Courier_Info where (overlap=1 and student_name='$name' and room!='$room' and date>='$from' and date<='$to') ORDER BY courier_id");
	if(mysql_num_rows($q2)==0){
		$flag1=0;
	}
	else{
		$result1=mysql_query("SELECT * from Student where (student_name='$name')");
		$arr=array();
		$i=0;
		while($row = mysql_fetch_array($result1)){
			$std[$i]=$row['room_no'];
			$i=$i+1;
		}
		$n=$i;
		$i=0;
		$count=0;
		while($row = mysql_fetch_array($q1)){
			$a[$i]=$row;
			$i=$i+1;
		}
		$n1=$i;
		while($row = mysql_fetch_array($q2)){
			$flag=0;
			for($i=0;$i<$n;$i++){
				if($row['room']==$std['room']){
					$flag=1;
					break;
				}
			}
			if($flag==0){
				$b[$count]=$row;
				$count=$count+1;
			}
		}
		$n2=$count;
		if($count==0){
			$flag1=0;
		}
		else{
			$flag1=1;
			for($i=0;$i<$n1;$i++){
				$c[$i]=$a[$i];
			}
			for($i=0;$i<$n2;$i++){
				$c[$i+$n1]=$b[$i];
			}
			$no=$n1+$n2;
			for($i=0;$i<$no;$i++){
				$flag=0;
				for($j=0;$j<$no;$j++){
					if($c[$j]['cid']>$c[$j]['cid']){
						$temp=$c[$j];
						$c[$j]=$c[$j+1];
						$c[$j+1]=$temp;
						$flag=1;
					}
				}
				if($flag==0)break;
			}
		}
	}
	if($flag1==0){
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
		//	$quer1=mysql_query("SELECT * from Courier_Info where matched='$roll' or (matched=0 and room='$room') or (overlap=0 and student_name='$name') or (overlap=1 and student_name='$name' and room='$room') and taken=1");
		//	$num2=mysql_num_rows($quer1);
		echo "<br><br><br><br><p><code>";
		echo "Total Courier : ".$num1;
		echo "<br>";
		echo "Couriers Taken : ".$count_taken;
		echo "<br>";
		echo "Couriers yet not taken : ".($num1-$count_taken);
		echo "</code></p>";	

	}	
	else if($flag1==1){
		$count_taken=0;
		echo "<table>";
		echo "<tr>";
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
		for($i=0;$i<$no;$i++){
			$take=$c[$i]['taken'];
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

				$Room=$c[$i]['room'];
				list($hostel,$room)=split('-',$Room);
				if($change==0){
					echo "<tr class='row-a'>";
					echo "<td>".$c[$i]['courier_id']."</td>";
					echo "<td>".$c[$i]['student_name']."</td>";
					echo "<td>".$hostel."</td>";
					echo "<td>".$room."</td>";
					echo "<td>".$c[$i]['courier_type']."</td>";
					echo "<td>".$c[$i]['date']."</td>";
					echo "<td>".$c[$i]['sender_add']."</td>";
					if($c[$i]['taken']==1){
						$received="yes";
						$count_taken=$count_taken+1;
					}
					else if($c[$i]['taken']==0){
						$received="no";
					}
					echo "<td>".$received."</td>";
					echo "</tr>";
					$change=1;
				}
				else if($change==1){
					echo "<tr class='row-b'>";
					echo "<td>".$c[$i]['courier_id']."</td>";
					echo "<td>".$c[$i]['student_name']."</td>";
					echo "<td>".$hostel."</td>";
					echo "<td>".$room."</td>";
					echo "<td>".$c[$i]['courier_type']."</td>";
					echo "<td>".$c[$i]['date']."</td>";
					echo "<td>".$c[$i]['sender_add']."</td>";
					if($c[$i]['taken']==1){
						$received="yes";
						$count_taken=$count_taken+1;
					}
					else if($c[$i]['taken']==0){
						$received="no";
					}
					echo "<td>".$received."</td>";
					echo "</tr>";
					$change=0;
				}
			}
		}
		echo "<br><br><br><br><br><p><code>";
		echo "Total Courier : ".$no;
		echo "<br>";
		echo "Couriers Taken : ".$count_taken;
		echo "<br>";
		echo "Couriers yet not taken : ".($no-$count_taken);
		echo "</p></code>";
	}
}

else if($prof==1){
	echo "<p><font size=4px><b><u>YOUR PROFILE</u> : </b></font></P>";
	$query1="select * from Student where roll_no='$roll'";
	$result1=mysql_query($query1);
	$array1 = mysql_fetch_array($result1);
	$name=$array1['name'];
	$room=$array1['room_no'];
	$phone=$array1['phone'];
	list($hostel,$room_no)=split('-',$room);
	if($room_no!="" and isset($_GET['auth'])){
		$_SESSION['student'];
		header("Location:student.php");
	}
	$user=$array1['username'];

	echo "<center><form action='profile.php' method='post' name='test'>";
	echo "<table id='notab'>";
	echo "<tr>";
	echo "<td>";
	echo "NAME :";
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='name' value='$name'>";
	echo "<br>";
	echo "</td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>";
	echo "ROLL NO. :";
	echo "</td>";
	echo "<td><input type='text' name='roll' value='$roll' readonly><br>";
	echo "</td>";
	echo "</tr>";
	echo "<br>";
	echo "<tr>";
	echo "<td>";
	echo "USERNAME :"; 
	echo "</td>";
	echo "<td>";
	echo "<input type='text' name='user' value='$user' readonly><br>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "HOSTEL :"; 
	echo "</td>";
	echo "<td>";
	echo "<select name='hostel' value='$hostel'>";
	echo "<option value='$hostel'>$hostel</option>";
	if($hostel!="OBH"){echo "<option value='OBH'>OBH</option>";}
	if($hostel!="OBHD"){echo "<option value='OBHD'>OBHD</option>";}
	if($hostel!="OBHE"){echo "<option value='OBHE'>OBHE</option>";}
	if($hostel!="NBH"){echo "<option value='NBH'>NBH</option>";}
	if($hostel!="GH"){echo "<option value='GH'>GH</option>";}
	if($hostel!="NBH Cellar"){echo "<option value='NBH Cellar'>NBH Cellar</option>";}
	echo "</SELECT>";
	echo "</td><br>";
	echo "</tr>";
	echo "<tr><td>ROOM NO. : </td><td>";
	echo "<input type='text' name='room_no' value='$room_no'><br>";
	echo "</td></tr><tr><td>PHONE NO. :</td><td>";
	echo "<input type='text' name='phone' value='$phone'><br>";
	echo "</td></tr></table>";
	echo "<input type='Submit'>";
	echo "</form></center><br>";
}

else{


	echo "<p><font size=4px><b><u>RECENT COURIERS</u> : </b></font><br></P>";

	//$q1=mysql_query("SELECT * from Courier_Info where matched='$roll' or (matched=0 and room='$room') or (overlap=0 and student_name='$name') or (overlap=1 and student_name='$name' and room='$room') ");
	$flag1=0;
	$num1=0;
	$num2=0;
	$no=0;
	$i=0;

	$q1=mysql_query("SELECT * from Courier_Info where matched='$roll' or (matched=0 and room='$room') or (student_name='$name' and room='$room')  ORDER BY courier_id");
	$num1=mysql_num_rows($q1);
	$q2=mysql_query("select * from Courier_Info where (overlap=1 and student_name='$name' and room!='$room') ORDER BY courier_id");
	if(mysql_num_rows($q2)==0){
		$flag1=0;
	}
	else{
		$result1=mysql_query("SELECT * from Student where (student_name='$name')");
		$arr=array();
		$i=0;
		while($row = mysql_fetch_array($result1)){
			$std[$i]=$row['room_no'];
			$i=$i+1;
		}
		$n=$i;
		$i=0;
		$count=0;
		while($row = mysql_fetch_array($q1)){
			$a[$i]=$row;
			$i=$i+1;
		}
		$n1=$i;
		while($row = mysql_fetch_array($q2)){
			$flag=0;
			for($i=0;$i<$n;$i++){
				if($row['room']==$std['room']){
					$flag=1;
					break;
				}
			}
			if($flag==0){
				$b[$count]=$row;
				$count=$count+1;
			}
		}
		$n2=$count;
		if($count==0){
			$flag1=0;
		}
		else{
			$flag1=1;
			for($i=0;$i<$n1;$i++){
				$c[$i]=$a[$i];
			}
			for($i=0;$i<$n2;$i++){
				$c[$i+$n1]=$b[$i];
			}
			$no=$n1+$n2;
			for($i=0;$i<$no;$i++){
				$flag=0;
				for($j=0;$j<$no;$j++){
					if($c[$j]['cid']>$c[$j]['cid']){
						$temp=$c[$j];
						$c[$j]=$c[$j+1];
						$c[$j+1]=$temp;
						$flag=1;
					}
				}
				if($flag==0)break;
			}
		}
	}
	if($flag1==0){
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
		//	$quer1=mysql_query("SELECT * from Courier_Info where matched='$roll' or (matched=0 and room='$room') or (overlap=0 and student_name='$name') or (overlap=1 and student_name='$name' and room='$room') and taken=1");
		//	$num2=mysql_num_rows($quer1);
		echo "<br><br><br><br><br><p><code>";
		echo "Total Courier : ".$num1;
		echo "<br>";
		echo "Couriers Taken : ".$count_taken;
		echo "<br>";
		echo "Couriers yet not taken : ".($num1-$count_taken);
		echo "</p></code>";

	}	
	else if($flag1==1){
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
		for($i=0;$i<$no;$i++){
			$Room=$c[$i]['room'];
			list($hostel,$room)=split('-',$Room);
			if($change==0){
				echo "<tr class='row-a'>";
				echo "<td>".$c[$i]['courier_id']."</td>";
				echo "<td>".$c[$i]['student_name']."</td>";
				echo "<td>".$hostel."</td>";
				echo "<td>".$room."</td>";
				echo "<td>".$c[$i]['courier_type']."</td>";
				echo "<td>".$c[$i]['date']."</td>";
				echo "<td>".$c[$i]['sender_add']."</td>";
				if($c[$i]['taken']==1){
					$received="yes";
					$count_taken=$count_taken+1;
				}
				else if($c[$i]['taken']==0){
					$received="no";
				}
				echo "<td>".$received."</td>";
				echo "</tr>";
				$change=1;
			}
			else if($change==1){
				echo "<tr class='row-b'>";
				echo "<td>".$c[$i]['courier_id']."</td>";
				echo "<td>".$c[$i]['student_name']."</td>";
				echo "<td>".$hostel."</td>";
				echo "<td>".$room."</td>";
				echo "<td>".$c[$i]['courier_type']."</td>";
				echo "<td>".$c[$i]['date']."</td>";
				echo "<td>".$c[$i]['sender_add']."</td>";
				if($c[$i]['taken']==1){
					$received="yes";
					$count_taken=$count_taken+1;
				}
				else if($c[$i]['taken']==0){
					$received="no";
				}
				echo "<td>".$received."</td>";
				echo "</tr>";
				$change=0;
			}
		}
		echo "</table>";
		echo "<br><br><br><br><br><p><code>";
		echo "Total Courier : ".$no;
		echo "<br>";
		echo "Couriers Taken : ".$count_taken;
		echo "<br>";
		echo "Couriers yet not taken : ".($no-$count_taken);
		echo "</p></code>";

	}
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
