<?php
session_start();
if(isset($_SESSION['logged2'])){
	unset($_SESSION['logged2']); 
}
header("Location:main1.php");	
?>
