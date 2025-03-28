<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Wpisy </title>
	
	<link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">

</head>
<body>

<?php include('conect.php'); ?>

<div style="position: absolute; left: 830px; top: 330px"><a href=\cigla/informacje.php><button><h1>>Powrót<<br />informacje</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 630px; top: 380px"><button input type="submit" name="mies+" value="mies+"><big><big><big><b>Następny</b></big></big></big></button></div>

<div style="position: absolute; left: 60px; top: 380px"><button input type="submit" name="mies-" value="mies-"><big><big><big><b>Poprzedni</b></big></big></big></button></div>

<div style="position: absolute; left: 845px; top: 50px"><button input type="submit" name="raport" value="raport"><h2>Wyślij raport<br />na meila</h2></button></div>

<div style="position: absolute; left: 842px; top: 170px"><button input type="submit" name="rejestr" value="wrejestr"><h2>Wyślij rejestr<br />do biura</h2></button></div>
</form><br /><br />

<?php

$wynik = $pdo->query("select data4,mies2 from temp");
foreach($wynik as $rekord) {
$data = $rekord['data4'];
$mies = $rekord['mies2']; }

$rok_dzis = strftime('%Y', strtotime("$data"));

$mies2 = dateV('F', strtotime("$data -1 month"));

if ($_POST['mies+']) {
	$stmt = $pdo->query('SELECT id FROM temp');
	foreach($stmt as $row) {
	$rekord = $row['id'];}
	if ($rekord > 0)
	  $info = ' '; 
	else {
	  $do_bazy1 = "INSERT INTO temp (id) VALUES ('1')";
		$wynik1 = $pdo->exec($do_bazy1);
		  if ($wynik1)
			 $info = 'Rozpoczynamy';
			else
			 $info = 'Error'; }
			 
 $data = strftime('%Y-%m-%d', strtotime("$data +1 month"));
 $mies = dateV('F', strtotime("$data"));

 $pdo->exec("update temp set data4='$data'");
 $pdo->exec("update temp set mies2='$mies'");	}
 
 

if ($_POST['mies-']) {
	$stmt = $pdo->query('SELECT id FROM temp');
	foreach($stmt as $row) {
	$rekord = $row['id'];}
	if ($rekord > 0)
	  $info = ' '; 
	else {
	  $do_bazy1 = "INSERT INTO temp (id) VALUES ('1')";
		$wynik1 = $pdo->exec($do_bazy1);
		  if ($wynik1)
			 $info = 'Rozpoczynamy';
			else
			 $info = 'Error'; }
			 
 $data = strftime('%Y-%m-%d', strtotime("$data -1 month"));
 $mies = dateV('F', strtotime("$data"));
 
 $pdo->exec("update temp set data4='$data'");
 $pdo->exec("update temp set mies2='$mies'");	}

 $mies3 = strftime('%Y-%m', strtotime("$data"));

$info = $mies;
 
$pok_n = 0;
$n = 0; 
$rej_n1 = "
<html>
<body>
  <h2>Rejestr jazd na terenie Niemiec Francji i Austri + Tankowanie agregatu w miesiącu ( $mies )</h2>
	<big><big><b>Niemcy</b></big></big>
<table border =1 cellpadding=5 >
<tr>
	<th>Data wjazdu na<br />terytorium<br /> Niemiec</th><th>Gogzina wjazdu<br /> na terytorium<br /> Niemiec</th>
	<th>Data wyjazdu z<br />terytorium<br /> Niemiec</th><th>Gogzina wyjazdu<br /> z terytorium<br /> Niemiec</th>
	<th>Uwagi</th>
</tr>";

