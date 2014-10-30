<?php

$username="courier";
$password="###############";
$database="courier";
mysql_connect(localhost,$username,$password) or die("unable to connect");


@mysql_select_db($database) or die( "Unable to select database\n");


// READING FROM TEST4.PHP AND INSERTING IT INTO THE DATABASE ( STUDENT TABLE )
$myfile = 'list.txt'; // test4.txt contains the list of the students.

$lines = file($myfile);    
for($i=count($lines)-1;$i>=0;$i--){
    $line=trim($lines[$i]);
	$arr=split("\t",$line);
	$line = "insert into Student (roll_no,name,username) values ('". $arr[1]."','".strtolower($arr[0])."','".$arr[2]."');\n";
	echo $line;
	mysql_query($line) or die("not inserted");
	// Here are some students whose id's are not present..For now, removed them from mysql command line as this situation shouldn't have existed in the data file.
//	echo $line;
//	mysql_query($line) or die("not inserted");
}
/*
fclose($myfile);

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
*/
mysql_close();
?>
