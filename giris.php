<?php ob_start(); ?> 
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icon.png">
	<!--meta http-equiv="refresh" content="900;url=otomatikcikis.php" /-->
    <title>BB Photography</title>

    <link href="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="http://bariscangungor.com.tr/webprojesi/giris.css?v=1" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>

  <body class="text-center">
	  <?php	  
	  $GLOBALS["msg"]="";
	  //include("cikis.php");
	  
	  if(!isset($_SESSION)) 
      { 
        session_start(); 
      } 
	  
	  //echo $_SESSION['kullaniciAdi'];
	  if(isset($_SESSION['kullaniciAdi']) && isset($_SESSION['sifre']))
	  {
		  $kullaniciAdi = $_SESSION['kullaniciAdi'];
		  $sifre = $_SESSION['sifre']; 
		  include("girisislemleri.php");
		  if($satirSayi > 0 && $satir['sifre']==$sifre && strtolower( $satir['kullanici-adi'] )== strtolower($kullaniciAdi))
		  {
			  header("location:anaekran.php");
			  //$GLOBALS["msg"]="Başarılı";
		  }
		  else{
			  //$GLOBALS["msg"]="Başarısız";
			  include('cikis.php');
			  //include('giris.php');
		  }
	  }
	  else
	  {
	  	if( isset($_POST["btn"]) )
	  	{
			$kullaniciAdi = htmlspecialchars($_POST['kullanici']);
			$sifre = htmlspecialchars($_POST['sifre']);
			include("girisislemleri.php");
			//echo $satirSayi ." ".$satir['sifre']." ".$sifre." ".strtolower($satir['kullanici-adi']) ." ". strtolower($kullaniciAdi);
			if($satirSayi > 0 && $satir['sifre']==$sifre && strtolower($satir['kullanici-adi']) == strtolower($kullaniciAdi))
			{
				$_SESSION['kullaniciAdi']=$satir['kullanici-adi'];
				$_SESSION['sifre']=$satir['sifre'];
				$GLOBALS["msg"]="Başarılı";
				//anasayfa go prr
				header("location:anaekran.php");
			}
			else
			{
				$GLOBALS["msg"]= "Giriş Başarısız";
			}
		}
	  }
	  /*if(isset($_POST["kaydol"]))
	  {
		  include("girisislemleri.php");
		  if(!($satirSayi > 0 && $satir['sifre']==$sifre && $satir['kullanici-adi'] = strtolower($kullaniciAdi)))
		  {
			  mysqli_query($baglan,"INSERT INTO `kullanici`(`kullanici-adi`, `sifre`) VALUES ('$kullaniciAdi','$sifre')");
			  $GLOBALS["msg"] = "Kaydolma başarılı giriş yapınız.";
		  }
	  }*/
	  ?>
	  
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Giriş Yapınız</h1>
      <label for="KullaniciGiris" class="sr-only">Kullanıcı Adı</label>
      <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="btn" value="ok">Giriş Yap</button>
	  <button class="btn btn-sm btn-secondary btn-block mt3" type="button" name="kaydol" value="kaydol" onClick="gonder()">Kaydol</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["msg"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
    </form>
	  
	  <script>
		  function gonder() {
  			window.location = 'kaydol.php';
		  }
	  </script>
	  
  </body>
</html>
<?php ob_end_flush(); ?> 