$wynik10 = $pdo->query("select data_wj,godz_wj,data_wy,godz_wy,uwagi,idn from niemcy  where mies='$mies' order by idn  ASC");
foreach($wynik10 as $rekord10) {
$data_wj = $rekord10['data_wj'];
$godz_wj = $rekord10['godz_wj'];
$data_wy = $rekord10['data_wy'];
$godz_wy = $rekord10['godz_wy'];
$uwagi = $rekord10['uwagi'];
$idxn = $rekord10['idn'];

$rok_rn = strftime('%Y', strtotime("$data_wj"));

if ($rok_rn == $rok_dzis) {

if ($n == 0) { if ($data_wj == '') { $idxn2 = $idxn; $n = 1; } }

if ($n == 0) { if ($data_wy == '') { $idxn3 = $idxn; $n = 2; } } 

$lane = "<tr><td>$data_wj</td><td>$godz_wj</td><td>$data_wy</td><td>$godz_wy</td><td>$uwagi</td></tr>"; 

if ($data_wj <> '') $pok_n = 1;

$wiersz_n ="$wiersz_n$lane"; } }


	
	if ($_POST['wjazd']) {
	$d_an = trim($_POST['dan']);
	$g_an = trim($_POST['gan']);
	if (($d_an == '') or ($g_an == '')) echo 'Wypełnij pola'; else
  $pdo->exec("update niemcy set data_wj='$d_an', godz_wj='$g_an' where idn='$idxn2'");
	?><meta http-equiv="refresh" content="0;"><?php }
 
 	if ($_POST['wyjazd']) {
	$d_bn = trim($_POST['dbn']);
	$g_bn = trim($_POST['gbn']);
	$uwn = trim($_POST['uwn']);
	if (($d_bn == '') or ($g_bn == '') or ($uwn == '')) echo 'Wypełnij pola'; else
  $pdo->exec("update niemcy set data_wy='$d_bn', godz_wy='$g_bn', uwagi='$uwn' where idn='$idxn3'");
	?><meta http-equiv="refresh" content="0;"><?php }
 
$rej_n2 = "
</table>
</body>
</html>";

$rejestr_niemcy = "$rej_n1$wiersz_n$rej_n2";

$pok_f = 0;
$f = 0;
$rej_f1 = "
<html>
<body>
  <big><big><b>Francja</b></big></big>
<table border =1 cellpadding=5 >
<tr>
	<th>Data wjazdu na<br />terytorium<br /> Francji</th><th>Gogzina wjazdu<br /> na terytorium<br /> Francji</th>
	<th>Data wyjazdu z<br />terytorium<br /> Francji</th><th>Gogzina wyjazdu<br /> z terytorium<br /> Francji</th>
	<th>Uwagi</th>
</tr>";

$wynik10 = $pdo->query("select data_wj,godz_wj,data_wy,godz_wy,uwagi,idf from francja  where mies='$mies' order by idf  ASC");
foreach($wynik10 as $rekord10) {
$data_wjf = $rekord10['data_wj'];
$godz_wjf = $rekord10['godz_wj'];
$data_wyf = $rekord10['data_wy'];
$godz_wyf = $rekord10['godz_wy'];
$uwagif = $rekord10['uwagi'];
$idxf = $rekord10['idf'];

$rok_rf = strftime('%Y', strtotime("$data_wjf"));

if ($rok_rf == $rok_dzis) {

if ($n == 0) { if ($f == 0) { if ($data_wjf == '') { $idxf2 = $idxf; $f = 1; } } }
 
if ($n == 0) { if ($f == 0) { if ($data_wyf == '') { $idxf3 = $idxf; $f = 2; } } }

$lane = "<tr><td>$data_wjf</td><td>$godz_wjf</td><td>$data_wyf</td><td>$godz_wyf</td><td>$uwagif</td></tr>"; 

if ($data_wjf <> '') $pok_f = 1;

$wiersz_f ="$wiersz_f$lane"; } }



	if ($_POST['wjazdf']) {
	$d_af = trim($_POST['daf']);
	$g_af = trim($_POST['gaf']);
	if (($d_af == '') or ($g_af == '')) echo 'Wypełnij pola'; else
  $pdo->exec("update francja set data_wj='$d_af', godz_wj='$g_af' where idf='$idxf2'");
	?><meta http-equiv="refresh" content="0;"><?php }
 
 	if ($_POST['wyjazdf']) {
	$d_bf = trim($_POST['dbf']);
	$g_bf = trim($_POST['gbf']);
	$uwf = trim($_POST['uwf']);
	if (($d_bf == '') or ($g_bf == '') or ($uwf == '')) echo 'Wypełnij pola'; else 
  $pdo->exec("update francja set data_wy='$d_bf', godz_wy='$g_bf', uwagi='$uwf' where idf='$idxf3'");
	?><meta http-equiv="refresh" content="0;"><?php }

$rej_f2 = "
</table>
</body>
</html>";

$rejestr_francja = "$rej_f1$wiersz_f$rej_f2";

$pok_a = 0;
$a = 0;
$rej_a1 = "
<html>
<body>
  <big><big><b>Austria</b></big></big>
<table border =1 cellpadding=5 >
<tr>
	<th>Data wjazdu na<br />terytorium<br /> Austri</th><th>Gogzina wjazdu<br /> na terytorium<br /> Austri</th>
	<th>Data wyjazdu z<br />terytorium<br /> Austri</th><th>Gogzina wyjazdu<br /> z terytorium<br /> Austri</th>
	<th>Uwagi</th>
