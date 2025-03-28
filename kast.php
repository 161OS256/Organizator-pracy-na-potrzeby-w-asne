	<?php
	$stmt5 = $pdo->query("SELECT id,data_start,data_stop,do_oddania FROM oddawanie where id='1'");
	foreach($stmt5 as $row5) {
	$id_5 = $row5['id'];
	$spr_5 = $row5['data_start'];
	$stp5 = $row5['data_stop'];
	$zalegle5 = $row5['do_oddania']; }
	
	$stmt6 = $pdo->query("SELECT id,data_start,data_stop,do_oddania FROM oddawanie where id='2'");
	foreach($stmt6 as $row6) {
	$id_6 = $row6['id'];
	$spr_6 = $row6['data_start'];
	$stp6 = $row6['data_stop'];
	$zalegle6 = $row6['do_oddania']; }
	
	$stmt7 = $pdo->query("SELECT id,data_start,data_stop,do_oddania FROM oddawanie where id='3'");
	foreach($stmt7 as $row7) {
	$id_7 = $row7['id'];
	$spr_7 = $row7['data_start'];
	$stp7 = $row7['data_stop'];
	$zalegle7 = $row7['do_oddania']; }
	
	
	if (($spr_5 <> NULL) and ($$spr_6 <> NULL) and ($spr_7 <> NULL) ) { 
	if ($spr_5 < $spr_6) { $spr = $spr_5; $zalegle_a = $zalegle5; $id_0a = $id_5; $stpa = $stp5; } else { 
	$spr = $spr_6; $zalegle_a = $zalegle6; $id_0a = $id_6; $stpa = $stp6; }
	if ($spr < $spr_7) { $zalegle = $zalegle_a; $id_0 = $id_0a; $stp = $stpa; } else { $zalegle = $zalegle7; $id_0 = $id_7; $stp = $stp7; } } else {
	
	if (($spr_5 <> NULL) and ($spr_6 <> NULL)) { 
	if ($spr_5 < $spr_6) { $zalegle = $zalegle5; $id_0 = $id_5; $stp = $stp5; } else { $zalegle = $zalegle6; $id_0 = $id_6; $stp = $stp6;} } 
	if (($spr_5 <> NULL) and ($spr_7 <> NULL)) { 
	if ($spr_5 < $spr_7) { $zalegle = $zalegle5; $id_0 = $id_5; $stp = $stp5; } else { $zalegle = $zalegle7; $id_0 = $id_7; $stp = $stp7; } }
	if (($spr_6 <> NULL) and ($spr_7 <> NULL)) { 
	if ($spr_6 < $spr_7) { $zalegle = $zalegle6; $id_0 = $id_6; $stp = $stp6; } else { $zalegle = $zalegle7; $id_0 = $id_7; $stp = $stp7; } } }
	
	if ($zalegle == '') {
  if ($spr_5 <> NULL) { $zalegle = $zalegle5; $id_0 = $id_5; $stp = $stp5; }
	if ($spr_6 <> NULL) { $zalegle = $zalegle6; $id_0 = $id_6; $stp = $stp6; }
	if ($spr_7 <> NULL) { $zalegle = $zalegle7; $id_0 = $id_7; $stp = $stp7; } }
	
	$mba1 = $pdo->query("SELECT data_start FROM oddawanie where id='$id_0'");
  foreach($mba1 as $mbar) {
	$mba = $mbar['data_start']; }
	
	
	$go = 0; $zalegle0 = $zalegle; 
	if ($zalegle > 0) {
	while($zalegle0 > 59) {	$zalegle0 = $zalegle0 - 60;	$go = ++$go; } 
	if ($zalegle0 < 10) $zalegle0 = "0$zalegle0";
	$oddano = "$go:$zalegle0"; }
	?>