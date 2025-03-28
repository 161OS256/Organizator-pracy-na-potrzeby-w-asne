<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="Author" content="Marek Bartocha" />
  <title>Pulpit</title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css" >
</head>
<body>
<?php include('conect.php');

$wynik_t = $pdo->query("select data from terminy order by data DESC");
foreach($wynik_t as $rekord_t) {
$datax = $rekord_t['data']; }

$dzisiaj = strftime('%Y-%m-%d');  

$result = round((strtotime($datax)-strtotime($dzisiaj))/86400); 

if ($result < 0) $kolorek3 = 'red';

?>

<div style="position: absolute; left: 820px; top: 330px"><a href=\cigla/start_data.php><button><h1>Nowy dzień<br />start</h1></button></a></div>
<div style="position: absolute; left: 50px; top: 330px"><a href=\cigla/informacje.php><button><h1>Informacje<br />wpisy</h1></button></a></div>
<div style="position: absolute; left: 570px; top: 330px"><a href=\cigla/notatki.php><button><h1>Zrób<br />notatke</h1></button></a></div>
<div style="position: absolute; left: 330px; top: 330px"><a href=\cigla/palety.php><button><h1>Wymiana<br />palet</h1></button></a></div>
<div style="position: absolute; left: 340px; top: 120px"><a href=\cigla/terminy.php><button><h1>Termin za<br /><div style="color: <?php echo $kolorek3 ?>"><?php echo "$result dni" ?></div></h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 858px; top: 230px"><button input type="submit" name="kolor" value="kolor"><h1>Kolor tła</h1></button></div>
<div style="position: absolute; left: 350px; top: 30px"><button input type="submit" name="pauza" value="pauza"><h1>Pauza 3h</h1></button></div>
</form><br />

<?php
if ($_POST['ok'])  $pdo->exec("update temp set ok=1"); 

$wynik0 = $pdo->query("select id,kolor,ok from temp");
 foreach($wynik0 as $rekord0) {
$id = $rekord0['id'];
$kolor = $rekord0['kolor']; 
$ok = $rekord0['ok']; }

if ($id == '') $pdo->exec("INSERT INTO temp (id) VALUES ('0')"); 

$wynik02 = $pdo->query("select stan,moje from palety order by idp  ASC");
foreach($wynik02 as $rekord02) {
$palety = $rekord02['stan'];
$moje = $rekord02['moje']; }

if ($moje == 1) $pn = 'moja';
if (($moje >= 2) and ($moje <= 4)) $pn = 'moje';
if ($moje >= 5) $pn = 'moich';

 $pauza = 3;
 $jazda = 2;

if ($_POST['kolor']) {
 	$kolor1 = $pdo->query("select kolor from temp");
  foreach($kolor1 as $rekord_kolor1) {
  $farba = $rekord_kolor1['kolor']; }
	
if ($farba == 'gray') { $pdo->exec("update temp set kolor='white'"); } 
else { $pdo->exec("update temp set kolor='gray'"); } ?><meta http-equiv="refresh" content="0;"><?php }



if ($_POST['pauza']) {
$test1 = $pdo->query("select pauza_3h from dane where id='$id'");
foreach($test1 as $rekord_test1) {
$pauza_3h = $rekord_test1['pauza_3h']; } 

	if ($pauza_3h == 1) { $pdo->exec("update dane set pauza_3h='0' where id='$id'");
	$info = ' '; } else { 
	$pdo->exec("update dane set pauza_3h='1' where id='$id'"); } }	
	
	
	
$test1 = $pdo->query("select pauza_3h from dane where id='$id'");
foreach($test1 as $rekord_test1) {
$pauza_3h = $rekord_test1['pauza_3h']; } 
if ($pauza_3h == 1) $info = 'Tak 3h';	
	

$wynik1 = $pdo->query("select start,stop from dane where id='$id'");
foreach($wynik1 as $rekord1) {
$sprawdzenie1 = $rekord1['start'];
$sprawdzenie2 = $rekord1['stop']; }

 $nazwa = 'Pauza do godz.';
 
 	$stmt1 = $pdo->query("SELECT data_start,start,data_stop,stop,wekend,wekend_dom FROM dane where id='$id'" );
	foreach($stmt1 as $row1) {
	$wekend = $row1['wekend'];
	$wekend_dom = $row1['wekend_dom']; 
	$data_start = $row1['data_start'];
	$start = $row1['start'];
	$data_stop = $row1['data_stop'];
	$stop = $row1['stop']; }
	
	if ($data_stop == NULL) $data_wik = $data_start; else $data_wik = $data_stop;
	
 $wynik2 = $pdo->query("select data_tygodnia,godz_tygodnia from temp");
 foreach($wynik2 as $rekord2) {
 $data_tygodnia = $rekord2['data_tygodnia'];
 $godz_tygodnia = $rekord2['godz_tygodnia']; }
 $data_tygodnia2 = "$data_tygodnia $godz_tygodnia";
	
 $data_tygodnia1 = strftime('%Y-%m-%d / %H:%M', strtotime("$data_tygodnia2 +6 day"));
 
 $wynik3 = $pdo->query("select p9a,p9b,jazda_10h from dane where data_start>='$data_tygodnia' order by id  asc");
 foreach($wynik3 as $rekord3) {  
 $p9a = $rekord3['p9a'];
 $p9b = $rekord3['p9b'];
 $j10h = $rekord3['jazda_10h'];
 if (($p9a == 1) or ($p9b == 1)) $p9 = 1; else $p9 = 0;
 $pauza = $pauza - $p9; 
 $jazda = $jazda - $j10h; }

	
