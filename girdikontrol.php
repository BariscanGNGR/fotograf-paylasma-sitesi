
<?php

function guvenli_giris($girdi) 
{
	$girdi = strip_tags(mysqli_real_escape_string(trim($girdi)));
	return $girdi; 
}

//metin güvenli ise true
//metin riskli ise false

?>