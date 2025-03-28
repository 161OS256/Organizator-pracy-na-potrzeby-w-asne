<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Informacje </title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>

<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>
<div style="position: absolute; left: 720px; top: 240px"><a href=\cigla/odzysk.php><button>BackUp</button></a></div>
<div style="position: absolute; left: 530px; top: 330px"><a href=\cigla/wpisy.php><button><h1>Poprzednie<br />wpisy</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 400px; top: 220px"><h3><input size="23" name="text" /> <input type="submit" name="Szukaj" value="Szukaj" /></h3></div>
</form><br />


<?php



$wynik = $pdo->query("select id,data4,mies2 from temp");
foreach($wynik as $rekord) {
$data = $rekord['data4'];
$mies = $rekord['mies2']; }

$mies2 = dateV('F', strtotime("$data -1 month"));

$rok_dzis = strftime('%Y', strtotime("$data"));

$info = $mies;
?>
<div style="position: absolute; left: 50px; top: 260px"><h1>Zaliczka<br /><textarea cols="25" rows="7" disabled="disabled">
<?php
$wynik2 = $pdo->query("select stan_pl,stan_eu,stan_uk from kasa ");
foreach($wynik2 as $rekord2) {
$zal_zl = $rekord2['stan_pl']; 
$zal_euro = $rekord2['stan_eu'];
$zal_gbp = $rekord2['stan_uk']; }

echo "\n" . "  ***  $zal_zl	ZŁ" . "\n" . "\n" . "  ***  $zal_euro	EURO" . "\n" . "\n" . "  ***  $zal_gbp	GBP";

?></textarea></h1></div>

<div style="position: absolute; left: 400px; top: 0px"><h1>Wekendy do oddania<br /><textarea cols="70" rows="6" disabled="disabled">
<?php
 include('wekend_info.php'); if (($wekend_do_oddania == ' ') and ($wekend_do_oddania1 == ' ') and ($wekend_do_oddania2 == ' ')) echo "\n" . "  Brak wekendu do oddania"; else 
 echo "\n" . "  $wekend_do_oddania" . "\n" . "\n" . "  $wekend_do_oddania1" . "\n" . "\n" . "  $wekend_do_oddania2";
?>
</textarea></h1></div>

