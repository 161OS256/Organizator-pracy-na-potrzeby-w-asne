<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Notatki </title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>

<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 270px; top: -4px"><h3>Czas<br /><input size="5" name="czas" value="<?php $czas = strftime('%H:%M'); echo $czas; ?>" /></h3></div>
<div style="position: absolute; left: 350px; top: -4px"><h3>Miejscowość<br /><input size="18" name="text2" /></h3></div>
<div style="position: absolute; left: 532px; top: -4px"><h3>Notatka<br /><input size="50" name="text" /></h3></div>
<div style="position: absolute; left: 50px; top: 50px"><button input type="submit" name="zapisz" value="zapisz"><h1>OK<br />>zapisz<</h1></button></div>
<div style="position: absolute; left: 440px; top: 330px"><button input type="submit" name="usun" value="usun"><h1>Usuń text</h1></button></div>
</form><br />
<?php

$wynik = $pdo->query("select id,usun,naczepa from temp ");
foreach($wynik as $rekord) {
$id = $rekord['id'];
$usun = $rekord['usun'];
$naczepa = $rekord['naczepa']; }

$wynikk = $pdo->query("select stan_pl, stan_eu, stan_uk from kasa ");
foreach($wynikk as $rekordk) {
$zal_zl = $rekordk['stan_pl']; 
$zal_euro = $rekordk['stan_eu'];
$zal_gbp = $rekordk['stan_uk']; }

$usuwanie = "update temp set usun='0'";
$wynik_usuwanie = $pdo->exec($usuwanie);
		if ($wynik_usuwanie) $info = '';
	
