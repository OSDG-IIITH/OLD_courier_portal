<?php

$username="courier";
$password="################";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");


// DON'T DELETE THIS.....This script will extract tuples from the previous database and WRITE IT INTO FILE TEXT4.PHP.

// Extracting all the tuples from account tables which doesn't has a primary key.
/*
$myfile = 'test4.txt';
$f1 = fopen($myfile,'w');    
$result=mysql_query("select * from account ORDER BY rollno");
$temp=-1;
while($row = mysql_fetch_array($result)){
	
	$roll=$row['rollno'];
	if($roll!=$temp){
	$name=$row['name'];
	$hos=strtoupper($row['hostel']);
	if($hos=="OBHEB"){
		$hos="OBHE";
	}
	else if($hos=="OBHDB"){
		$hos="OBHD";
	}
	
	$room=$hos."-".$row['roomno'];
	$email=$row['email'];
	$query = "insert into Student values ('$roll','$name','$email','$room','')";
	echo $query ;
	fwrite($f1, $query."\n");
//	mysql_query($query) or die ( "not inserted\n");
	$count=$count+1;
	$temp=$roll;
	}
}
echo "count= ".$count;
fclose($f1);


*/

// READING FROM TEST4.PHP AND INSERTING IT INTO THE DATABASE ( STUDENT TABLE )
/*
$myfile = 'test4.txt'; // test4.txt contains the list of the students.

$lines = file($myfile);    
for($i=count($lines)-1;$i>=0;$i--){
    echo $lines[$i];
    $arr=split(",",$lines[$i]);
    // Removing the Room No. from the tuple.
	$line=$arr[0].",".$arr[1].",".$arr[2].",".$arr[4]."\n";
	echo $line;
    mysql_query($line) or die("not inserted");
}
fclose($myfile);
*/

// READING FROM person_22_02-2011.txt (new database file)  AND INSERTING IT INTO THE DATABASE ( STUDENT TABLE )

$myfile = 'person_22_02-2011.txt'; // test4.txt contains the list of the students.

$lines = file($myfile);    
$prof = 'professor.txt';    // This file contains the professor details who don't have any roll no. We have not yet figured out what to do for this.
$f1 = fopen($prof,'w');    
for($i=0;$i<count($lines);$i++){
	if(strlen($lines[$i])>3){   // Check that line is not empty and has atleast 3 commas.
		$arr=split(",",$lines[$i]);
		$len=count($arr);
		if($len==4){	
			if(strlen($arr[1]>8)){	// This is a student.
				$line = "insert into Student values ('". $arr[1]."','".strtolower($arr[0])."','".$arr[2]."','','','')\n";
				echo $line;
				mysql_query($line) or die("not inserted");
				// Here are some students whose id's are not present..For now, removed them from mysql command line as this situation shouldn't have existed in the data file.
			}
			else{	// This is a professor ( with no roll_no )
				fwrite($f1, $lines[$i]);
			}
		}
	}
}
fclose($myfile);
fclose($prof);
mysql_close();
?>
