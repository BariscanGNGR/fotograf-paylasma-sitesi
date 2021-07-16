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
	  	  if(!isset($_SESSION)) 
      	{ 
			  session_start(); 
		  } 
	  $GLOBALS['msg']='';
	  	  if(isset($_SESSION['kullaniciAdi']) && isset($_SESSION['sifre']))
	  {
		  $kullaniciAdi = $_SESSION['kullaniciAdi'];
		  $sifre = $_SESSION['sifre'];
		  include("girisislemleri.php");
		  if($satirSayi > 0 && $satir['sifre']==$sifre && strtolower( $satir['kullanici-adi'] )== strtolower($kullaniciAdi))
		  {
			  //header("location:cikis.php");
			  //header("location:kaydol.php");
			  header('location:giris.php');
			  //$GLOBALS["msg"]="Başarılı";
		  }
		  else{
			  //$GLOBALS["msg"]="Başarısız";
			  include("cikis.php?sifirla");
			  unset($_POST);
			  header("location:kaydol.php");
		  }
	  }
	  else
	  {
	  
	  if(isset($_GET['msg']))
	  {
		  $GLOBALS["msg"]="Doğrulama kodu hatalıdır";
	  }
	  else
	  {
		  $GLOBALS["msg"]="";
	  }
	  
	  include("hatalar.php");
	  $hatalar = new SimpleXMLElement($xml);
	  if(isset($_POST["kaydol"]))
	  {
		  $kullaniciAdi = htmlspecialchars($_POST['kullanici']);
	  	  $sifre = htmlspecialchars($_POST['sifre']);
		  $sifretekrar = htmlspecialchars($_POST['sifretekrar']);
		  $eposta = htmlspecialchars($_POST['email']);
		  $ad = htmlspecialchars($_POST['ad']);
		  $soyad = htmlspecialchars($_POST['soyad']);
		  include("girisislemleri.php");
		  $sorguEposta=mysqli_query($baglan,"SELECT * FROM `kullanici` WHERE `eposta`='$eposta'") or die (mysqli_error($baglan));
		  $satirSayiEposta=mysqli_num_rows($sorguEposta);
		  
		  if(!($satirSayi >0))
		  {
			  /*mysqli_query($baglan,"INSERT INTO `kullanici`(`kullanici-adi`, `sifre`, `eposta`, `ad`, `soyad`) VALUES ('$kullaniciAdi','$sifre','$eposta','$ad','$soyad')");
			  $GLOBALS["msg"] = "Kaydolma başarılı giriş yapınız.";*/
			  if(!$satirSayiEposta > 0)
			  {
			  if(strlen($kullaniciAdi) > 5)
			  {
				  if(strlen($sifre) > 7)
				  {
					  $kucukharf=0;
					  $buyukharf=0;
					  $sayi=0;
					  if($sifre == $sifretekrar)
					  {
						 for($i =0;$i < strlen($sifre);$i++)
						 {
							 $s = substr($sifre,$i,1);
							 if(ctype_upper($s))
								  $buyukharf=1;
							  else if(ctype_lower($s))
								  $kucukharf=1;
							  else if(is_numeric($s))
								  $sayi=1;
					  	  }
					  
					  	if($buyukharf && $kucukharf && $sayi)
						{
							    if(!isset($_SESSION)) 
    							{ 
        						session_start(); 
    							} 
			  				$_SESSION['kullaniciAdi']=$kullaniciAdi;
			  				$_SESSION['sifre']=$sifre;
			  				$_SESSION['eposta']=$eposta;
			  				$_SESSION['ad']=$ad;
			  				$_SESSION['soyad']=$soyad;
							$_SESSION['kaydol']=1;
							header('location:epostaOnay.php');
						}
					  	else
							$GLOBALS['msg'] = $hatalar->kaydol->sifreeksik;
					  }
					  else
						  $GLOBALS['msg'] = $hatalar->kaydol->sifretekrar;
				  }
				  else
					  $GLOBALS['msg'] = $hatalar->kaydol->sifrekisa;
			  }
			  else
				  $GLOBALS['msg'] = $hatalar->kaydol->kullanicikisa;
			  
			  
			  
			  
			  //gonder();
			  }
		  	else
			  	$GLOBALS['msg']=$hatalar->kaydol->epostaMevcut;
		  }
		  else
		     $GLOBALS['msg'] = $hatalar->kaydol->kullanicivar;
		  
	  }
	  }
	  ?>
	  
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Üye Olma Formu</h1>
	  <label for="emailgiris" class="sr-only">E Posta</label>
      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
      <label for="KullaniciGiris" class="sr-only">Kullanıcı Adı</label>
      <input type="text" name="kullanici" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
	  <label for="ad" class="sr-only">Ad</label>
      <input type="text" name="ad" class="form-control" placeholder="Ad" required autofocus>
	  <label for="soyad" class="sr-only">Soyad</label>
      <input type="text" name="soyad" class="form-control" placeholder="Soyad" required autofocus>
      <label for="inputPassword" class="sr-only">Şifre</label>
      <input type="password" name="sifre" class="form-control" placeholder="Şifre" required>
	  <label for="inputPassword2" class="sr-only">Şifre Tekrar</label>
      <input type="password" name="sifretekrar" class="form-control" placeholder="Şifrenizi Tekrar giriniz" required>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="kaydol" value="ok">Kaydol</button>
	  <button class="btn btn-sm btn-secondary btn-block mt3" type="submit" name="btn" value="gonder" onClick="gonder()">Giriş Yap</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["msg"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
    </form>
	  <script>
		  function gonder() {
  			window.location = 'giris.php';
		  }
	  </script>
	  
  </body>
</html><?php ob_end_flush(); ?> 
