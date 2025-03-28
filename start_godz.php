<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Godzina START </title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>
<div style="position: absolute; left: 50px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>

<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/stop_godz.php><button><h1>Następny<br />krok</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 370px; top: 50px"><button input type="submit" name="godz_start+" value="godz_start+"><h1>(+)</h1></button></div>
<div style="position: absolute; left: 260px; top: 50px"><button input type="submit" name="godz_start+5" value="godz_start+5"><h1>(+5)</h1></button></div>

<div style="position: absolute; left: 550px; top: 50px"><button input type="submit" name="min_start+" value="min_start+"><h1>(+)</h1></button></div>
<div style="position: absolute; left: 640px; top: 50px"><button input type="submit" name="min_start+5" value="min_start+5"><h1>(+5)</h1></button></div>

<div style="position: absolute; left: 370px; top: 250px"><button input type="submit" name="godz_start-" value="godz_start-"><h1>( - )</h1></button></div>
<div style="position: absolute; left: 260px; top: 250px"><button input type="submit" name="godz_start-5" value="godz_start-5"><h1>( -5 )</h1></button></div>

<div style="position: absolute; left: 550px; top: 250px"><button input type="submit" name="min_start-" value="min_start-"><h1>( - )</h1></button></div>
<div style="position: absolute; left: 640px; top: 250px"><button input type="submit" name="min_start-5" value="min_start-5"><h1>( -5 )</h1></button></div>

<div style="position: absolute; left: 850px; top: 50px"><button input type="submit" name="czas" value="czas"><h1>Czas<br />aktualny</h1></button></div>

<div style="position: absolute; left: 50px; top: 50px"><button input type="submit" name="zapisz" value="zapisz"><h1>OK<br />>zapisz<</h1></button></div>

</form><br />
<?php
include('licz_min.php');
setlocale(LC_ALL, 'pl_PL', 'pl', 'Polish_Poland.28592');

if ($_POST['czas']) { 
	$godz_start = strftime('%H');
	$min_start = strftime('%M');
	$pdo->exec("update temp set godz_start='$godz_start'"); 
	$pdo->exec("update temp set min_start='$min_start'");	 }

