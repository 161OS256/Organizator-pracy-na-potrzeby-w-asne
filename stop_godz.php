<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Godzina STOP </title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>
<div style="position: absolute; left: 45px; top: 330px"><a href=\cigla/start_godz.php><button><h1>Poprzednia<br />strona</h1></button></a></div>

<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/koniec.php><button><h1>Następny<br />krok</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 370px; top: 50px"><button input type="submit" name="godz_stop+" value="godz_stop+"><h1>(+)</h1></button></div>
<div style="position: absolute; left: 260px; top: 50px"><button input type="submit" name="godz_stop+5" value="godz_stop+5"><h1>(+5)</h1></button></div>

<div style="position: absolute; left: 550px; top: 50px"><button input type="submit" name="min_stop+" value="min_stop+"><h1>(+)</h1></button></div>
<div style="position: absolute; left: 640px; top: 50px"><button input type="submit" name="min_stop+5" value="min_stop+5"><h1>(+5)</h1></button></div>

<div style="position: absolute; left: 370px; top: 250px"><button input type="submit" name="godz_stop-" value="godz_stop-"><h1>( - )</h1></button></div>
<div style="position: absolute; left: 260px; top: 250px"><button input type="submit" name="godz_stop-5" value="godz_stop-5"><h1>( -5 )</h1></button></div>

<div style="position: absolute; left: 550px; top: 250px"><button input type="submit" name="min_stop-" value="min_stop-"><h1>( - )</h1></button></div>
<div style="position: absolute; left: 640px; top: 250px"><button input type="submit" name="min_stop-5" value="min_stop-5"><h1>( -5 )</h1></button></div>

<div style="position: absolute; left: 850px; top: 50px"><button input type="submit" name="czas" value="czas"><h1>Czas<br />aktualny</h1></button></div>

<div style="position: absolute; left: 50px; top: 50px"><button input type="submit" name="zapisz" value="zapisz"><h1>OK<br />>zapisz<</h1></button></div>

</form><br />
<?php
include('licz_min.php');
setlocale(LC_ALL, 'pl_PL', 'pl', 'Polish_Poland.28592');


if ($_POST['czas']) { 
$godz_stop = strftime('%H');
$min_stop = strftime('%M');
$pdo->exec("update temp set godz_stop='$godz_stop'"); 
$pdo->exec("update temp set min_stop='$min_stop'");	 }