<div style="position: absolute; left: 50px; top: 0px"><h1>Kasa<br /><textarea cols="25" rows="11" disabled="disabled">
<?php

  $pl = 0;
	$eu = 0;
	$uk = 0;
	$wuk = 0;
	$wekend = 0;
	$przestoj = 0;
	$war = 0;
	
	$wynik4 = $pdo->query("select data_stop,eu,pl,uk,wekend,przestoj from dane where mies='$mies2' order by id  asc");
	foreach($wynik4 as $rekord4) {
	$data_stop2 = $rekord4['data_stop']; }
	
	$mies_test2 = dateV('F', strtotime("$data_stop2"));
	
	if (($data_stop2 <> NULL) and ($mies_test2 == $mies)) {
	if ($rekord4['pl'] == 1) { $pl = $pl + 1; $kr_wstecz = 1; }
	if ($rekord4['eu'] == 1) { $eu = $eu + 1; $kr_wstecz = 2; }
	if ($rekord4['uk'] == 1) { $uk = $uk + 1; $kr_wstecz = 3; } 
	$wekend = $wekend + $rekord4['wekend']; 
	$przestoj = $przestoj + $rekord4['przestoj']; }
	
	$dubel = $data_stop2;    

	$wynik3 = $pdo->query("select id,data_start,data_stop,eu,pl,uk,wekend,przestoj from dane where mies='$mies' order by id  asc");
	foreach($wynik3 as $rekord3) {
	$data_start = $rekord3['data_start'];
	$data_stop = $rekord3['data_stop'];
	$rok = strftime('%Y', strtotime("$data_start"));
	
	if ($rok == $rok_dzis) {	

	@$wekend = $wekend + $rekord3['wekend']; 
	$przestoj = $przestoj + $rekord3['przestoj'];
	
	$kr_a = '';
	$kr_b = '';
	
	$mies_test = dateV('F', strtotime("$data_stop"));
	
	if ((($rekord3['wekend'] > 0 ) or ($rekord3['przestoj'] > 0)) and ($rekord3['uk'] == 1)) {
	@$wuk = $wuk + $rekord3['wekend'] + $rekord3['przestoj'];
	if (($data_stop <> NULL) and ($mies_test == $mies)) $wuk = $wuk + 1; }
	

	if (($data_stop <> NULL) and ($mies_test == $mies)) { 
	
	if (($rekord3['eu'] == 2) or ($rekord3['pl'] == 2) or ($rekord3['uk'] == 2)) { 
	
	if ($rekord3['pl'] == 2) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 2) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 2) { $uk = $uk + 1; $kr_a = 3; }
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 1; $kr_b = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 1; $kr_b = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 1; $kr_b = 3; } } else { 
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 2; $kr_b = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 2; $kr_b = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 2; $kr_b = 2; $war = $war + 1; } } } else { 
	
	if (($rekord3['eu'] == 2) or ($rekord3['pl'] == 2) or ($rekord3['uk'] == 2)) {
	
	if ($rekord3['pl'] == 2) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 2) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 2) { $uk = $uk + 1; $kr_a = 3; } } else { 	
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 1; $kr_a = 3; } } }
	
	if (($data_stop <> NULL) and ($mies_test <> $mies)) {
	$wekend = $wekend - $rekord3['wekend']; 
	$przestoj = $przestoj - $rekord3['przestoj']; }

	if ($data_start == $dubel) {
	
	if ($kr_a == '') $kr_a = $kr_b; 
	
  if ($kr_wstecz < $kr_a) $us = $kr_wstecz; else $us = $kr_a; 
	
	if ($us == 1) $pl = $pl - 1;
	if ($us == 2) $eu = $eu - 1;
	if ($us == 3) $uk = $uk - 1; } 

	if ($kr_b == '') $kr_b = $kr_a;   

	$kr_wstecz = $kr_b; 
	
	$kr_a = '';
	$kr_b = '';
	
	if ($data_stop <> NULL) $dubel = $data_stop; else $dubel = $data_start; } } 
	
	
	$eu = $eu + $uk;
	
	$uk = $uk + $wuk - $war;
	
	$eu_sum = $eu * 0;

	$pl_sum = $pl * 0;

	$uk_sum = $uk * 0;

	$wekend_sum = $wekend * 0;
	
	$przestoj_sum = $przestoj * 0;

	$suma = $eu + $pl + $wekend + $przestoj;

	$suma_euro = $eu_sum + $pl_sum + $uk_sum + $wekend_sum + $przestoj_sum;

echo "\n" . "             Dni   Euro   " . "\n" . "  PL" . "       - " . $pl . "	 =  " . $pl_sum . "\n" . "  EU" . "       - " . $eu . "	 =  " . $eu_sum . "\n" . "  Wekend" . "   - " . $wekend . "	 =  " . $wekend_sum . "\n" . "  Przestój" . " - " . $przestoj . "	 =  " . $przestoj_sum . "\n" . "  --------------------" . "\n" . "  UK Noc   - " . $uk . "	 =  " . $uk_sum . "\n" . "  --------------------" . "\n" ."  Suma" . "     - " . $suma . "	 =  " . $suma_euro ;

?></textarea></h1></div>

<?php
$suk_wynik2 = ' ';
if ($_POST['Szukaj']) { 

$Szukaj = trim($_POST['text']); 

if ($Szukaj <> '') { 
?><div style="position: absolute; left: 310px; top: 250px"><h1><big><big><big><big><big><big><?php echo '&#8595'; echo '&#8595'; echo '&#8595'; ?></big></big></big></big></big></big></h1></div><?php 

$suk = $pdo->query("select data_start,notatka from dane where notatka like '%$Szukaj%' order by id DESC");
foreach($suk as $suk2) {
$suk_data = $suk2['data_start']; 
$suk_not = $suk2['notatka'];  

$suk_not2 = str_replace( "***", '<br />***', $suk_not );

$suk_wynik = "$suk_data$suk_not2";

$suk_wynik2 = "$suk_wynik2<br /><br />$suk_wynik"; } } }

?>

<div style="position: absolute; left: 280px; top: 350px"><big><big><h2>Informacje</h2></big></big></div>
<div style="position: absolute; left: 50px; top: 550px"><?php echo  $suk_wynik2; ?></div>
</body>
</html>