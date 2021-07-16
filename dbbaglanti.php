<?php
	$baglan = mysqli_connect("localhost","bariscan_fotograf-sitesi","Test123") or die("bağlantı hatası");
	mysqli_select_db($baglan,"bariscan_fotograf-sitesi");
	$baglan->set_charset("utf8");
?>