</tr>";

$wynik10 = $pdo->query("select data_wj,godz_wj,data_wy,godz_wy,uwagi,ida from austria  where mies='$mies' order by ida  ASC");
foreach($wynik10 as $rekord10) {
$data_wja = $rekord10['data_wj'];
$godz_wja = $rekord10['godz_wj'];
$data_wya = $rekord10['data_wy'];
$godz_wya = $rekord10['godz_wy'];
$uwagia = $rekord10['uwagi'];
$idxa = $rekord10['ida'];

$rok_ra = strftime('%Y', strtotime("$data_wja"));

if ($rok_ra == $rok_dzis) {

if ($n == 0) { if ($f == 0) { if ($a == 0) { if ($data_wja == '') { $idxa2 = $idxa; $a = 1; } } } }
 
if ($n == 0) { if ($f == 0) { if ($a == 0) { if ($data_wya == '') { $idxa3 = $idxa; $a = 2; } } } }

$lane = "<tr><td>$data_wja</td><td>$godz_wja</td><td>$data_wya</td><td>$godz_wya</td><td>$uwagia</td></tr>"; 

if ($data_wja <> '') $pok_a = 1;

$wiersz_a ="$wiersz_a$lane";  } }



	if ($_POST['wjazda']) {
	$d_aa = trim($_POST['daa']);
	$g_aa = trim($_POST['gaa']);
	if (($d_aa == '') or ($g_aa == '')) echo 'Wypełnij pola'; else
  $pdo->exec("update austria set data_wj='$d_aa', godz_wj='$g_aa' where ida='$idxa2'");
	?><meta http-equiv="refresh" content="0;"><?php }
 
 	if ($_POST['wyjazda']) {
	$d_ba = trim($_POST['dba']);
	$g_ba = trim($_POST['gba']);
	$uwa = trim($_POST['uwa']);
	if (($d_ba == '') or ($g_ba == '') or ($uwa == '')) echo 'Wypełnij pola'; else 
  $pdo->exec("update austria set data_wy='$d_ba', godz_wy='$g_ba', uwagi='$uwa' where ida='$idxa3'");
	?><meta http-equiv="refresh" content="0;"><?php }

$rej_a2 = "
</table>
</body>
</html>";

$rejestr_austria = "$rej_a1$wiersz_a$rej_a2";

$agr = 0;
$agr_a1 = "
<html>
<body>
  <big><big><b>Tankowanie agregatu</b></big></big>
<table border =1 cellpadding=5 >
<tr><th>Data</th><th>Litry</th><th>Motogodziny</th><th>Naczepa</th></tr>";

$wynik10 = $pdo->query("select data,litry,motogodz,naczepa from agregat  where mies='$mies' order by id  ASC");
foreach($wynik10 as $rekord10) {
$data_agr = $rekord10['data'];
$litry = $rekord10['litry'];
$motogodz = $rekord10['motogodz'];
$nr_naczepa = $rekord10['naczepa'];

$rok_ragr = strftime('%Y', strtotime("$data_agr"));

if ($rok_ragr == $rok_dzis) {
$lane = "<tr><td>$data_agr</td><td>$litry</td><td>$motogodz</td><td>$nr_naczepa</td></tr>"; 

if($data_agr <> '') $agr = 1;
$wiersz_agr ="$wiersz_agr$lane"; } }

$agr_a2 = "
</table>
</body>
</html>";

$agregat = "$agr_a1$wiersz_agr$agr_a2";

if ($agr == 1) $agregat = "$agregat<br />"; else $agregat = '<big><big><b>Tankowanie agregatu</b></big></big> niebyło tankowania.<br /><br />';


if ($pok_n == 1) $rejestr_niemcy = "$rejestr_niemcy<br />"; else $rejestr_niemcy = '<big><big><b>Niemcy</b></big></big> niebyło przejazdów.<br /><br />';
if ($pok_f == 1) $rejestr_francja = "$rejestr_francja<br />"; else $rejestr_francja = '<big><big><b>Francja</b></big></big> niebyło przejazdów.<br /><br />';
if ($pok_a == 1) $rejestr_austria = "$rejestr_austria<br />"; else $rejestr_austria = '<big><big><b>Austria</b></big></big> niebyło przejazdów.<br /><br />';

$rejestry = "$rejestr_niemcy$rejestr_francja$rejestr_austria$agregat";

?>