if ($pauza <= 0) { if ($sprawdzenie1 <> NULL) {
 $data_godz_start = strftime('%Y-%m-%d %H:%M', strtotime("$data_start $start +13 hour"));
 $praca = strftime('%H:%M', strtotime("$data_godz_start"));
 $data_pr = strftime('%Y-%m-%d', strtotime("$data_godz_start"));
 $pdo->exec("update temp set data2='$data_pr'"); } }
 
if (($pauza == 0) and ($p9 == 1)) { if ($sprawdzenie1 <> NULL) {
 $data_godz_start = strftime('%Y-%m-%d %H:%M', strtotime("$data_start $start +15 hour"));
 $praca = strftime('%H:%M', strtotime("$data_godz_start"));
 $data_pr = strftime('%Y-%m-%d', strtotime("$data_godz_start"));
 $pdo->exec("update temp set data2='$data_pr'"); } }
 
 if (($pauza > 0) or ($pauza_3h == 1)) { if ($sprawdzenie1 <> NULL) {
 $data_godz_start = strftime('%Y-%m-%d %H:%M', strtotime("$data_start $start +15 hour"));
 $praca = strftime('%H:%M', strtotime("$data_godz_start"));
 $data_pr = strftime('%Y-%m-%d', strtotime("$data_godz_start"));
 $pdo->exec("update temp set data2='$data_pr'"); } }
 
 
if ($pauza <= 0) { if ($sprawdzenie2 <> NULL) {
 $data_godz_stop = strftime('%Y-%m-%d %H:%M', strtotime("$data_wik $stop +11 hour"));
 $pauza_do = strftime('%H:%M', strtotime("$data_godz_stop"));
 $data_p = strftime('%Y-%m-%d', strtotime("$data_godz_stop"));
 $pdo->exec("update temp set data3='$data_p'"); } }
 