if ($_POST['zapisz']) {
$wynik_zapisz = $pdo->query("select notatka,data_start,start,pl,eu from dane where id='$id'");
foreach($wynik_zapisz as $rekord_zapisz) {
$data_start = $rekord_zapisz['data_start'];
$start = $rekord_zapisz['start'];
$stary_text = $rekord_zapisz['notatka']; 
$pl = $rekord_zapisz['pl'];
$eu = $rekord_zapisz['eu']; }

$data2 = strftime('%Y-%m-%d', strtotime("$data_start +1 day"));
if ($start < $czas) $data = $data_start; else $data = $data2;

$mies = dateV('F', strtotime("$data"));

$czas = trim($_POST['czas']); 
$miej = trim($_POST['text2']);
$not = trim($_POST['text']);

if ($miej == '') $nowy_text = $not; else { $nowy_text = "$miej $not";

$pdo->exec("update temp set miejsce='$miej'"); }


$file = "rozpoznanie.txt";
$fp = fopen($file, "w");
flock($fp, 2);
fwrite($fp, $not);
flock($fp, 3);
fclose($fp);

$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie = fread($fp, 5);

if ($rozpoznanie == 'PL-EU') {
if ($start > $czas) $pdo->exec("update dane set eu='1', pl='2', uk='0' where id='$id'"); else 
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie == 'EU-PL') {
if ($start < $czas) $pdo->exec("update dane set eu='2', pl='1', uk='0' where id='$id'"); else
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie2 = fread($fp, 4);

if ($rozpoznanie2 == 'PL-D') { $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");
if ($start > $czas) $pdo->exec("update dane set eu='1', pl='2', uk='0' where id='$id'"); else 
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); } 

if ($rozpoznanie2 == 'EU-D') { $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie2 == 'EU-F') { $pdo->exec("INSERT INTO francja (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie2 == 'EU-A') { $pdo->exec("INSERT INTO austria (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
if ($rozpoznanie2 == 'F-D') { $pdo->exec("INSERT INTO francja (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }


	$niemcy = $pdo->query("select idn,data_wy from niemcy order by idn  ASC");
	foreach($niemcy as $niemcy1) {
	$idn = $niemcy1['idn']; 
	$wy_d = $niemcy1['data_wy']; } 
	
	$francja = $pdo->query("select idf,data_wy from francja order by idf  ASC");
	foreach($francja as $francja1) {
	$idf = $francja1['idf']; 
	$wy_f = $francja1['data_wy']; }
	
	$austria = $pdo->query("select ida,data_wy from austria order by ida  ASC");
	foreach($austria as $austria1) {
	$ida = $austria1['ida']; 
	$wy_a = $austria1['data_wy']; }



$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie5 = fread($fp, 8);
	
 if ($rozpoznanie5 == 'D-F-LOCO') {
 $pdo->exec("INSERT INTO francja (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idn='$idn'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 if ($rozpoznanie5 == 'F-D-LOCO') {
 $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idf='$idf'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 
 if ($rozpoznanie5 == 'D-A-LOCO') {
 $pdo->exec("INSERT INTO austria (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idn='$idn'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 if ($rozpoznanie5 == 'A-D-LOCO') {
 $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update austria set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where ida='$ida'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 

 
$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie6 = fread($fp, 11);
 
 if ($rozpoznanie6 == 'D-F-TRANZYT') {
 $pdo->exec("INSERT INTO francja (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idn='$idn'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 if ($rozpoznanie6 == 'F-D-TRANZYT') {
 $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idf='$idf'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
	
 if ($rozpoznanie6 == 'F-D-KABOTAZ') {
 $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='KABOTAZ' where idf='$idf'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 
 if ($rozpoznanie6 == 'D-A-TRANZYT') {
 $pdo->exec("INSERT INTO austria (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idn='$idn'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 if ($rozpoznanie6 == 'A-D-TRANZYT') {
 $pdo->exec("INSERT INTO niemcy (data_wj,godz_wj,mies) VALUES ('$data','$czas','$mies')");  
 $pdo->exec("update austria set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where ida='$ida'");
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
	

$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie3 = fread($fp, 9);	
	
if ($rozpoznanie3 == 'D-PL-LOCO') { if($wy_d == NULL)
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idn='$idn'"); else
 $pdo->exec("INSERT INTO niemcy (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','LOCO')");
if ($pl<>2) { 
if ($start < $czas) $pdo->exec("update dane set eu='2', pl='1', uk='0' where id='$id'"); else
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); } }

if ($rozpoznanie3 == 'D-EU-LOCO') { if($wy_d == NULL)
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idn='$idn'"); else
 $pdo->exec("INSERT INTO niemcy (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','LOCO')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie3 == 'F-EU-LOCO') { if($wy_f == NULL)
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where idf='$idf'"); else
 $pdo->exec("INSERT INTO francja (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','LOCO')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

 if ($rozpoznanie3 == 'A-EU-LOCO') { if($wy_a == NULL)
 $pdo->exec("update austria set data_wy='$data', godz_wy='$czas', uwagi='LOCO' where ida='$ida'"); else
 $pdo->exec("INSERT INTO austria (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','LOCO')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
$fp = fopen("rozpoznanie.txt", "r");
$rozpoznanie4 = fread($fp, 12);

if ($rozpoznanie4 == 'D-PL-TRANZYT') { if($wy_d == NULL)
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idn='$idn'"); else
 $pdo->exec("INSERT INTO niemcy (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','TRANZYT')"); 
if ($pl<>2) { 
if ($start < $czas) $pdo->exec("update dane set eu='2', pl='1', uk='0' where id='$id'"); else
$pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); } }

if ($rozpoznanie4 == 'D-EU-TRANZYT') { if($wy_d == NULL)
 $pdo->exec("update niemcy set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idn='$idn'"); else
 $pdo->exec("INSERT INTO niemcy (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','TRANZYT')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie4 == 'F-EU-TRANZYT') { if($wy_f == NULL)
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where idf='$idf'"); else
 $pdo->exec("INSERT INTO francja (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','TRANZYT')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }

if ($rozpoznanie4 == 'A-EU-TRANZYT') { if($wy_a == NULL)
 $pdo->exec("update austria set data_wy='$data', godz_wy='$czas', uwagi='TRANZYT' where ida='$ida'"); else
 $pdo->exec("INSERT INTO austria (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','TRANZYT')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
if ($rozpoznanie4 == 'F-EU-KABOTAZ') { if($wy_f == NULL)
 $pdo->exec("update francja set data_wy='$data', godz_wy='$czas', uwagi='KABOTAŻ' where idf='$idf'"); else
 $pdo->exec("INSERT INTO francja (data_wy,godz_wy,mies,uwagi) VALUES ('$data','$czas','$mies','KABOTAŻ')"); 
 $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); }
 
 if($czas == 'Naczepa') $pdo->exec("update temp set naczepa='$nowy_text'");
 


if(($czas == 'Pl') or ($czas == 'Eu') or ($czas == 'Uk') or ($czas == 'Agregat')) {

if ($not == '') { $not = $miej; }

if($czas == 'Pl') { $zal_zl = $zal_zl + $nowy_text; 
	$pdo->exec("INSERT INTO kasa (pl,stan_pl,eu,stan_eu,uk,stan_uk,data) VALUES ('$not','$zal_zl','0','$zal_euro','0','$zal_gbp','$data')");
	if ($nowy_text > 0) $nowy_text = "Zaliczka +$nowy_text ZŁ   Stan $zal_zl ZŁ";
	else $nowy_text = "Wydatek $nowy_text ZŁ   Stan $zal_zl ZŁ"; }
	
if($czas == 'Eu') { $zal_euro = $zal_euro + $nowy_text;
	$pdo->exec("INSERT INTO kasa (pl,stan_pl,eu,stan_eu,uk,stan_uk,data) VALUES ('0','$zal_zl','$not','$zal_euro','0','$zal_gbp','$data')"); 
	if ($nowy_text > 0) $nowy_text = "Zaliczka +$nowy_text EURO   Stan $zal_euro EURO";
	else $nowy_text = "Wydatek $nowy_text EURO   Stan $zal_euro EURO"; }

if($czas == 'Uk') { $zal_gbp = $zal_gbp + $nowy_text;
	$pdo->exec("INSERT INTO kasa (pl,stan_pl,eu,stan_eu,uk,stan_uk,data) VALUES ('0','$zal_zl','0','$zal_euro','$not','$zal_gbp','$data')");
	if ($nowy_text > 0) $nowy_text = "Zaliczka +$nowy_text GBP   Stan $zal_gbp GBP";
	else $nowy_text = "Wydatek $nowy_text GBP   Stan $zal_gbp GBP"; }
	
if($czas == 'Agregat') {
 $nowy_text = "Tankowanie agregatu $miej Litry $not Motogodziny";
 $pdo->exec("INSERT INTO agregat (data,litry,motogodz,mies,naczepa) VALUES ('$data','$miej','$not','$mies','$naczepa')"); }
	
	$text = "$stary_text  *** $nowy_text\r\n" ;
	} else $text = "$stary_text  *** $czas  $nowy_text\r\n" ;

	$zapisywanie = ("update dane set notatka='$text' where id='$id'"); 
	$wynik_zapisywanie = $pdo->exec($zapisywanie);
  $info = 'Ok'; }
	
if ($_POST['usun']) {
  if ($usun == 1) { $pdo->exec("update temp set usun='0'");
	$wynik_zapisz = $pdo->query("select notatka from dane where id='$id'");
  foreach($wynik_zapisz as $rekord_zapisz) {
  $stary_text = $rekord_zapisz['notatka']; }
	
	$plik=fopen('plik.txt','w');  
	fwrite($plik,$stary_text); 
  fclose($plik); 
	
	$dane=file('plik.txt'); 
	array_pop($dane);
	$plik=fopen('plik.txt','w');  
	fwrite($plik,join('',$dane)); 
	fclose($plik);   
 
	$save = file_get_contents('plik.txt');
	$text_usun = "update dane set notatka='$save' where id='$id'"; 
	$wynik_text_usun = $pdo->exec($text_usun);
	$info = 'Text <br /> usunięty'; } else {
	$pdo->exec("update temp set usun='1'"); 
	$info = 'Usunąć ?'; } } 

$wynik2 = $pdo->query("select notatka from dane where id='$id'");
foreach($wynik2 as $rekord2) {
$odczyt = $rekord2['notatka']; }			

?>

<div style="position: absolute; left: 270px; top: 70px"><textarea cols="86" rows="12" disabled="disabled"><?php echo $odczyt; ?></textarea></div>
<div style="position: absolute; left: 50px; top: 150px"><big><big><h2><?php echo $info; ?></h2></big></big></div>
<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Notatki</h2></big></big></div>
</body>
</html>