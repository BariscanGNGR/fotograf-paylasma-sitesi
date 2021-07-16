<?php ob_start(); ?> 
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="icon.png">
     <!--meta http-equiv="refresh" content="9000;url=otomatikcikis.php" /-->
    <title>BB Photography</title>

    <!-- Bootstrap core CSS -->
    <link href="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/holder.min.js"></script>
	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
	  <script src="http://bariscangungor.com.tr/webprojesi/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://bariscangungor.com.tr/webprojesi/anaekran.css" rel="stylesheet">
  </head>

  <body>
			<?php
	  if(!isset($_SESSION)) 
      { 
        session_start(); 
      } 
	  $GLOBALS['yazdir']="";
	  
	  //echo $_SESSION['kullaniciAdi'];
	  if(isset($_SESSION['kullaniciAdi']) && isset($_SESSION['sifre']))
	  {
		  $kullaniciAdi = $_SESSION['kullaniciAdi'];
		  $sifre = $_SESSION['sifre'];
		  include("girisislemleri.php");
		  if($satirSayi > 0 && $satir['sifre']==$sifre && strtolower( $satir['kullanici-adi'] )== strtolower($kullaniciAdi))
		  {
			  //header("location:anaekran.php");
			  //$GLOBALS["msg"]="Başarılı";
			  //buraya devam
			  
			  include('dbbaglanti.php');
			  
			  function zamanHesapla($time)
			  {
				$now = strtotime(date('Y-m-d h:i:sa'));
				$fark = $now - $time;
				$days = floor($fark / (60 * 60 * 24));
				$remainder = $fark % (60 * 60 * 24);
				$hours = floor($remainder / (60 * 60));
				$remainder = $remainder % (60 * 60);
				$minutes = floor($remainder / 60);
			    $seconds = $remainder % 60;
					if($days > 0)
					return $days.' gün önce';
					elseif($days == 0 && $hours == 0 && $minutes == 0)
					return "Birkaç saniye önce";		
					elseif($days == 0 && $hours == 0)
					return $minutes.' dakika önce';
				    elseif($days == 0)
					return $hours.' saat önce';
				  	else
					 return $hours;
			  }
			  
			  function get_kullaniciadi($kullaniciid)
			  {
				  include('dbbaglanti.php');
				  $sorgu3=mysqli_query($baglan,"SELECT * FROM `kullanici` WHERE `id`='".$kullaniciid."'") or die (mysqli_error($baglan));
				  $satirSayi3=mysqli_num_rows($sorgu3);
				  $satir3=mysqli_fetch_array($sorgu3);
				  return $satir3['kullanici-adi'];
			  }
			  
			  function get_kullaniciid($kullaniciAdi)
			  {
				  include('dbbaglanti.php');
				  $sorgu4=mysqli_query($baglan,"SELECT * FROM `kullanici` WHERE `kullanici-adi`='".$kullaniciAdi."'") or die (mysqli_error($baglan));
				  $satirSayi4=mysqli_num_rows($sorgu4);
				  $satir4=mysqli_fetch_array($sorgu4);
				  return $satir4['id'];
			  }
			  
			  function begeniSorgula($fotoid,$kullaniciid)
			  {
				  include('dbbaglanti.php');
				  $sorgu5=mysqli_query($baglan,"SELECT * FROM `begeni` WHERE `foto-id`='".$fotoid."' AND `kullanici-id`='".$kullaniciid."'") or die (mysqli_error($baglan));
				  $satirSayi5=mysqli_num_rows($sorgu5);
				  $satir5=mysqli_fetch_array($sorgu5);
				  if($satirSayi5 > 0)
					  return '-danger';
				  else
					  return '-secondary';
			  }
			  
			  	 function sorgula($sorgusql)
				 {
					 $kullaniciAdi = $_SESSION['kullaniciAdi'];
		  		include('dbbaglanti.php');
		 	    $sorgu=mysqli_query($baglan,$sorgusql) or die (mysqli_error($baglan));
				$satirSayi=mysqli_num_rows($sorgu);
				$satir=mysqli_fetch_array($sorgu);
				  
				for($i=0 ; $i < $satirSayi  ; $i++)
				{
					$temp='<div class="col-md-4">
               <div class="card mb-4 box-shadow" >
                <img class="card-img-top img-responsive" data-src="holder.js/100px225" src="'.$satir['foto-link'].'" alt="Resim" id="'.$satir['foto-id'].'">
                <div class="card-body">
				<p class="card-title font-weight-bold">'.get_kullaniciadi($satir['kullanici-id']).'</p>
                  <p class="card-text">'.$satir['aciklama'].'</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
					<form action="" method="get">
                      <button type="submit" class="btn btn-sm btn-outline'.begeniSorgula($satir['foto-id'],get_kullaniciid($kullaniciAdi)).'" name="begeni" value="'.$satir['foto-id'].'">Beğen</button>
					  <button type="submit" class="btn btn-sm btn-outline-secondary" name="buyut" value="'.$satir['foto-id'].'">Yorum yap</button>
					 </form>
                    </div>
                    <small class="text-muted">'.strval(zamanHesapla($satir['tarih'])).'</small>
					</div>
						</div>
					</div>
            		</div>';
					$GLOBALS['yazdir'] = $GLOBALS['yazdir'].$temp;
					$satir = mysqli_fetch_assoc($sorgu);
				}
	  	}
			  
			  
			  if(isset($_GET['sirala']))
			  {
				  if($_GET['siralama']=='Tarih Yeniden Eskiye')
				  {
					  sorgula("SELECT * FROM `fotograf` ORDER BY `fotograf`.`foto-id` DESC");
				  }
				  else if($_GET['siralama']=='Tarih Eskiden Yeniye')
				  {
					  sorgula("SELECT * FROM `fotograf` ORDER BY `fotograf`.`foto-id` ASC");
				  }
				  
			  }
			  	else
			  {
				 sorgula("SELECT * FROM `fotograf` ORDER BY `fotograf`.`foto-id` DESC");
			  }
			  if(isset($_GET['begeni']))
				  {
					  $fotoid = $_GET['begeni'];
				      if(begeniSorgula($fotoid,get_kullaniciid($kullaniciAdi)) == '-secondary')
					  {
					  $sorgu=mysqli_query($baglan,"INSERT INTO `begeni`( `kullanici-id`, `foto-id`) VALUES ('".get_kullaniciid($kullaniciAdi)."','".$fotoid."')") or die (mysqli_error($baglan));
					  }
				     else
					 {
						 $sorgu=mysqli_query($baglan,"DELETE FROM `begeni` WHERE `begeni`.`foto-id` = ".$fotoid." AND `begeni`.`kullanici-id`= ". get_kullaniciid($kullaniciAdi));
					 }
				   header('location:anaekran.php#'.$fotoid);
				  }
			  if(isset($_GET['buyut']))
			  {
				header('location:fotograf.php?foto-id='.$_GET['buyut']); 
			  }


			  
		  }
		  else{
			  //$GLOBALS["msg"]="Başarısız";
			  header('location:cikis.php');
			  //include('giris.php');
		  }
	  }
	  else{
		  header('location:cikis.php');
	  }
	  

	  ?>  
	  
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Hakkında</h4>
              <p class="text-muted">TEST</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">İletişim</h4>
              <ul class="list-unstyled">
                <li><a href="https://www.instagram.com/bariscangngr" class="text-white">Barışcan Güngör</a></li>
                <li><a href="https://www.instagram.com/bhmberkan" class="text-white">Berkan Burak Turgut</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
		<div class="d-flex justify-content-start">
          <a href="anaekran.php" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>BB Photography</strong>
          </a>
			</div>
		  <div class="d-flex justify-content-end">
		  <a class="btn btn-danger mr-2" href="cikis.php" >
		  	Çıkış yap
		  </a>
          <button class="navbar-toggler ml-0" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
		</div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Fotoğraflar</h1>
          <p class="lead text-muted">Sizin fotoğraflarınızı sizin adınıza yayınlıyoruz.</p>
          <p>
            <a href="fotografekle.php" class="btn btn-primary my-2">Fotoğraf yayınla</a>
            <a href="profilim.php" class="btn btn-secondary my-2">Profilim</a>
          </p>
        </div>
		  
		 <div class="container mt-5 mb-0 "style="max-width: 300px;" >
		 	<form class="form-control justify-content-center"  action="" method="get">
			 	<label for="list" class="sr-only">Sıralama ölçütü</label>
				<select list="siralama" class="form-control" name="siralama" id="list">
					<option>Tarih Yeniden Eskiye</option>
					<option>Tarih Eskiden Yeniye</option>
				</select>
				<label for="submit" class="sr-only" >Sırala</label>
				<input type="submit" class="btn btn-sm btn-secondary btn-block mt3" name="sirala">
			</form> 	
		 </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container mt-0">

          <div class="row">
			 
			<?php echo $GLOBALS['yazdir']; ?>  		
			
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Üste Çık</a>
        </p>
        <p>BB Photography &copy; 2021</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="/bootstrap-4.0.0/assets/js/vendor/popper.min.js"></script>
    <script src="/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="/bootstrap-4.0.0/assets/js/vendor/holder.min.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>
