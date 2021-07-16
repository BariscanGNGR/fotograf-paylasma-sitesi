<?php ob_start(); ?> 
<?php 
	
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	$_SESSION = array();
	session_destroy();
	if(isset($_GET['sifirla']))
	{
	}
	else
		header("Location:giris.php"); 
	
?><?php ob_end_flush(); ?> 