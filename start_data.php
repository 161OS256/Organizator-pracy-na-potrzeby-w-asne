<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title>Data Rozpoczęcia</title>

  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
</head>
<body>
<?php include('conect.php'); ?>
<div style="position: absolute; left: 50px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>

<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/start_godz.php><button><h1>Następny<br />krok</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<div style="position: absolute; left: 850px; top: 50px"><button input type="submit" name="dzis" value="dzis"><h1>Dzień<br />dzisiejszy</h1></button></div>

<div style="position: absolute; left: 50px; top: 50px"><button input type="submit" name="zapisz" value="zapisz"><h1>OK<br />>zapisz<</h1></button></div>

<div style="position: absolute; left: 700px; top: 60px"><button input type="submit" name="dzien+" value="dzien+"><h1>(+)</h1></button></div>

<div style="position: absolute; left: 300px; top: 60px"><button input type="submit" name="dzien-" value="dzien-"><h1>( - )</h1></button></div>

<div style="position: absolute; left: 440px; top: 330px"><button input type="submit" name="ost" value="ost"><h1>Ostatnia<br />szychta</h1></button></div>

</form><br />

<?php

	$os = $pdo->query("SELECT id,stop,eu,pl,uk FROM dane order by id asc");
	foreach($os as $rekord) {
	$id = $rekord['id']; 
	$stop = $rekord['stop'];
	$eu = $rekord['eu'];
	$pl = $rekord['pl'];
	$uk = $rekord['uk']; }

	$wynik = $pdo->query("select id,data_start,mies,dzien,os from temp");
	foreach($wynik as $rekord) {
	$id_temp = $rekord['id'];
	$data = $rekord['data_start'];
	$mies = $rekord['mies'];
	$dzien = $rekord['dzien'];
	$os = $rekord['os']; }


if ($_POST['dzis']) { 
  $data = strftime('%Y-%m-%d'); 
  $mies = dateV('F');
  $dzien = dateV('l');
  $pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien'"); }
	
 
if ($_POST['dzien+']) { 
	$data = strftime('%Y-%m-%d', strtotime("$data +1 day"));
	$mies = dateV('F', strtotime("$data"));
	$dzien = dateV('l', strtotime("$data"));
  $pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien'");	}
	

if ($_POST['dzien-']) { 

	$sprawdzenie = $pdo->query("SELECT data_start FROM dane order by id asc");
	foreach($sprawdzenie as $rekord) {
	$data_test = $rekord['data_start']; }
	
	$data = strftime('%Y-%m-%d', strtotime("$data -1 day"));
	$mies = dateV('F', strtotime("$data"));
	$dzien = dateV('l', strtotime("$data"));
	
	if ($data < $data_test) { } else {
  $pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien'"); } } 

	
if ($_POST['ost']) { if ($os == 1) {
	$id; $info = 'Aktualna<br />szychta';
  $pdo->exec("update temp set id='$id', os='0'");
  
 	$os = $pdo->query("SELECT data_start,mies,dzien FROM dane where id='$id'");
	foreach($os as $rekord) {
	$data = $rekord['data_start'];
	$mies = $rekord['mies'];
	$dzien = $rekord['dzien']; } 
  
  $pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien'"); } else {

	--$id; $info = 'Ostatnia<br />szychta';
  $pdo->exec("update temp set id='$id', os='1'");
  
 	$os = $pdo->query("SELECT data_start,mies,dzien FROM dane where id='$id'");
	foreach($os as $rekord) {
	$data = $rekord['data_start'];
	$mies = $rekord['mies'];
	$dzien = $rekord['dzien']; } 
  
  $pdo->exec("update temp set data_start='$data', data4='$data', mies='$mies', mies2='$mies', dzien='$dzien'"); } }

	
if ($_POST['zapisz']) {

  if (($stop == NULL) and ($id_temp > 0)) $info = 'Zakończ poprzednią<br />szychte Godz STOP'; else 
	
	if ((($eu == 0) and ($pl == 0) and ($uk == 0)) and ($id_temp > 0)) $info = 'Zakończ poprzednią<br />szychte PL, EU, UK ?'; else {

	$sprawdzenie = $pdo->query("SELECT id,data_start FROM dane where data_start='$data' order by id asc");
		foreach($sprawdzenie as $rekord) {
    $id = $rekord['id'];
		$sprawdzenie2 = $rekord['data_start']; }
		
	if ($sprawdzenie2 > NULL) { 
		$pdo->exec("update temp set id='$id', mies2='$mies'"); 
    $info = 'Ok'; } else {

	  $pdo->exec("update temp set mies2='$mies'");	
    $pdo->exec("INSERT INTO dane (data_start,mies,dzien) VALUES ('$data','$mies','$dzien')");
	
		++$id;
		
		$pdo->exec("update temp set id='$id'");
		$info = 'Ok'; } } }  
	
	$wynik = $pdo->query("select data_start,mies,dzien from temp");
	foreach($wynik as $rekord) {
	$data = $rekord['data_start'];
	$mies = $rekord['mies'];
	$dzien = $rekord['dzien']; }
?> 

<div style="position: absolute; left: 420px; top: 10px"><big><big><h1><?php echo $data; ?></h1></big></big></div>

<div style="position: absolute; left: 380px; top: 70px"><big><big><h1><?php echo $dzien; ?></h1></big></big></div>

<div style="position: absolute; left: 50px; top: 150px"><big><big><h2><?php echo $info; ?></h2></big></big></div>

<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Data rozpoczęcia</h2></big></big></div>

</body>
</html>