if ($_POST['godz_start+']) { 
	$wynik = $pdo->query("select godz_start from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_start']; }
	$zmienna++;
  if ($zmienna > 23) $zmienna = $zmienna -24; 
		if ($zmienna < 10) {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='0$godz_start'"); } 
		else {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='$godz_start'"); }	}
			
if ($_POST['godz_start+5']) { 
	$wynik = $pdo->query("select godz_start from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_start']; }
	$zmienna = $zmienna + 5;
  if ($zmienna > 23) $zmienna = $zmienna -24; 
		if ($zmienna < 10) {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='0$godz_start'"); } 
		else {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='$godz_start'"); }	}
		
	
if ($_POST['godz_start-']) { 
	$wynik = $pdo->query("select godz_start from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_start']; }
	--$zmienna;
	if ($zmienna < 0) $zmienna = $zmienna + 24;
		if ($zmienna < 10) {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='0$godz_start'"); } 		
		else {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='$godz_start'"); }	}
			
			
if ($_POST['godz_start-5']) { 
	$wynik = $pdo->query("select godz_start from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['godz_start']; }
	$zmienna = $zmienna - 5;
	if ($zmienna < 0) $zmienna = $zmienna + 24;
		if ($zmienna < 10) {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='0$godz_start'"); } 		
		else {
			$godz_start = $zmienna;
			$pdo->exec("update temp set godz_start='$godz_start'"); }	}
			
	
if ($_POST['min_start+']) {                        
	$wynik = $pdo->query("select min_start from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['min_start']; }
	++$zmienna;
	if ($zmienna > 59) $zmienna = $zmienna - 60; 
		if ($zmienna < 10) {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='0$min_start'"); } 
		else {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='$min_start'"); } } 
			
			
if ($_POST['min_start+5']) {                        
	$wynik = $pdo->query("select min_start from temp");
	foreach($wynik as $rekord) {
	$zmienna = $rekord['min_start']; }
	$zmienna = $zmienna + 5;
  if ($zmienna > 59) $zmienna = $zmienna - 60;
		if ($zmienna < 10) {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='0$min_start'"); } 
		else {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='$min_start'"); } } 
	
if ($_POST['min_start-']) { 
	$wynik = $pdo->query("select min_start from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['min_start']; }
	--$zmienna;
		if ($zmienna < 0) $zmienna = $zmienna + 60; 
			if ($zmienna < 10) { 
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='0$min_start'"); }  
		else {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='$min_start'"); } }
			
	if ($_POST['min_start-5']) { 
	$wynik = $pdo->query("select min_start from temp");
  foreach($wynik as $rekord) {
	$zmienna = $rekord['min_start']; }
	$zmienna = $zmienna - 5;
		if ($zmienna < 0) $zmienna = $zmienna + 60;
			if ($zmienna < 10) { 
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='0$min_start'"); }  
		else {
			$min_start = $zmienna;
			$pdo->exec("update temp set min_start='$min_start'"); } }
	
	$temp = $pdo->query("select os from temp");
  foreach($temp as $rekord_temp) {
	$os = $rekord_temp['os']; }
	
	
if ($_POST['zapisz'])  {  if ($os == 0) {

	$pdo->exec("update temp set test='0'");

	$temp = $pdo->query("select id,data_start,godz_start,min_start,godz_stop,min_stop,mies,dzien from temp");
  foreach($temp as $rekord_temp) {
	$id = $rekord_temp['id'];
	$data = $rekord_temp['data_start'];
	$godz_start = $rekord_temp['godz_start'];
	$min_start = $rekord_temp['min_start'];
	$godz_stop = $rekord_temp['godz_stop'];
	$min_stop = $rekord_temp['min_stop'];
	$mies = $rekord_temp['mies'];
	$dzien = $rekord_temp['dzien']; }
	
	$start_temp = "$godz_start:$min_start";
	$stop_temp = "$godz_stop:$min_stop";
	
	$temp2 = $pdo->query("select stop,notatka from dane where id='$id'");
	foreach($temp2 as $rekord_temp2) {
	$nowa_szychta = $rekord_temp2['stop'];
	$notatka = $rekord_temp2['notatka']; } 
	
	if ($nowa_szychta == NULL) { $id_wstecz = $id - 1;
	
	$test1 = $pdo->query("select data_start,data_stop,stop,pauza_3h,wekend,wekend_dom,przestoj_dom,p9b from dane where id='$id_wstecz'");
  foreach($test1 as $rekord_test1) {
	$data_wstecz_start = $rekord_test1['data_start'];
	$data_wstecz_stop = $rekord_test1['data_stop'];
	$godz_wstecz_stop = $rekord_test1['stop'];
	$pauza_3h = $rekord_test1['pauza_3h'];
	$wekend = $rekord_test1['wekend'];
	$wekend_dom = $rekord_test1['wekend_dom'];
	$przestoj_dom = $rekord_test1['przestoj_dom'];
	$p9_wczoraj = $rekord_test1['p9b']; }
	
  if ($data_wstecz_stop == NULL) { 
	$od = strtotime(date("$data_wstecz_start $godz_wstecz_stop"));
	$od_dni = strftime('%j', strtotime("$data_wstecz_start")); }
	else {
	$od = strtotime(date("$data_wstecz_stop $godz_wstecz_stop")); 
	$od_dni = strftime('%j', strtotime("$data_wstecz_stop")); }
	
	$do = strtotime(date("$data $start_temp"));
	$do_dni = strftime('%j', strtotime("$data"));
	
  $wynik_min = CalcMin($do,$od);
	
  if ($data == $data_wstecz_stop) { if ($start_temp > $godz_wstecz_stop) {

  if ( 660 <= $wynik_min ) {
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='0' where id='$id_wstecz'");
	$info = 'OK'; } else { 
	
	if (($pauza_3h == 1) or ($p9_wczoraj == 1)) { $pauza = 0; $info = 'OK'; } else { $pauza = 1; $info = 'OK P9'; }
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='$pauza' where id='$id_wstecz'"); 
	} } else $info = 'Nie realne'; } else {
	
	if ( 660 <= $wynik_min ) {
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='0' where id='$id_wstecz'");
	$info = 'OK'; } else {
	
	if (($pauza_3h == 1) or ($p9_wczoraj == 1)) {
	$pauza = 0; $info = 'OK'; } else { if ($id > 1) { $pauza = 1; $info = 'OK P9'; } else {$pauza = 0; $info = 'OK';} }
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='$pauza' where id='$id_wstecz'"); } }  

	include('oddaj2.php'); } else {
	
	if ($start_temp > $stop_temp) { ++$id; $notatka = '';
	$pdo->exec("INSERT INTO dane (data_start,start,mies,dzien) VALUES ('$data','$start_temp','$mies','$dzien')");
	$pdo->exec("update temp set id='$id'");	
	$id_wstecz = $id - 1;
	
	$test1 = $pdo->query("select data_start,data_stop,stop,pauza_3h,wekend,wekend_dom from dane where id='$id_wstecz'");
  foreach($test1 as $rekord_test1) {
	$data_wstecz_start = $rekord_test1['data_start'];
	$data_wstecz_stop = $rekord_test1['data_stop'];
	$godz_wstecz_stop = $rekord_test1['stop'];
	$pauza_3h = $rekord_test1['pauza_3h'];
	$wekend = $rekord_test1['wekend'];
	$wekend_dom = $rekord_test1['wekend_dom']; }
	
	$od = strtotime(date("$data_wstecz_stop $godz_wstecz_stop"));
	$do = strtotime(date("$data $start_temp"));
  $wynik_min = CalcMin($do,$od);
	
  if ($data == $data_wstecz_stop) { if ($start_temp > $godz_wstecz_stop) {
	
  if ( 660 <= $wynik_min ) {
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='0' where id='$id_wstecz'");
	$info = 'OK'; } else {
	
	if ($pauza_3h == 1) { $pauza = 0; $info = 'OK'; } else { $pauza = 1; $info = 'OK P9'; }
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='$pauza' where id='$id_wstecz'"); 
	} } else $info = 'Nie realne'; } else {
	
	if ( 660 <= $wynik_min ) {
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='0' where id='$id_wstecz'");
	$info = 'OK'; } else {
	
	if ($pauza_3h == 1) { $pauza = 0; $info = 'OK'; } else { $pauza = 1; $info = 'OK P9'; }
	$pdo->exec("update dane set start='$start_temp' where id='$id'");
	$pdo->exec("update dane set p9a='$pauza' where id='$id_wstecz'"); } }  
	
	include('oddaj2.php'); } else $info = 'Nierealne'; } } else $info = 'Nie realne'; }
	
	$wynik = $pdo->query("select godz_start,min_start from temp");
  foreach($wynik as $rekord) {
	$godz_start = $rekord['godz_start'];
	$min_start = $rekord['min_start']; }
	
?>
<div style="position: absolute; left: 430px; top: 130px"><big><big><h1><?php echo $godz_start; ?></h1></big></big></div>
<div style="position: absolute; left: 490px; top: 125px"><big><big><h1>:</h1></big></big></div>
<div style="position: absolute; left: 520px; top: 130px"><big><big><h1><?php echo $min_start; ?></h1></big></big></div>
<div style="position: absolute; left: 50px; top: 150px"><big><h1><?php echo $info; ?></h1></big></div>
<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Godzina START</h2></big></big></div>

</body>
</html>