<?php

 rename ("api/change_ads/auto.php", "api/blocked.php");
 copy ("change_banner/auto.php", "ads.php");
  copy ("api/blocked.php", "api/change_ads/auto.php");
 session_start();

if (isset($_SESSION['id'])) {
	header("Location: ads.php");
}else{
	header("Location: login.php");
}

 
?>