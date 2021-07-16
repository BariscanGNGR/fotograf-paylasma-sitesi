<?php ob_start(); ?> 
<?php
	
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
/*$_SESSION['kullaniciAdi']="bariscan1";
$_SESSION['sifre']='1234';
$_SESSION['eposta']='brsgng@gmail.com';
$_SESSION['ad']='bar';
$_SESSION['soyad']='gun';*/

$GLOBALS['msg']='';

/*$kullaniciAdi=$_SESSION['kullaniciAdi'];
$sifre=$_SESSION['sifre'];
$eposta=$_SESSION['eposta'];
$ad=$_SESSION['ad'];
$soyad=$_SESSION['soyad'];*/
$eposta=$_SESSION['eposta'];
//include("cikis.php");
$random;
if(isset($_SESSION['kaydol']))
{
	
if(!isset($_SESSION['kod']))
{
	$random = strval(rand(100000,999999));
	$_SESSION['kod'] = $random;
}
include('mail.php');
epostaGonder($eposta,"Fotoğraf Paylaşma Sitesi Üyelik Doğrulama","Doğrulama kodunuz :".$_SESSION['kod']);

if(isset($_POST['kaydol']))
{
	$girdi = strval($_POST['bir']."".$_POST['iki']."".$_POST['uc']."".$_POST['dort']."".$_POST['bes']."".$_POST['alti']);
	$_SESSION['girdi']=$girdi;
	include('onay.php');
}
}
else{
	include('cikis.php');
	unset($_POST);
	header('location.kaydol.php');
}
//include("cikis.php");
//sessionları siler

/*
mysqli_query($baglan,"INSERT INTO `kullanici`(`kullanici-adi`, `sifre`, `eposta`, `ad`, `soyad`) VALUES ('$kullaniciAdi','$sifre','$eposta','$ad','$soyad')");
*/

?>

<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icon.png">
<meta http-equiv="refresh" content="900;url=otomatikcikis.php" />
    <title>BB Photography</title>

    <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="giris.css?v=1" rel="stylesheet">
	 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	  	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/holder.min.js"></script>
	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  </head>

  <body class="text-center"> 
	  
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">E-Postana giden doğrulama kodunu buraya gir</h1>
    <div class="input-group">
		<input type="text" size="1" maxlength="1" name="bir" class="form-control" placeholder="" required>
      	<input type="text" size="1" maxlength="1" name="iki" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="uc" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="dort" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="bes" class="form-control" placeholder="" required>
		<input type="text" size="1" maxlength="1" name="alti" class="form-control" placeholder="" required>
	</div>  
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="kaydol" value="ok">Onayla</button>
	  <button class="btn btn-sm btn-secondary btn-block mt-2" type="reset" name="reset" value="res">Kutucukları sil</button>
	  <p class="mt-4 mb-2 text-danger"> <?php echo $GLOBALS["msg"]; ?></p>
      <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
    </form>
	  <script>
		  $(".form-control").keyup(function () {
    	  if (this.value.length == this.maxLength) {
      	  $(this).next('.form-control').focus();
    	     }
		  });
</script>
	  
  </body>
</html><?php ob_end_flush(); ?> 