<?php ob_start(); ?> 
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
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
	  $GLOBALS['msg']='';
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
			  
			  if(isset($_POST['yukle']))
			  {
				  //$_FILES['resim'] = $_POST['dosya'];
				  $aciklama =htmlspecialchars($_POST['aciklama']);
				  
				  $maxBoyut = 10485760;
				  $uzanti = $_FILES['resim']['type'];
				  
				  include('hatalar.php');
				  $hatalar = new SimpleXMLElement($xml);
				  if($_FILES['resim']['size']<$maxBoyut)
				  {
					  if($_FILES['resim']['type'] == 'image/jpeg' || $_FILES['resim']['type'] == 'image/png' || $_FILES['resim']['type'] == 'image/jpg')
					  {
						  include('dbbaglanti.php');
						  $sorgu1=mysqli_query($baglan,"SELECT * FROM `fotograf` ORDER BY `fotograf`.`foto-id` DESC") or die (mysqli_error($baglan));
						  $satirSayi1=mysqli_num_rows($sorgu1);
						  $satir1=mysqli_fetch_array($sorgu1);
						  
						  $dosyaYolu = "resimler/".(number_format($satir1['foto-id']+1)).".".substr($uzanti,6);
						  if(is_uploaded_file($_FILES['resim']['tmp_name']))
						  {
						  if(!is_dir('resimler'))
							  mkdir('resimler',0755);
						  if(move_uploaded_file($_FILES['resim']['tmp_name'],$dosyaYolu))
						  {
							  include('girisislemleri.php');
							  $sorgu1=mysqli_query($baglan,"INSERT INTO `fotograf`(`kullanici-id`, `foto-link`, `aciklama`, `tarih`) VALUES ('".$satir['id']."','$dosyaYolu','$aciklama','".strtotime(date('Y-m-d h:i:sa'))."')") or die (mysqli_error($baglan));
							  
							  $GLOBALS['msg'] = 'Başarılı';
							  header('location:anaekran.php');
						  }
						  else
						  {
							  $GLOBALS['msg'] = $hatalar->fotografEkle->kayitHata;
						  }
						  }
						  else
						  {
							   $GLOBALS['msg'] = $hatalar->fotografEkle->kayitHata;
						  }
					  }
					  else
					  {
						  $GLOBALS['msg'] = $hatalar->fotografEkle->uzanti;
					  }
				  }
				  else
				  {
					  $GLOBALS['msg']= $hatalar->fotografEkle->dosyaBoyut;
				  }
				  
			  }
			  
			  
		  }
		  else{
			  //$GLOBALS["msg"]="Başarısız";
			  include('cikis.php');
			  //include('giris.php');
		  }
	  }
	  else{
		  include('cikis.php');
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
      </section>

      <div class="album py-2 bg-light">
        <div class="container">
              <div class="card mb-4 box-shadow">

				  <form action="" method="post" class="form-control " enctype="multipart/form-data">
					<div class="form-group row justify-content-center align-items-center mt-5"> 
					  <div class="form-group col-sm-2">
					<label for="resim" class="form-label ">Fotoğraf Ekleme yeri</label>
					  </div>
						<div class="form-group col-sm-3">
					<input type="file" name="resim" class="form-control" placeholder="Fotoğrafın açıklaması" id="resim" required/>
						</div>
					</div>
					 <div class="form-group row justify-content-center align-items-center"> 
						 <div class="form-group col-md-6">
					<label for="aciklama" class="sr-only ">Açıklama</label>
      				<input type="text" name="aciklama" class="form-control" placeholder="Fotoğrafın açıklaması">
					
						 </div>
					  </div>
					  <div class="form-group row justify-content-center align-items-center"> 
						 <div class="form-group col-md-4">
					  <button class="btn btn-sm btn-primary btn-block mt-0" type="submit" name="yukle" value="yukle">Yükle</button>
							 
						  </div>
					  </div>
					  <div class="form-group row justify-content-center align-items-center"> 
						 <div class="form-group col-md-4">
							 <p class=" text-danger text-center"> <?php echo $GLOBALS["msg"]; ?></p>
						  </div>
					  </div>

					</form>
                  <div class="d-flex justify-content-between align-items-center">
                </div>
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
</html><?php ob_end_flush(); ?> 
