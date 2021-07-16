<?php ob_start(); ?> 
<?php
		include('dbbaglanti.php');
		$sorgu=mysqli_query($baglan,"SELECT * FROM `kullanici` WHERE `kullanici-adi`='".$kullaniciAdi."'") or die (mysqli_error($baglan));
		$satirSayi=mysqli_num_rows($sorgu);
		$satir=mysqli_fetch_array($sorgu);
?><?php ob_end_flush(); ?> 