if ($_POST['godz_stop+']) { 
	$wynik = $pdo->query("select godz_stop from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_stop']; }
	$zmienna++;
  if ($zmienna > 23) $zmienna = $zmienna -24; 
		if ($zmienna < 10) {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='0$godz_stop'"); } 
		else {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='$godz_stop'"); }	}
			
if ($_POST['godz_stop+5']) { 
	$wynik = $pdo->query("select godz_stop from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_stop']; }
	$zmienna = $zmienna + 5;
  if ($zmienna > 23) $zmienna = $zmienna -24; 
		if ($zmienna < 10) {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='0$godz_stop'"); } 
		else {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='$godz_stop'"); }	}
		
	
if ($_POST['godz_stop-']) { 
	$wynik = $pdo->query("select godz_stop from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_stop']; }
	--$zmienna;
	if ($zmienna < 0) $zmienna = $zmienna + 24;
		if ($zmienna < 10) {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='0$godz_stop'"); } 		
		else {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='$godz_stop'"); }	}
			
			
if ($_POST['godz_stop-5']) { 
	$wynik = $pdo->query("select godz_stop from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_stop']; }
	$zmienna = $zmienna - 5;
	if ($zmienna < 0) $zmienna = $zmienna + 24;
		if ($zmienna < 10) {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='0$godz_stop'"); } 		
		else {
			$godz_stop = $zmienna;
			$pdo->exec("update temp set godz_stop='$godz_stop'"); }	}
			
	
if ($_POST['min_stop+']) {                        
	$wynik = $pdo->query("select min_stop from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['min_stop']; }
	++$zmienna;
	if ($zmienna > 59) $zmienna = $zmienna - 60; 
		if ($zmienna < 10) {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='0$min_stop'"); } 
		else {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='$min_stop'"); } } 
			
			
if ($_POST['min_stop+5']) {                        
	$wynik = $pdo->query("select min_stop from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['min_stop']; }
	$zmienna = $zmienna + 5;
  if ($zmienna > 59) $zmienna = $zmienna - 60;
		if ($zmienna < 10) {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='0$min_stop'"); } 
		else {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='$min_stop'"); } } 
	
if ($_POST['min_stop-']) { 
	$wynik = $pdo->query("select min_stop from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['min_stop']; }
	--$zmienna;
		if ($zmienna < 0) $zmienna = $zmienna + 60; 
			if ($zmienna < 10) { 
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='0$min_stop'"); }  
		else {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='$min_stop'"); } }
			
	if ($_POST['min_stop-5']) { 
	$wynik = $pdo->query("select min_stop from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['min_stop']; }
	$zmienna = $zmienna - 5;
		if ($zmienna < 0) $zmienna = $zmienna + 60;
			if ($zmienna < 10) { 
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='0$min_stop'"); }  
		else {
			$min_stop = $zmienna;
			$pdo->exec("update temp set min_stop='$min_stop'"); } }
			
	$temp6 = $pdo->query("select start from dane order by id  ASC");
  foreach($temp6 as $rekord_temp6) {
	$starter = $rekord_temp6['start']; }
	
	$temp = $pdo->query("select os from temp");
  foreach($temp as $rekord_temp) {
	$os = $rekord_temp['os']; }

if ($_POST['zapisz']) { if (($os == 0) and ($starter <> NULL)) {
	
	$temp = $pdo->query("select id,data_start,godz_stop,min_stop,os from temp");
  foreach($temp as $rekord_temp) {
	$id = $rekord_temp['id'];
	$data = $rekord_temp['data_start'];
	$godz_stop = $rekord_temp['godz_stop'];
	$min_stop = $rekord_temp['min_stop'];
	$os = $rekord_temp['os']; }
	
	$wynik10 = $pdo->query("select start from dane where id='$id'");
	foreach($wynik10 as $rekord10) {
  $start = $rekord10['start'];}
	
	$temp2 = $pdo->query("select data_start from dane where id='$id'");
  foreach($temp2 as $rekord_temp2) {
	$data3 = $rekord_temp2['data_start']; }
	
	$stop = "$godz_stop:$min_stop";
	
	$test = $pdo->query("select test from temp");
  foreach($test as $rekord_test) {
	$test_x = $rekord_test['test'];	}
	
	$test1 = $pdo->query("select pauza_3h from dane where id='$id'");
  foreach($test1 as $rekord_test1) {
	$pauza_3h = $rekord_test1['pauza_3h']; }
	
	if ($stop > $start) {
	$od = strtotime(date("$data $start"));
	$do = strtotime(date("$data $stop"));
	$wynik_min = CalcMin($do,$od);
	
	if ( 780 >= $wynik_min ) { if($test_x == 1) { 
	$data = strftime('%Y-%m-%d', strtotime("$data -1 day"));
	$mies = dateV('F', strtotime("$data"));
	$dzien = dateV('l', strtotime("$data"));
	$pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien', test='0'"); }
	
	$pdo->exec("update dane set stop='$stop', p9b='0', data_stop=NULL where id='$id'");
  $info = 'OK'; } else { if ($pauza_3h == 1) { $pauza = 0; $info = 'OK'; } else { $pauza = 1; $info = 'OK P9'; }
	if($test_x == 1) { 
	$data = strftime('%Y-%m-%d', strtotime("$data -1 day"));
	$mies = dateV('F', strtotime("$data"));
	$dzien = dateV('l', strtotime("$data"));
	$pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien', test='0'"); }
	
	$pdo->exec("update dane set stop='$stop', p9b='$pauza', data_stop=NULL where id='$id'"); } }  else {
	
	$data2 = strftime('%Y-%m-%d', strtotime("$data3 +1 day"));
	if($test_x == 0) { 
	$mies = dateV('F', strtotime("$data2"));
	$dzien = dateV('l', strtotime("$data2"));
	$pdo->exec("update temp set data_start='$data2', data4='$data2', mies='$mies', mies2='$mies', dzien='$dzien', test='1'"); }

	$od2 = strtotime(date("$data $start"));
	$do2 = strtotime(date("$data2 $stop"));
	$wynik_min2 = CalcMin($do2,$od2);
	
	if (780 >= $wynik_min2) {
	$pdo->exec("update dane set stop='$stop', p9b='0', data_stop='$data2' where id='$id'");
  $info = 'OK'; } else { if ($pauza_3h == 1) { $pauza = 0; $info = 'OK'; } else { $pauza = 1; $info = 'OK P9'; }
	$pdo->exec("update dane set stop='$stop', p9b='$pauza', data_stop='$data2' where id='$id'"); } } } else $info = 'Nie realne'; }
	

$wynik = $pdo->query("select godz_stop,min_stop from temp");
foreach($wynik as $rekord) {
$godz_stop = $rekord['godz_stop'];
$min_stop = $rekord['min_stop']; }

?>
<div style="position: absolute; left: 430px; top: 130px"><big><big><h1><?php echo $godz_stop; ?></h1></big></big></div>
<div style="position: absolute; left: 490px; top: 125px"><big><big><h1>:</h1></big></big></div>
<div style="position: absolute; left: 520px; top: 130px"><big><big><h1><?php echo $min_stop; ?></h1></big></big></div>
<div style="position: absolute; left: 50px; top: 150px"><big><h1><?php echo $info; ?></h1></big></div>
<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Godzina STOP</h2></big></big></div>

</body>
</html>