if (($pauza == 0) and ($p9 == 1)) { if ($sprawdzenie2 <> NULL) {
 $data_godz_stop = strftime('%Y-%m-%d %H:%M', strtotime("$data_wik $stop +9 hour"));
 $pauza_do = strftime('%H:%M', strtotime("$data_godz_stop"));
 $data_p = strftime('%Y-%m-%d', strtotime("$data_godz_stop"));
 $pdo->exec("update temp set data3='$data_p'"); } }
 
  if (($pauza > 0) or ($pauza_3h == 1)) { if ($sprawdzenie2 <> NULL) {
 $data_godz_stop = strftime('%Y-%m-%d %H:%M', strtotime("$data_wik $stop +9 hour"));
 $pauza_do = strftime('%H:%M', strtotime("$data_godz_stop"));
 $data_p = strftime('%Y-%m-%d', strtotime("$data_godz_stop"));
 $pdo->exec("update temp set data3='$data_p'"); } }
 
 
 	if ($wekend == 'x') { 
 $data_godz_stop = strftime('%Y-%m-%d %H:%M', strtotime("$data_wik $stop +24 hour"));
 $pauza_do = strftime('%H:%M', strtotime("$data_godz_stop"));
 $data_p = strftime('%Y-%m-%d', strtotime("$data_godz_stop"));
 $pdo->exec("update temp set data3='$data_p'");
 $nazwa = 'Pauza w.24 do godz.'; }

	if ($wekend_dom == 1) { 
 $data_godz_stop = strftime('%Y-%m-%d %H:%M', strtotime("$data_wik $stop +45 hour"));
 $pauza_do = strftime('%H:%M', strtotime("$data_godz_stop"));
 $data_p = strftime('%Y-%m-%d', strtotime("$data_godz_stop"));
 $pdo->exec("update temp set data3='$data_p'");
 $nazwa = 'Pauza w.45 do godz.'; }

	$data_teraz = strftime('%Y-%m-%d');
	
	$wynik4 = $pdo->query("select data2,data3 from temp");
	foreach($wynik4 as $rekord4) {
 if ($sprawdzenie1 <> NULL) { $data1 = $rekord4['data2']; 
 if ($data1 == $data_teraz) $data1 = ' '; }
 if ($sprawdzenie2 <> NULL) { $data2 = $rekord4['data3'];
 if ($data2 == $data_teraz) $data2 = ' '; } 
 if ($wekend == 1) { $data2 = $rekord4['data3']; } 
 if ($wekend_dom == 1) { $data2 = $rekord4['data3']; } }
 
  if ($pauza < 0) { 
	$pauza = 0; 
	$pdo->exec("update dane set p9b='0', p9a='0' where id='$id'"); }
	
  include('kast.php');
  include('licz_min.php');	
	
	$wynik5 = $pdo->query("select data_stop,godz_stop, do_oddania from oddawanie where id='$id_0'");
	foreach($wynik5 as $rekord5) {  
	$oddaj_data_stop1 = $rekord5['data_stop'];
	$oddaj_godz_stop1 = $rekord5['godz_stop'];
	$do_oddania1 = $rekord5['do_oddania']; }
	
	$go = 0; $zalegle0 = $do_oddania1; 
	if ($zalegle > 0) {
	while($zalegle0 > 59) {	$zalegle0 = $zalegle0 - 60;	$go = ++$go; } 
	if ($zalegle0 < 10) $zalegle0 = "0$zalegle0"; }

	$oddac_do1 = strftime('%Y-%m-%d %H:%M', strtotime("$oddaj_data_stop1 $oddaj_godz_stop1 +21 day -$do_oddania1 min"));
 
	$od = strtotime(strftime('%Y-%m-%d %H:%M'));
	$do = strtotime(date("$oddac_do1"));
	$wynik_min = CalcMin($do,$od);
	
	$godz = 0; if ($wynik_min > 0) {
	while($wynik_min > 59) {	$wynik_min = $wynik_min - 60;	$godz = ++$godz; } 
	if ($wynik_min < 10) $wynik_min = "0$wynik_min"; }
	
	if (($godz < 73) and ($godz > 0)) {
	$text1 = "Za $godz:$wynik_min trzeba oddac zaległy weekend $go:$zalegle0 godz.";
	if ($farba == 'gray') $kolorek = 'white'; else $kolorek = 'red';
	} else {
	$text1 = "Tygodniowy czas pracy do $data_tygodnia1";
  $kolorek = 'black'; }
	
	$dzien = dateV('l');

  if ($dzien <> 'Czwartek') $pdo->exec("update temp set ok=0");
	
	if (($dzien == 'Czwartek') and ($ok == 0)) { $text2 = "Sprawdź dwu tygodniowy czas jazdy";
	if ($farba == 'gray') $kolorek2 = 'white'; else $kolorek2 = 'red'; }
	else { $text2 = "Data dzisiejsza $data_teraz"; $kolorek2 = 'black'; } 
	
?>
<div style="position: absolute; left: 100px; top: 0px"><h1>Pozostało</h1></div>
<div style="position: absolute; left: 50px; top: 50px"><h1>Pauzy 9h</h1></div>
<div style="position: absolute; left: 250px; top: 50px"><h1>( <?php echo $pauza ?> )</h1></div>
<div style="position: absolute; left: 50px; top: 100px"><h1>Jazda na 10h </h1></div>
<div style="position: absolute; left: 250px; top: 100px"><h1>( <?php echo $jazda ?> )</h1></div>
<div style="position: absolute; left: 50px; top: 150px"><h1>Stan palet</h1></div>
<div style="position: absolute; left: 250px; top: 150px"><h1>( <?php echo $palety ?> )</h1></div>
<div style="position: absolute; left: 550px; top: 0px"><h1>Czas pracy do godz.</h1></div>
<div style="position: absolute; left: 895px; top: 0px"><h1> <?php echo $praca ?> </h1></div>
<div style="position: absolute; left: 680px; top: 50px"><h1> <?php echo $data1 ?> </h1></div>

<div style="position: absolute; left: 550px; top: 100px"><h1><?php echo $nazwa ?></h1></div>
<div style="position: absolute; left: 895px; top: 100px"><h1> <?php echo $pauza_do ?> </h1></div>
<div style="position: absolute; left: 680px; top: 150px"><h1> <?php echo $data2 ?> </h1></div>
<div style="position: absolute; left: 500px; top: 50px"><h1> <?php echo $info ?> </h1></div>

<div style="color: <?php echo $kolorek ?>; position: absolute; left: 50px; top: 200px" ><h1> <?php echo $text1; ?> </h1></div>

  <?php	if (($kolorek2 == 'red') or ($kolorek2 == 'white')) { ?><div style="color: <?php echo $kolorek2 ?>; position: absolute; left: 100px; top: 250px">
	
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<h1> <?php echo $text2; ?>  <button input type="submit" name="ok" value="ok"><big><big><big><b>>>OK<<</b></big></big></big></button> </h1>
  </form> <?php } else { ?><div style="color: <?php echo $kolorek2 ?>; position: absolute; left: 230px; top: 250px">
	<h1> <?php echo $text2; ?> </h1> <?php } ?>

</body>
</html>
