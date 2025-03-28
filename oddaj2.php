<?php

  $pauza45 = $wynik_min - 2700;
	$pauza24 = $wynik_min - 1440;
	$pauza11 = $wynik_min - 660;
  $pauza9 = $wynik_min - 540; 
	$zalegle = '';
	$napis2 = '';


	$stmt = $pdo->query('SELECT data_oddania,infowik FROM temp');
	foreach($stmt as $row) {
	$data_oddania = $row['data_oddania'];
	$infowik = $row['infowik']; }

	
	
	if (($wekend == 'x') or ($wekend_dom == 1)) {
	
  // wpis pocz�tek wekenda
	$stmt = $pdo->query("SELECT data_start FROM oddawanie where id='1'");
	foreach($stmt as $row) {
	$sprawdzenie = $row['data_start']; }

	
	$stmt1 = $pdo->query("SELECT data_start FROM oddawanie where id='2'");
	foreach($stmt1 as $row1) {
	$sprawdzenie1 = $row1['data_start']; }
	
	$stmt3 = $pdo->query("SELECT data_start,data_stop,stop FROM dane where id='$id_wstecz'");
	foreach($stmt3 as $row3) {
  $data_start_wstecz = $row3['data_start']; 
  $data_stop_wstecz = $row3['data_stop'];
	$stop_wstecz = $row3['stop']; }
	
	if (($sprawdzenie == NULL) or ($sprawdzenie == $data_start_wstecz) or ($sprawdzenie == $data_stop_wstecz)) {
	
	if ($data_stop_wstecz == NULL) $pdo->exec("update oddawanie set data_start='$data_start_wstecz', godz_start='$stop_wstecz' where id='1'"); else 
	$pdo->exec("update oddawanie set data_start='$data_stop_wstecz', godz_start='$stop_wstecz' where id='1'"); } else {
	
	if (($sprawdzenie1 == NULL) or ($sprawdzenie == $data_start_wstecz) or ($sprawdzenie == $data_stop_wstecz)) {

	if ($data_stop_wstecz == NULL) $pdo->exec("update oddawanie set data_start='$data_start_wstecz', godz_start='$stop_wstecz' where id='2'"); else 
	$pdo->exec("update oddawanie set data_start='$data_stop_wstecz', godz_start='$stop_wstecz' where id='2'"); } else {
	
	if ($data_stop_wstecz == NULL) $pdo->exec("update oddawanie set data_start='$data_start_wstecz', godz_start='$stop_wstecz' where id='3'"); else 
	$pdo->exec("update oddawanie set data_start='$data_stop_wstecz', godz_start='$stop_wstecz' where id='3'"); } }

	// wpis koniec wekenda
	

	$pdo->exec("update temp set data_tygodnia='$data', godz_tygodnia='$start_temp'");
	
	$stmt2 = $pdo->query("SELECT data_start,data_stop FROM oddawanie where id='1'");
	foreach($stmt2 as $row2) {
	$sprawdzenie1 = $row2['data_stop'];
	$sp = $row2['data_start']; }
	
	$stmt4 = $pdo->query("SELECT data_start,data_stop FROM oddawanie where id='2'");
	foreach($stmt4 as $row4) {
	$sprawdzenie4 = $row4['data_stop'];
	$sp1 = $row4['data_start'];}
	
	if (($sprawdzenie1 == NULL) or ($sprawdzenie1 == $data)) { if ($sp <> NULL) { 
	$pdo->exec("update oddawanie set data_stop='$data', godz_stop='$start_temp' where id='1'"); $id_24 = 1; } } else {
	
	if (($sprawdzenie4 == NULL) or ($sprawdzenie4 == $data)) { if ($sp1 <> NULL) {
	$pdo->exec("update oddawanie set data_stop='$data', godz_stop='$start_temp' where id='2'"); $id_24 = 2; } } else {
	$pdo->exec("update oddawanie set data_stop='$data', godz_stop='$start_temp' where id='3'"); $id_24 = 2; } }
	

 // obliczanie wekenda
 $pauza24 = 1440 + $pauza24;
 
 $do_oddania = 2700 - $pauza24; $g = 0; $do_oddania0 = $do_oddania; 
 if ($do_oddania > 0) {
 while($do_oddania0 > 59) {
 $do_oddania0 = $do_oddania0 - 60;
 $g = ++$g; } if ($do_oddania0 < 10) $do_oddania0 = "0$do_oddania0";
 
 $oddac_do = strftime('%Y-%m-%d \ %H:%M', strtotime("$data $start_temp +21 day -$do_oddania min"));
 $pdo->exec("update temp set infowik='1'"); 
 $pdo->exec("update oddawanie set do_oddania='$do_oddania' where id='$id_24'");
 $napis2 = "$napis2  *** Wekend do oddania $g:$do_oddania0 do $oddac_do\r\n"; 
 } else { 
 $pdo->exec("update temp set infowik='0'");
 $pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_24'"); 
 } } 
 
 

	if ($data_wstecz_stop == NULL)  $data_w = $data_wstecz_start; else $data_w = $data_wstecz_stop;
	
	$por_mies1 = dateV('F', strtotime("$data_w"));
	$por_mies2 = dateV('F', strtotime("$data"));
	if ($por_mies1 == $por_mies2) $id_zm = $id_wstecz; else $id_zm = $id; 

	
	$nr_dnia = strftime('%d', strtotime($data)); --$nr_dnia;
	
  $wynik_dni = $do_dni - $od_dni; --$wynik_dni;
	
	$wynik_dni1 = $wynik_dni - $nr_dnia;
	if ($wynik_dni1 <= 0) $wynik_dni1 = '0';
	
	$wynik_dni2 = $wynik_dni - $wynik_dni1; 
	if ($wynik_dni2 <= 0) $wynik_dni2 = '0';
	
	if ($wekend == 'x') { 
	if ($wynik_dni >= 1) { 
	$pdo->exec("update dane set wekend='$wynik_dni1' where id='$id_wstecz'"); 
	$pdo->exec("update dane set wekend='$wynik_dni2' where id='$id_zm'"); } }
	
	if (($wekend_dom == 0) and ($wekend == '') and ($przestoj_dom == 0)) {
	if ($wynik_dni >= 1) { 
	$pdo->exec("update dane set przestoj='$wynik_dni1' where id='$id_wstecz'");
	$pdo->exec("update dane set przestoj='$wynik_dni2' where id='$id_zm'"); } }
	
	// oddawanie wekenda
	
	
	if ($data <> $data_oddania) {
 	if (($wekend == 'x') or ($wekend_dom == 1)) {  
	
	include('kast.php');
	
	if (($pauza45 >= $zalegle) and ($zalegle <> '')) { $pauza45 = $pauza45 - $zalegle; 
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'"); 
	$pdo->exec("update temp set data_oddania='$data', infowik='0'");  
	$napis2 = "  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';
	
  include('kast.php');
	
	if (($pauza45 >= $zalegle) and ($zalegle <> '')) { $pauza45 = $pauza45 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'"); 
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n";
	$zalegle = '';
	
  include('kast.php');
	
  if (($pauza45 >= $zalegle) and ($zalegle <> '')) { 
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';
	
	} } } else { if (($infowik == 0) and ($wekend_dom == 0)) { 
	
	include('kast.php');
	
	if (($pauza24 >= $zalegle) and ($zalegle <> '') and ($data <> $stp)) { $pauza24 = $pauza24 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$pdo->exec("update temp set data_oddania='$data'"); 
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n";
	$zalegle = '';

	include('kast.php');

	if (($pauza24 >= $zalegle) and ($zalegle <> '') and ($data <> $stp)) { $pauza24 = $pauza24 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';

  include('kast.php');
	
	if (($pauza24 >= $zalegle) and ($zalegle <> '') and ($data <> $stp)) { $pauza24 = $pauza24 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");  
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';
	} } } }


	
	} } else { 
	
	include('kast.php');
	
  if (($pauza11 >= $zalegle) and ($zalegle <> '')) { $pauza11 = $pauza11 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$pdo->exec("update temp set data_oddania='$data'"); 
	$napis2 = "  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';	

	include('kast.php');	

  if (($pauza11 >= $zalegle) and ($zalegle <> '')) { $pauza11 = $pauza11 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'"); 
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';	

	include('kast.php');	

  if (($pauza11 >= $zalegle) and ($zalegle <> '')) { 
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'"); 
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';
	} } } else {
	
	include('kast.php');
	
  if (($p9_wczoraj == 1) or ($pauza == 1)) { 
  if (($pauza9 >= $zalegle) and ($zalegle <> '')) { $pauza9 = $pauza9 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$pdo->exec("update temp set data_oddania='$data'");
	$napis2 = "  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = '';

	include('kast.php');

  if (($pauza9 >= $zalegle) and ($zalegle <> '')) { $pauza9 = $pauza9 - $zalegle;
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n";
	$zalegle = '';
	
	include('kast.php');	
	
  if (($pauza9 >= $zalegle) and ($zalegle <> '')) {
	$pdo->exec("update oddawanie set data_start=NULL, godz_start=NULL, data_stop=NULL, godz_stop=NULL, do_oddania=NULL where id='$id_0'");
	$napis2 = "$napis2  *** Oddano $oddano wekend z dnia $mba\r\n"; 
	$zalegle = ''; } } } } } } }
	
	$text = "$notatka$napis2" ;
	$pdo->exec("update dane set notatka='$text' where id='$id'"); 
	
	if ($id_wstecz == 0) { $pdo->exec("update temp set data_tygodnia='$data', godz_tygodnia='$start_temp'"); } 

?> 