<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Zakończenie Szychty </title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>
<div style="position: absolute; left: 45px; top: 330px"><a href=\cigla/stop_godz.php><button><h1>Poprzednia<br />strona</h1></button></a></div>
<div style="position: absolute; left: 820px; top: 330px"><a href=\cigla/kopia.php><button><h1>Koniec dnia<br />>Fajrant<</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<div style="position: absolute; left: 45px; top: 50px"><button input type="submit" name="wik" value="wik"><h1>Wikend<br />w trasie</h1></button></div>
<div style="position: absolute; left: 890px; top: 50px"><button input type="submit" name="jazda" value="jazda"><h1>Jazda<br />10h</h1></button></div>
<div style="position: absolute; left: 570px; top: 330px"><button input type="submit" name="przest" value="przest"><h1>Przestój<br />w domu</h1></button></div>
<div style="position: absolute; left: 250px; top: 50px"><button input type="submit" name="eu" value="eu"><h1>Dniwka<br />EU</h1></button></div>
<div style="position: absolute; left: 460px; top: 50px"><button input type="submit" name="pl" value="pl"><h1>Dniwka<br />PL</h1></button></div>
<div style="position: absolute; left: 680px; top: 50px"><button input type="submit" name="uk" value="uk"><h1>Nocleg<br />UK</h1></button></div>
<div style="position: absolute; left: 320px; top: 330px"><button input type="submit" name="wik_dom" value="wik_dom"><h1>Wekend<br />w domu</h1></button></div>
</form><br />
<?php
$wynik = $pdo->query("select id from temp");
foreach($wynik as $rekord) {
$id = $rekord['id']; }

$wynik1 = $pdo->query("select data_stop,eu,pl,uk from dane where id='$id'");
foreach($wynik1 as $rekord1) {
$eu = $rekord1['eu'];
$pl = $rekord1['pl'];
$uk = $rekord1['uk'];
$data_stop = $rekord1['data_stop']; }

if ($_POST['eu']) { if (($pl==2) or ($eu==2)) {} else {
 if ($eu <> 1) $pdo->exec("update dane set eu='1', pl='0', uk='0' where id='$id'"); 
 else $pdo->exec("update dane set eu='0' where id='$id'"); } } 
	
if ($_POST['pl']) { if (($pl==2) or ($eu==2)) {} else {
 if ($pl <> 1) $pdo->exec("update dane set eu='0', pl='1', uk='0' where id='$id'"); 
 else $pdo->exec("update dane set pl='0' where id='$id'"); } }
	
if ($_POST['uk']) { if ($uk <> 1) $pdo->exec("update dane set uk='1' where id='$id'"); 
	else $pdo->exec("update dane set uk='0' where id='$id'");
	if ($eu == 1) $pdo->exec("update dane set eu='0' where id='$id'");
	if ($pl == 1) $pdo->exec("update dane set pl='0' where id='$id'"); } 
	
if ($_POST['wik']) { 
	$wynik2 = $pdo->query("select wekend from dane where id='$id'");
	foreach($wynik2 as $rekord2) {
	$wik_trasa = $rekord2['wekend']; }
	
	if ($wik_trasa == 'x') $pdo->exec("update dane set wekend='0', wekend_dom='0', przestoj_dom='0' where id='$id'"); 
  if ($wik_trasa == '0') $pdo->exec("update dane set wekend='x', wekend_dom='0', przestoj_dom='0' where id='$id'"); } 
	
	if ($_POST['wik_dom']) { 
	$wynik2 = $pdo->query("select wekend_dom from dane where id='$id'");
	foreach($wynik2 as $rekord2) {
	$wik_dom = $rekord2['wekend_dom']; }
	
	if ($wik_dom == 1) $pdo->exec("update dane set wekend=0, wekend_dom='0', przestoj_dom='0' where id='$id'"); 
  if ($wik_dom == 0) $pdo->exec("update dane set wekend=0, wekend_dom='1', przestoj_dom='0' where id='$id'"); } 
	
if ($_POST['jazda']) { 
	$wynik2 = $pdo->query("select jazda_10h from dane where id='$id'");
	foreach($wynik2 as $rekord2) {
	$j10 = $rekord2['jazda_10h'];}
	
  if ($j10 == 1) $pdo->exec("update dane set jazda_10h='0' where id='$id'"); 
  if ($j10 == 0) $pdo->exec("update dane set jazda_10h='1' where id='$id'"); }
	
if ($_POST['przest']) { 
	$wynik2 = $pdo->query("select przestoj_dom from dane where id='$id'");
	foreach($wynik2 as $rekord2) {
	$przestoj_dom = $rekord2['przestoj_dom'];}
	
  if ($przestoj_dom == 1) $pdo->exec("update dane set wekend=NULL, wekend_dom='0', przestoj_dom='0' where id='$id'"); 
  if ($przestoj_dom == 0) $pdo->exec("update dane set wekend=NULL, wekend_dom='0', przestoj_dom='1' where id='$id'"); }

$wynik4 = $pdo->query("select eu,pl,uk,jazda_10h,wekend,wekend_dom, przestoj_dom from dane where id='$id'");
foreach($wynik4 as $rekord4) {
$zmienna1 = $rekord4['jazda_10h']; 
$zmienna2 = $rekord4['wekend']; 
$zmienna3 = $rekord4['wekend_dom'];
$zmienna4 = $rekord4['przestoj_dom'];
$eu = $rekord4['eu'];
$pl = $rekord4['pl'];
$uk = $rekord4['uk']; }

if ($data_stop <> NULL) {
if (($eu == 2) or ($pl == 2) or ($uk == 2)) {
if ($eu == 2) $info1 = 'EU >>>';
if ($pl == 2) $info1 = 'PL >>>';
if ($uk == 2) $info1 = 'EU + Nocleg UK >>>'; 

if ($eu == 1) $info2 = 'EU';
if ($pl == 1) $info2 = 'PL';
if ($uk == 1) $info2 = 'EU + Nocleg UK'; } else {

if ($eu == 1) $info1 = 'EU';
if ($pl == 1) $info1 = 'PL';
if ($uk == 1) $info1 = 'EU + Nocleg UK'; } } else {

if (($eu == 2) or ($pl == 2) or ($uk == 2)) {

if ($eu == 2) $info1 = 'EU';
if ($pl == 2) $info1 = 'PL';
if ($uk == 2) $info1 = 'EU + Nocleg UK'; } else {

if ($eu == 1) $info1 = 'EU';
if ($pl == 1) $info1 = 'PL';
if ($uk == 1) $info1 = 'EU + Nocleg UK'; } }

if ($zmienna1 == 1) $j10h = 'J10h';
if ($zmienna2 == 'x') $wik = 'Wekend w trasie';
if ($zmienna3 == 1) $wik = 'Wekend w domu';
if ($zmienna4 == 1) $wik = 'Przestój Dom';
?>

<div style="position: absolute; left: 450px; top: 200px"><big><h1><?php echo $info1; ?></h1></big></div>
<div style="position: absolute; left: 580px; top: 200px"><big><h1><?php echo $info2; ?></h1></big></div>
<div style="position: absolute; left: 800px; top: 200px"><big><h1><?php echo $j10h; ?></h1></big></div>
<div style="position: absolute; left: 80px; top: 200px"><big><h1><?php echo $wik; ?></h1></big></div>
<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Zakończenie</h2></big></big></div>
</body>
</html>