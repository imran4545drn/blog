
<?php
$host = "db";
$kullanici = "imran123";
$parola = "imran123";
$veri_tabani = "blog";

$baglanti = mysqli_connect($host, $kullanici, $parola, $veri_tabani);
mysqli_set_charset($baglanti, "UTF8");
?>
