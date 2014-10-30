<?php
include_once("CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"/cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
?>
<html>
<head>
<title>Sample Page</title>
</head>
<body>
<?php
if (isset($_REQUEST['logout'])) {
       phpCAS::logout();
}
?>
<center>
<h1>Hello, <?php echo phpCAS::getUser(); ?> !</h1>
</center>
<a href="?logout=">Logout</a>
</body>
</html>
