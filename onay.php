<?php ob_start(); ?> 
<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(isset($_SESSION['kod'])&&isset($_SESSION['girdi']))
	{
		if($_SESSION['kod']==$_SESSION['girdi'])
		{
		include('dbbaglanti.php');
		mysqli_query($baglan,"INSERT INTO `kullanici`(`kullanici-adi`, `sifre`, `eposta`, `ad`, `soyad`) VALUES ('".$_SESSION['kullaniciAdi']."','".$_SESSION['sifre']."','".$_SESSION['eposta']."','".$_SESSION['ad']."','".$_SESSION['soyad']."')");		
		include("cikis.php");
		header('location:giris.php');
		}
		else
		{
		include("cikis.php?sifirla");
		header('location:kaydol.php?msg=hata');
		}
	}
	else
	{
		include("cikis.php?sifirla");
		header('location:kaydol.php?msg=hata');
	}
?><?php ob_end_flush(); ?> 