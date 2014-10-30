<?php
session_start();
if(isset($_SESSION['logged1'])){
	unset($_SESSION['logged1']); 
}
header("Location:main1.php");	
?>