<div style="position: absolute; left: 50px; top: 15px"><textarea cols="88" rows="18" disabled="disabled">
<?php

$wynik2 = $pdo->query("select data_start,start,data_stop,stop,dzien,p9a,p9b,jazda_10h,notatka,eu,pl,uk,wekend,wekend_dom,przestoj,przestoj_dom,pauza_3h from dane where mies='$mies' order by id  ASC");

 foreach($wynik2 as $rekord2) {
 $p9a = $rekord2['p9a'];
 $p9b = $rekord2['p9b'];
 $jazda_10h = $rekord2['jazda_10h'];
 $eu = $rekord2['eu'];
 $pl = $rekord2['pl'];
 $uk = $rekord2['uk'];
 $wekend = $rekord2['wekend'];
 $wekend_dom = $rekord2['wekend_dom'];
 $przestoj = $rekord2['przestoj'];
 $przestoj_dom = $rekord2['przestoj_dom'];
 $data_stop = $rekord2['data_stop'];
 $ns_dz = $rekord2['data_stop'];
 $spr_rok = $rekord2['data_start'];
 $pauza_3h = $rekord2['pauza_3h'];

 $rok = strftime('%Y', strtotime("$spr_rok"));
 
 if ($rok == $rok_dzis) {
 
 if($ns_dz) $ns_dz = " $ns_dz"; else $ns_dz = '';
 
 $dniowka1 = ' ';
 $dniowka2 = ' ';
 $dniowka3 = ' ';
 
 if ($data_stop <> NULL) {
 if (($eu == 2) or ($pl == 2) or ($uk == 2)) {
 
 if ($eu == 2) $dniowka1 = 'EU >>>';
 if ($pl == 2) $dniowka1 = 'PL >>>';
 if ($uk == 2) $dniowka1 = 'Eu + Nocleg UK >>>';
 
 if ($eu == 1) $dniowka2 = 'EU';
 if ($pl == 1) $dniowka2 = 'PL';
 if ($uk == 1) $dniowka2 = 'Eu + Nocleg UK'; } else {
 
 if ($eu == 1) $dniowka1 = 'EU';
 if ($pl == 1) $dniowka1 = 'PL';
 if ($uk == 1) $dniowka1 = 'Eu + Nocleg UK'; } } else {
 
 if (($eu == 2) or ($pl == 2) or ($uk == 2)) {
 if ($eu == 2) $dniowka1 = 'EU';
 if ($pl == 2) $dniowka1 = 'PL';
 if ($uk == 2) $dniowka1 = 'Eu + Nocleg UK'; } else {
 
 if ($eu == 1) $dniowka1 = 'EU';
 if ($pl == 1) $dniowka1 = 'PL';
 if ($uk == 1) $dniowka1 = 'Eu + Nocleg UK'; } }
 
 if ($wekend == 'x') $dniowka3 = 'Wekend w trakcie';
 if ($wekend >= 1) $dniowka3 = 'Wekend w trasie'; 
 if ($wekend_dom == 1) $dniowka3 = 'Wekend w domu';
 if ($przestoj >= 1) $dniowka3 = 'Przestój';
 if ($przestoj_dom == 1) $dniowka3 = 'Przestój w domu';
 
 if (($p9a == 1) or ($p9b == 1)) { $p9h = "  *** Pauza 9h \n";
 if ($jazda_10h == 1) {
 $p9h = '  *** Pauza 9h';
 $j10h = " Jazda 10h \n"; } else $j10h = ''; } else { $p9h = ''; 
 if ($jazda_10h == 1) $j10h = "  *** Jazda 10h \n"; else $j10h = ''; }
 
 if (($jazda_10h == 0) and ($pauza_3h == 1)) $p9h = "  *** Pauza 3h+9h \n";
 if (($jazda_10h == 1) and ($pauza_3h == 1)) { 
 $p9h = '  *** Pauza 3h+9h';
 $j10h = " Jazda 10h \n"; } 
 
 if($ns_dz == NULL) $x7 = ''; else {
 $ns_dz = strftime('%d', strtotime("$ns_dz"));
 $x7 = "/$ns_dz"; }
 
 echo "\n" . "  " . $rekord2['data_start'] . $x7 . " Start " . $rekord2['start'] . " /" . " Stop " .  $rekord2['stop']. "   " . $rekord2['dzien'] . "  " . $dniowka1 . " " . $dniowka2 . "  " . $dniowka3 . "\n" . $rekord2['notatka'] . $p9h . $j10h ; } } 
?> 
 </textarea></div>
