<?php

 rename ("api/change_ads/manual.php", "api/blocked.php");
 copy ("change_banner/manual.php", "ads.php");
 copy ("api/blocked.php","api/change_ads/manual.php");
 
 session_start();

if (isset($_SESSION['id'])) {
	header("Location: ads.php");
}else{
	header("Location: login.php");
}

 
?>