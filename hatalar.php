
<?php
	$xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<hatalar>
	<kaydol>
		
		<kullanicivar>
			Bu isimli kullanıcı var başka isimli bir kullanıcı seçiniz
		</kullanicivar>
		<kullanicikisa>
			Kullanıcı adı çok kısa
		</kullanicikisa>
		<sifrekisa>
			Şifre çok kısa 8 hane veya daha uzun şifre giriniz.
		</sifrekisa>
		<ad>
			Adınız çok kısa sahte gibi gözüküyor
		</ad>
		<soyad>
			Soyadınız çok kısa sahte gibi gözüküyor
		</soyad>
		<sifreeksik>
			Şifrede en az 1 adet büyük , küçük harf ve sayı bulunmalıdır.
		</sifreeksik>
		<sifretekrar>
			Şifre ve Şifre tekrarınız aynı değil.
		</sifretekrar>
		<epostaMevcut>
			Almak istediğiniz e posta mevcuttur.
		</epostaMevcut>
	</kaydol>
	<fotografEkle>
		<dosyaBoyut>
			Dosya boyutu 10mb'dan fazla.
		</dosyaBoyut>
		<uzanti>
			Dosya uzantısı uyumlu değil jpeg , jpg veya png kullanın
		</uzanti>
		<kayitHata>
			Kayıt edilemiyor HATA
		</kayitHata>
	</fotografEkle>
</hatalar>
XML;
?>