<?php
 
 if ($_POST['raport']) { 
 
  include('zapis_txt.php');
 
	$start=time();
	
	require 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                     
	$mail->Host = 'smtp.gmail.com';  
	$mail->SMTPAuth = true; 
	$mail->Username = 'cigla93@gmail.com';  
	$mail->Password = 'kochamcieAniu110';  
	$mail->SMTPSecure = 'tls';   
	$mail->Port = 587; 

	$mail->setFrom('cigla93@gmail.com', 'Tablet');
	$mail->addAddress('marek-bartocha@hotmail.com', 'Marek Bartocha'); 

	$mail->isHTML(true);    

	$mail->Subject = "Raport z $mies3 ";
	$mail->Body    = "$dane";
	$mail->CharSet = "UTF-8";
	
  $mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true ) ) );

  if(!$mail->send()) { $info2 = 'Nie wysłano raportu.'; } else {  $info2 = 'Raport wysłany.'; }
	
	$stop=time();
	
	$ile=round($stop-$start, 2);
	$info1 = "Czas $ile sek."; 
	
	$info3 = "$info1<br />$info2"; }
	
	
	 if ($_POST['rejestr']) {
	
	$start=time();
	
	require 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                                     
	$mail->Host = 'smtp.gmail.com';  
	$mail->SMTPAuth = true; 
	$mail->Username = 'cigla93@gmail.com';  
	$mail->Password = 'kochamcieAniu110';  
	$mail->SMTPSecure = 'tls';   
	$mail->Port = 587; 

	$mail->setFrom('cigla93@gmail.com', 'Marek Bartocha');
	$mail->addAddress('a.zymolka@cebulatransport.pl', 'Ola'); 
	$mail->addAddress('ania@cebulatransport.pl', 'Ania'); 
	$mail->isHTML(true);    

	$mail->Subject = "Rejestry z $mies3 ";
	$mail->Body    = "$rejestry";
	$mail->CharSet = "UTF-8";
	
  $mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true ) ) );

  if(!$mail->send()) { $info2 = 'Nie wysłano rejestru.'; } else {  $info2 = 'Rejestr wysłany.'; }
	
	$stop=time();
	
	$ile=round($stop-$start, 2);
	$info1 = "Czas $ile sek."; 
	
	$info3 = "$info1<br />$info2"; } 
	
	$rok2 = strftime('%Y', strtotime("$data"));

	
?>
<div style="position: absolute; left: 250px; top: 355px"><big><big><h2><?php echo "$rok2 - "; echo $info; ?></h2></big></big></div>
<div style="position: absolute; left: 810px; top: 240px"><h3><?php echo $info3; ?></h3></div>
<div style="position: absolute; left: 0px; top: 550px"><?php echo $rejestry; ?></div>

	<?php
	if ($n == 1) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Niemcy Data wjazdu <input size="10" name="dan" /> Godzina wjazdu <input size="5" name="gan" />
  <button input type="submit" name="wjazd" value="wjazd">Zapisz</button>
  </form> <?php }
	
	if ($n == 2) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Niemcy Data wyjazdu <input size="10" name="dbn" /> Godzina wyjazdu <input size="5" name="gbn" /> Uwagi <input size="7" name="uwn" />
  <button input type="submit" name="wyjazd" value="wyjazd">Zapisz</button>
  </form> <?php } 

  if ($f == 1) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Francja Data wjazdu <input size="10" name="daf" /> Godzina wjazdu <input size="5" name="gaf" />
  <button input type="submit" name="wjazdf" value="wjazdf">Zapisz</button>
  </form>
	<?php }
	
	if ($f == 2) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Francja Data wyjazdu <input size="10" name="dbf" /> Godzina wyjazdu <input size="5" name="gbf" /> Uwagi <input size="7" name="uwf" />
  <button input type="submit" name="wyjazdf" value="wyjazdf">Zapisz</button>
  </form>
	<?php }
	
	if ($a == 1) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Austria Data wjazdu <input size="10" name="daa" /> Godzina wjazdu <input size="5" name="gaa" />
  <button input type="submit" name="wjazda" value="wjazda">Zapisz</button>
  </form>
	<?php }
	
	if ($a == 2) { ?><div style="position: absolute; left: 0px; top: 520px">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Austria Data wyjazdu <input size="10" name="dba" /> Godzina wyjazdu <input size="5" name="gba" /> Uwagi <input size="7" name="uwa" />
  <button input type="submit" name="wyjazda" value="wyjazda">Zapisz</button>
  </form>
	<?php }
?>

</body>
</html>