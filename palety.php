<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Palety </title>
  <link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
	
	<style type="text/css">  
 
input {border:1px solid black; margin-bottom:3px; }
input.krotki {width:80px; text-align:center;}
 
div.clndr
{ 
 background-color:#d0d0d0;  position:absolute; 
 cursor:default; display:none; border:3px ridge #9ab; left: 40px; top: 242px 
}
 
div.clndr table
{ 
 COLOR:black;
 width:180px; margin:4px; 
}
 
 
div.clndr th
{
 border:1px solid black;
 font:normal bold 15px arial,sans-serif;
 text-align:center; padding:0 2px 0 2px;
}
 
div.clndr td
{
 border:1px solid black; cursor:pointer;
 font:normal normal 15px arial,sans-serif;
 text-align:center; padding:0 2px 0 2px;
}
 
</style>
 
<script type="text/javascript"> 


 
function Calendar(E,T)
{
 if(!document.getElementById||!document.body.appendChild)return
 var i,j,tBody,Row,od,Do,d,dt
 function cEl(t,p,h,w)
{
	p.appendChild(t=document.createElement(t))
	if(h)t.innerHTML=h;if(w)t.style.width='27px'
	return t
}
 function cB(x)
{
 with(cld_BlaTek)
{
	B=0;x==0?R--:x==1?R++:x==2?(!M?(M=11,R--):M--):(M==11?(M=0,R++):M++)
}
}
 with(cld_BlaTek)
{
	od=Date.UTC(R,M,1);Do=Date.UTC(R,M+1,1)
}
 E=document.getElementById(E)
 while(E.childNodes.length)E.removeChild(E.firstChild)
 tBody=cEl('tbody',cEl('table',E))
 tBody.onmouseup=function()
{
T.focus()
}
 tBody.onmousemove=function()
{
	if(window.getSelection)window.getSelection().removeAllRanges()
}
 Row=cEl('tr',tBody)
 cEl('td',Row,'&laquo;',1).onmousedown=function(){cB(0)
}
 cEl('th',Row,cld_BlaTek.R)
 cEl('td',Row,'&raquo;',1).onmousedown=function(){cB(1)
}
 Row=cEl('tr',tBody)
 cEl('td',Row,'&laquo;',1).onmousedown=function(){cB(2)
}
 cEl('th',Row,cld_BlaTek.month[cld_BlaTek.M])
 cEl('td',Row,'&raquo;',1).onmousedown=function(){cB(3)
}
 
 tBody=cEl('tbody',cEl('table',E))
 Row=cEl('tr',tBody)
 for(i=0;i<7;i++)
	with(cEl('th',Row,cld_BlaTek.day[i]))
	 if(i==6)style.backgroundColor='#f88'
 
 for(i=od;i<Do;i+=86400000)
{
	with(new Date(i)){d=getUTCDate();dt=getUTCDay()
}
	if(dt==1||i==od)Row=cEl('tr',tBody)
	if(dt!=1&&d==1)for(j=1;j<(dt?dt:7);j++)cEl('th',Row)
	dt=cEl('td',Row,d);
	
dt.onmousedown=function(x,y){
   y=+this.innerHTML
   with(cld_BlaTek)
T.value=R+ '-' + ((x=M+1)<10?'0'+x:x) +'-'+ (y<10?'0'+y:y)
  }
	with(cld_BlaTek)
	if(d==D.getDate()&&M==D.getMonth()&&R==D.getFullYear())
	 dt.style.backgroundColor='#fff'
}
 T.onblur=function(){if(cld_BlaTek.B)E.style.display='none'
}
 cld_BlaTek.B=1;E.style.display='block'
}
 
cld_BlaTek=
{
 day:['pn','wt','śr','cz','pt','so','n'],
 month:['styczeń','luty','marzec','kwiecień','maj','czerwiec',
 'lipiec','sierpień','wrzesień','październik','listopad','grudzień'],
 D:new Date(),M:new Date().getMonth(),R:new Date().getFullYear()
}



</script>
	
</head>

<body>
<?php
 include('conect.php'); 
 $ostx = $pdo->query("select data_start,ost from temp ");
 foreach($ostx as $rekord_ost) {
 $ost = $rekord_ost['ost']; 
 $ost2 = $rekord_ost['data_start']; }
 ?>
 
 <div style="position: absolute; left: 30px; top: 235px"><iframe width="210" height="190" style="background-color: <?php echo $farba ?>;" >...</iframe></div>
<div style="position: absolute; left: 840px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<div style="position: absolute; left: 50px; top: 50px"><button input type="submit" name="zapisz" value="zapisz"><h1>OK<br />>zapisz<</h1></button></div>

<div style="position: absolute; left: 770px; top: 180px">
<button input type="submit" name="1" value="1" style="width:50px; height: 60px;"><big><big><big><big><b>1</b></big></big></big></big></button></div>

<div style="position: absolute; left: 840px; top: 180px">
<button input type="submit" name="2" value="2" style="width:50px; height: 60px;"><big><big><big><big><b>2</b></big></big></big></big></button></div>

<div style="position: absolute; left: 910px; top: 180px">
<button input type="submit" name="3" value="3" style="width:50px; height: 60px;"><big><big><big><big><b>3</b></big></big></big></big></button></div>

<div style="position: absolute; left: 770px; top: 110px">
<button input type="submit" name="4" value="4" style="width:50px; height: 60px;"><big><big><big><big><b>4</b></big></big></big></big></button></div>

<div style="position: absolute; left: 840px; top: 110px">
<button input type="submit" name="5" value="5" style="width:50px; height: 60px;"><big><big><big><big><b>5</b></big></big></big></big></button></div>

<div style="position: absolute; left: 910px; top: 110px">
<button input type="submit" name="6" value="6" style="width:50px; height: 60px;"><big><big><big><big><b>6</b></big></big></big></big></button></div>

<div style="position: absolute; left: 770px; top: 40px">
<button input type="submit" name="7" value="7" style="width:50px; height: 60px;"><big><big><big><big><b>7</b></big></big></big></big></button></div>

<div style="position: absolute; left: 840px; top: 40px">
<button input type="submit" name="8" value="8" style="width:50px; height: 60px;"><big><big><big><big><b>8</b></big></big></big></big></button></div>

<div style="position: absolute; left: 910px; top: 40px">
<button input type="submit" name="9" value="9" style="width:50px; height: 60px;"><big><big><big><big><b>9</b></big></big></big></big></button></div>

<div style="position: absolute; left: 770px; top: 250px">
<button input type="submit" name="x" value="x" style="width:50px; height: 60px;"><big><big><big><big><b>0</b></big></big></big></big></button></div>

<div style="position: absolute; left: 840px; top: 250px">
<button input type="submit" name="res" value="res" style="width:120px; height: 60px;"><big><big><big><big><b>Reset</b></big></big></big></big></button></div>


<div style="position: absolute; left: 470px; top: 50px"><button type="submit" name="zdane"  value="zdane"/><big><big><big><big><b>></b></big></big></big></big></button></div>

<div style="position: absolute; left: 470px; top: 150px"><button type="submit" name="pobrane"  value="pobrane"/><big><big><big><big><b>></b></big></big></big></big></button></div>

<div style="position: absolute; left: 280px; top: 290px"><big><big><h3>Uwagi <input size="46" name="text" /></h3></big></big></div>

<div style="position: absolute; left: 58px; top: 250px"><button input type="submit" name="wyslij" value="wyslij"><big><big><b>Wyślij do biura</b></big></big></button></div>

<div style="position: absolute; left: 60px; top: 300px"><button input type="submit" name="pokaz" value="pokaz"><big><big><b>Pokaż podgląd</b></big></big></button></div>

<div style="position: absolute; left: 70px; top: 370px">Od <input class="krotki" readonly name="od" value="<?php echo $ost ?>" onfocus="Calendar('DatePicker1',this)"></div>

<div style="position: absolute; left: 70px; top: 400px">Do <input class="krotki" readonly name="do" value="<?php echo $ost2 ?>" onfocus="Calendar('DatePicker2',this)"></div>

<div style="position: absolute; left: 70px; top: 340px">Od ostatniej karty <input type="checkbox" checked="checked" name="id" value="
id" /></div>

<div id="DatePicker1" class="clndr"></div>

<div id="DatePicker2" class="clndr"></div>


</form><br />
<?php

setlocale(LC_ALL, 'pl_PL', 'pl', 'Polish_Poland.28592');



$wynik = $pdo->query("select id,usun,zp from temp ");
 foreach($wynik as $rekord) {
$usun = $rekord['usun'];
$id = $rekord['id'];
$zp = $rekord['zp']; }

$usuwanie = "update temp set usun='0'";
$wynik_usuwanie = $pdo->exec($usuwanie);
	if ($wynik_usuwanie) $info = '';

 if ($_POST['zdane'])  $pdo->exec("update temp set zp='1'"); 
 
 if ($_POST['pobrane']) $pdo->exec("update temp set zp='2'"); 
	
 if ($zp == 1) $tor = 'zdane';
 if ($zp == 2) $tor = 'pobrane';
	
if ($_POST['1']) { $numer = 1;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }
	
if ($_POST['2']) { $numer = 2;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }
 
if ($_POST['3']) { $numer = 3;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['4']) { $numer = 4;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['5']) { $numer = 5;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['6']) { $numer = 6;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['7']) { $numer = 7;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['8']) { $numer = 8;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['9']) { $numer = 9;
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }

if ($_POST['x']) { $numer = "0";
$wynik = $pdo->query("select $tor from temp");
foreach($wynik as $rekord) {
$zmienna = $rekord["$tor"]; }
$save = "$zmienna$numer";  
$pdo->exec("update temp set $tor='$save'"); }
	
if ($_POST['res']) { $save = 0;
$pdo->exec("update temp set $tor='$save'"); } 		

	
if ($_POST['zapisz']) { 	

$wynik = $pdo->query("select zdane,pobrane,miejsce,data_start from temp");
foreach($wynik as $rekord) {
$zdane = $rekord['zdane'];
$pobrane = $rekord['pobrane']; 
$miejsce = $rekord['miejsce']; 
$data = $rekord['data_start']; } 

$wynik2 = $pdo->query("select stan,moje from palety order by idp  ASC");
foreach($wynik2 as $rekord2) {
$stan = $rekord2['stan'];
$moje = $rekord2['moje']; }

$uwagi = trim($_POST['text']);

$nowy_stan = $stan - $zdane + $pobrane;

If (($uwagi == 'Moja') or ($uwagi == 'Moje') or ($uwagi == 'Moich')) $moje_stan = $moje + $pobrane - $zdane; else $moje_stan = $moje;


if (($uwagi == '') or (($zdane == 0) and ($pobrane == 0))) $info= 'Ustaw wartości<br />Wpisz Uwagi';  else {

$pdo->exec("INSERT INTO palety (data,miejsce,zdane,pobrane,stan,uwagi,moje) VALUES ('$data','$miejsce','$zdane','$pobrane','$nowy_stan','$uwagi','$moje_stan')");

$wynik_zapisz = $pdo->query("select notatka from dane where id='$id'");
foreach($wynik_zapisz as $rekord_zapisz) {
$stary_text = $rekord_zapisz['notatka']; }
$text = "$stary_text  *** Wymiana palet $uwagi \r\n      Zdane $zdane Pobrane $pobrane    Stan $nowy_stan \r\n" ;
 
$pdo->exec("update dane set notatka='$text' where id='$id'"); $info = 'Ok'; }
	
$zdane = 0;
$pdo->exec("update temp set zdane='$zdane'");			

$pobrane = 0;
$pdo->exec("update temp set pobrane='$pobrane'");	} 
	
	
$wynik2 = $pdo->query("select zdane,pobrane,naczepa,ost_idp,ost_idk from temp");
foreach($wynik2 as $rekord2) {
$zdane_k = $rekord2['zdane'];
$pobrane_k = $rekord2['pobrane'];
$naczepa = $rekord2['naczepa'];
$ost_idp = $rekord2['ost_idp'];
$ost_idk = $rekord2['ost_idk']; }

	$data_od = trim($_POST['od']); 
	
	$data_do = trim($_POST['do']);
	
	if ($_POST['id']) {
	
	$wynik11 = $pdo->query("select zdane,pobrane,stan,uwagi,moje from palety  where idp>$ost_idp and data<='$data_do' order by idp DESC");
	foreach($wynik11 as $rekord11) {
	$zdane11 = $rekord11['zdane'];
	$pobrane11 = $rekord11['pobrane'];
	$stan11 = $rekord11['stan']; 
	$moje1 = $rekord11['moje'];
	$uwagi11 = $rekord11['uwagi'];} } else {
	
	$wynik11 = $pdo->query("select zdane,pobrane,stan,uwagi,moje from palety  where data>='$data_od' and data<='$data_do' order by idp DESC");
	foreach($wynik11 as $rekord11) {
	$zdane11 = $rekord11['zdane'];
	$pobrane11 = $rekord11['pobrane'];
	$stan11 = $rekord11['stan']; 
	$moje1 = $rekord11['moje'];
	$uwagi11 = $rekord11['uwagi'];} }
	
	
	if (($uwagi11 == 'Moja') or ($uwagi11 == 'Moje') or ('Moich')) $moje11 = $moje11 - $pobrane11 + $zdane11;
	
	$stan_pocz = $stan11 - $pobrane11 + $zdane11;
	
	if ($stan11 == '') { 
	$wynik11 = $pdo->query("select stan from palety order by idp ASC");
	foreach($wynik11 as $rekord11) {
	$stan_pocz = $rekord11['stan']; 
	$stan_koncowy = $rekord11['stan']; } }
	
if ($moje1 == 1) $pn1 = 'moja.';
if (($moje1 >= 2) and ($moje1 <= 4)) $pn1 = 'moje.';
if (($moje1 >= 5) and ($moje1 <= 21)) $pn1 = 'moich.';
if (($moje1 >= 22) and ($moje1 <= 24)) $pn1 = 'moje.';
if ($moje1 >= 25) $pn1 = 'moich.';
	
	if ($moje1 > 0) $moje6 = "w tym ( $moje1 ) $pn1"; else $moje6 = '';
	
	$pal1 = "
	<html>
	<body>
	  <h2>Informacja o wymianie palet</h2><h3>Naczepa $naczepa</h3><h3>od $data_od do $data_do</h3><h3>Początkowy stan palet ( $stan_pocz ) $moje6</h3>
	<table border =1 cellpadding=5 >
	<tr>
		<th width=90>Data</th><th>Miejscowość</th><th>Ilość zdana</th><th>Ilość pobrana</th><th>Stan</th><th>Uwagi</th>
	</tr>";
	
	if ($_POST['id']) {

	$wynik10 = $pdo->query("select idp,data,miejsce,zdane,pobrane,stan,uwagi,moje,podpis from palety  where idp>$ost_idp and data<='$data_do' order by idp  ASC");
	foreach($wynik10 as $rekord10) {
	$data = $rekord10['data'];
	$miejsce = $rekord10['miejsce'];
	$zdane = $rekord10['zdane'];
	$pobrane = $rekord10['pobrane'];
	$stan_koncowy = $rekord10['stan'];
	$uwagi = $rekord10['uwagi'];
	$moje2 = $rekord10['moje'];
	$idp = $rekord10['idp'];
	$podpis = $rekord10['podpis'];
	
	$podpis2 = '<img src="data:image/png;base64,'. $rekord10['podpis'] .'" style="width: 200px; height: 86px;"/>';
	
	$size = strlen($rekord10['podpis']); 

  if ($size > 9360) $uwagi = "$uwagi<br />$podpis2";

	$lane = "<tr><td>$data</td><td>$miejsce</td><td>$zdane</td><td>$pobrane</td><td>$stan_koncowy</td><td>$uwagi</td></tr>";
	
	$wiersz_pal ="$wiersz_pal$lane"; } } else {
	
	$wynik10 = $pdo->query("select idp,data,miejsce,zdane,pobrane,stan,uwagi,moje,podpis from palety  where data>='$data_od' and data<='$data_do' order by idp  ASC");
	foreach($wynik10 as $rekord10) {
	$data = $rekord10['data'];
	$miejsce = $rekord10['miejsce'];
	$zdane = $rekord10['zdane'];
	$pobrane = $rekord10['pobrane'];
	$stan_koncowy = $rekord10['stan'];
	$uwagi = $rekord10['uwagi'];
	$moje2 = $rekord10['moje'];
	$idp = $rekord10['idp'];
	$podpis = $rekord10['podpis'];
	
	$podpis2 = '<img src="data:image/png;base64,'. $rekord10['podpis'] .'" style="width: 200px; height: 86px;"/>';
	
	$size = strlen($rekord10['podpis']); 

  if ($size > 9360) $uwagi = "$uwagi<br />$podpis2";

	$lane = "<tr><td>$data</td><td>$miejsce</td><td>$zdane</td><td>$pobrane</td><td>$stan_koncowy</td><td>$uwagi</td></tr>";
	
	$wiersz_pal ="$wiersz_pal$lane"; } }
	
	
	$wynikk = $pdo->query("select id from kasa order by id  ASC");
  foreach($wynikk as $rekordk) {
  $idk = $rekordk['id']; }
	
	
	
	if ($stan_koncowy == '') $stan_koncowy = 0;
	
if ($moje2 == 1) $pn2 = 'moja.';
if (($moje2 >= 2) and ($moje2 <= 4)) $pn2 = 'moje.';
if (($moje2 >= 5) and ($moje2 <= 21)) $pn2 = 'moich.';
if (($moje2 >= 22) and ($moje2 <= 24)) $pn2 = 'moje.';
if ($moje2 >= 25) $pn2 = 'moich.';
	
	if ($moje2 > 0) $moj4 = "w tym ( $moje2 ) $pn2"; else $moj4 = '';

	$pal2 = "
	</table>
	  <h3>Końcowy stan palet ( $stan_koncowy ) $moj4</h3>
	</body>
	</html>";

	
	
	
	if ($_POST['id']) {	
		
	$wynik10k = $pdo->query("select stan_pl,stan_eu,stan_uk,data from kasa where id=$ost_idk");
	foreach($wynik10k as $rekord10k) {
	$stan_pl = $rekord10k['stan_pl'];
	$stan_eu = $rekord10k['stan_eu'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];} } else {
	
	$wynik10k = $pdo->query("select stan_pl,stan_eu,stan_uk,data from kasa where data>='$data_od' order by id  DESC");
	foreach($wynik10k as $rekord10k) {
	$stan_pl = $rekord10k['stan_pl'];
	$stan_eu = $rekord10k['stan_eu'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];} }
	
	$kasa1 = "
	<html>
	<body>
	  <h2>Informacja o wydatkach i zaliczkach</h2>
	<table border =1 cellpadding=5 >
	<tr>
		<th>Waluta</th><th>PLN</th><th>EUR</th><th>GBP</th><th>Data</th>
	</tr>
	<tr><td>Stan zaliczek początkowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_k</td></tr>";
	
	if ($_POST['id']) {	
	
	$wynik10k = $pdo->query("select pl,stan_pl,eu,stan_eu,uk,stan_uk,data from kasa  where id>$ost_idk and data<='$data_do'  order by id  ASC");
	foreach($wynik10k as $rekord10k) {
	$pl = $rekord10k['pl'];
	$stan_pl = $rekord10k['stan_pl'];
	$eu = $rekord10k['eu'];
	$stan_eu = $rekord10k['stan_eu'];
	$uk = $rekord10k['uk'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];
	
	if (($pl < 0) or ($eu < 0) or ($uk < 0)) {
	
  if ($pl < 0) $lanekw = "<tr><td>Wydatek</td><td>$pl</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu < 0) $lanekw = "<tr><td>Wydatek</td><td>0</td><td>$eu</td><td>0</td><td>$data_k</td></tr>";
	if ($uk < 0) $lanekw = "<tr><td>Wydatek</td><td>0</td><td>0</td><td>$uk</td><td>$data_k</td></tr>";
	
	$wiersz_wyd ="$wiersz_wyd$lanekw"; }
	
	if (($pl > 0) or ($eu > 0) or ($uk > 0)) {
	
	if ($pl > 0) $lanekz = "<tr><td>Zaliczka</td><td>$pl</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu > 0) $lanekz = "<tr><td>Zaliczka</td><td>0</td><td>$eu</td><td>0</td><td>$data_k</td></tr>";
	if ($uk > 0) $lanekz = "<tr><td>Zaliczka</td><td>0</td><td>0</td><td>$uk</td><td>$data_k</td></tr>";
	
	$wiersz_zal ="$wiersz_zal$lanekz"; }
	
	$label0 = "$label0$wiersz_wyd$wiersz_zal"; 
	
	$wiersz_wyd = "";
	$wiersz_zal = ""; } 
	
	$kasa2 = "<tr><td>Stan zaliczek końcowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_k</td></tr>";
	
	$kasa = "$kasa1$label0$kasa2";
	
	} else {
	
	$wynik10k = $pdo->query("select pl,stan_pl,eu,stan_eu,uk,stan_uk,data from kasa  where data>='$data_od' and data<='$data_do' order by id  ASC");
	foreach($wynik10k as $rekord10k) {
	$pl = $rekord10k['pl'];
	$stan_pl = $rekord10k['stan_pl'];
	$eu = $rekord10k['eu'];
	$stan_eu = $rekord10k['stan_eu'];
	$uk = $rekord10k['uk'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];
	
	if (($pl < 0) or ($eu < 0) or ($uk < 0)) {
	
  if ($pl < 0) $lanekw = "<tr><td>Wydatek</td><td>$pl</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu < 0) $lanekw = "<tr><td>Wydatek</td><td>0</td><td>$eu</td><td>0</td><td>$data_k</td></tr>";
	if ($uk < 0) $lanekw = "<tr><td>Wydatek</td><td>0</td><td>0</td><td>$uk</td><td>$data_k</td></tr>";
	
	$wiersz_wyd ="$wiersz_wyd$lanekw"; }
	
	if (($pl > 0) or ($eu > 0) or ($uk > 0)) {
	
	if ($pl > 0) $lanekz = "<tr><td>Zaliczka</td><td>$pl</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu > 0) $lanekz = "<tr><td>Zaliczka</td><td>0</td><td>$eu</td><td>0</td><td>$data_k</td></tr>";
	if ($uk > 0) $lanekz = "<tr><td>Zaliczka</td><td>0</td><td>0</td><td>$uk</td><td>$data_k</td></tr>";
	
	$wiersz_zal ="$wiersz_zal$lanekz"; }
	
	$label0 = "$label0$wiersz_wyd$wiersz_zal"; 
	
	$wiersz_wyd = "";
	$wiersz_zal = ""; }
	
	$kasa2 = "<tr><td>Stan zaliczek końcowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_k</td></tr>";
	
	$kasa = "$kasa1$label0$kasa2";
	}
	
	
	
	$palety = "$pal1$wiersz_pal$pal2<br /><br />$kasa";
	
	
  if ($_POST['wyslij']) { 
	if ($data_od > $data_do) $info = 'Nieprawidłowe <br />daty'; else {
	
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
 //$mail->addAddress('marek-bartocha@hotmail.com', 'Marek');
	
	$mail->isHTML(true);    

	$mail->Subject = "Informacja o wymianie palet + (wydatki i zaliczki) od $data_od do $data_do ";
	$mail->Body    = "$palety";
	$mail->CharSet = "UTF-8";
	
  $mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true ) ) );

  if(!$mail->send()) { $info2 = 'Nie wysłano info o paletach.'; } else {
  if ($idp == 0) $idp = $ost_idp;
	$info2 = 'Info o paletach wysłane.'; 
	$pdo->exec("update temp set ost='$data_do', ost_idp='$idp', ost_idk='$idk'"); 
	}
	
	$stop=time();
	
	$ile=round($stop-$start, 2);
	$info1 = "Czas $ile sek."; 
	
	$info = "$info1<br />$info2"; } }
	
	if ($zdane_k > 1000) $zdane_k = 'Error';
  if ($pobrane_k > 1000) $pobrane_k = 'Error';
	
	$wynik = $pdo->query("select zp,naczepa,miejsce from temp ");
 foreach($wynik as $rekord) {
 $zp = $rekord['zp']; 
 $naczepa = $rekord['naczepa'];
 $miejsce = $rekord['miejsce']; }
	
	if($zp == 1) $in1 = '>>'; else $in1 = '';
	
	if($zp == 2) $in2 = '>>'; else $in2 = '';
	
$wynik2 = $pdo->query("select stan,moje from palety order by idp  ASC");
foreach($wynik2 as $rekord2) {
$moje3 = $rekord2['moje']; 
$stan = $rekord2['stan']; }
	
if ($moje3 == 1) $pn3 = 'moja.';
if (($moje3 >= 2) and ($moje3 <= 4)) $pn3 = 'moje.';
if (($moje3 >= 5) and ($moje3 <= 21)) $pn3 = 'moich.';
if (($moje3 >= 22) and ($moje3 <= 24)) $pn3 = 'moje.';
if ($moje3 >= 25) $pn3 = 'moich.';

if ($moje3 > 0) $moje5 = "Stan ( $stan ) w tym ( $moje3 ) $pn3"; else $moje5 = " Stan ( $stan )";



?>
<div style="position: absolute; left: 590px; top: 10px"><big><big><h1><?php echo $zdane_k; ?></h1></big></big></div>
<div style="position: absolute; left: 590px; top: 110px"><big><big><h1><?php echo $pobrane_k; ?></h1></big></big></div>
<div style="position: absolute; left: 50px; top: 150px"><big><h3><?php echo $info; ?></h3></big></div>
<div style="position: absolute; left: 20px; top: -25px"><big><big><h2>Palety</h2></big></big></div>
<div style="position: absolute; left: 260px; top: 10px"><big><big><h1>Zdane</h1></big></big></div>
<div style="position: absolute; left: 260px; top: 110px"><big><big><h1>Pobrane</h1></big></big></div>

<div style="position: absolute; left: 530px; top: 20px"><big><big><h2><?php  echo $in1 ?></h2></big></big></div>
<div style="position: absolute; left: 530px; top: 120px"><big><big><h2><?php  echo $in2 ?></h2></big></big></div>

<div style="position: absolute; left: 280px; top: 350px"><big><big><h3><?php  echo $moje5 ?></h3></big></big></div>
<div style="position: absolute; left: 280px; top: 400px"><big><big><h3><?php  echo "Naczepa $naczepa" ?></h3></big></big></div>
<div style="position: absolute; left: 280px; top: 230px"><h3>Miejscowość <?php  echo $miejsce ?></h3></div>
<div style="position: absolute; left: 0px; top: 550px">
<?php


	if ($_POST['pokaz']) { 
	if ($data_od > $data_do) $info = 'Nieprawidłowe <br />daty'; else {
	
	$wynik2 = $pdo->query("select zdane,pobrane,naczepa,ost_idp from temp");
foreach($wynik2 as $rekord2) {
$zdane_k = $rekord2['zdane'];
$pobrane_k = $rekord2['pobrane'];
$naczepa = $rekord2['naczepa'];
$ost_idp = $rekord2['ost_idp']; }


	$data_od = trim($_POST['od']); 
	
	$data_do = trim($_POST['do']);
	
	if ($_POST['id']) {
	
	$wynik11 = $pdo->query("select zdane,pobrane,stan,uwagi,moje from palety  where idp>$ost_idp and data<='$data_do' order by idp DESC");
	foreach($wynik11 as $rekord11) {
	$zdane11 = $rekord11['zdane'];
	$pobrane11 = $rekord11['pobrane'];
	$stan11 = $rekord11['stan']; 
	$moje1 = $rekord11['moje'];
	$uwagi11 = $rekord11['uwagi'];} } else {
	
	
	$wynik11 = $pdo->query("select zdane,pobrane,stan,uwagi,moje from palety  where data>='$data_od' and data<='$data_do' order by idp DESC");
	foreach($wynik11 as $rekord11) {
	$zdane11 = $rekord11['zdane'];
	$pobrane11 = $rekord11['pobrane'];
	$stan11 = $rekord11['stan']; 
	$moje1 = $rekord11['moje'];
	$uwagi11 = $rekord11['uwagi'];} }
	
	if (($uwagi11 == 'Moja') or ($uwagi11 == 'Moje') or ('Moich')) $moje11 = $moje11 - $pobrane11 + $zdane11;
	
	$stan_pocz = $stan11 - $pobrane11 + $zdane11; 
	
	if ($stan11 == '') { 
	$wynik11 = $pdo->query("select stan from palety order by idp ASC");
	foreach($wynik11 as $rekord11) {
	$stan_pocz = $rekord11['stan']; 
	$stan_koncowy = $rekord11['stan']; } }
	
	if ($stan11 == '') { 
	$wynik11 = $pdo->query("select stan from palety order by idp ASC");
	foreach($wynik11 as $rekord11) {
	$stan_pocz = $rekord11['stan']; 
	$stan_koncowy = $rekord11['stan']; } }
	
if ($moje1 == 1) $pn1 = 'moja.';
if (($moje1 >= 2) and ($moje1 <= 4)) $pn1 = 'moje.';
if (($moje1 >= 5) and ($moje1 <= 21)) $pn1 = 'moich.';
if (($moje1 >= 22) and ($moje1 <= 24)) $pn1 = 'moje.';
if ($moje1 >= 25) $pn1 = 'moich.';
	
	if ($moje1 > 0) $moje6 = "w tym ( $moje1 ) $pn1"; else $moje6 = '';
	
	echo "
	<html>
	<body>
	  <h2>Informacja o wymianie palet</h2><h3>Naczepa $naczepa</h3><h3>od $data_od do $data_do</h3><h3>Początkowy stan palet ( $stan_pocz ) $moje6</h3>
	<table border =1 cellpadding=5 >
	<tr>
		<th width=90>Data</th><th>Miejscowość</th><th>Ilość zdana</th><th>Ilość pobrana</th><th>Stan</th><th>Uwagi</th><th>Podpis</th>
	</tr>";
	
	if ($_POST['id']) {

	$wynik10 = $pdo->query("select idp,data,miejsce,zdane,pobrane,stan,uwagi,moje,podpis from palety  where idp>$ost_idp and data<='$data_do' order by idp  ASC");
	foreach($wynik10 as $rekord10) {
	$data = $rekord10['data'];
	$miejsce = $rekord10['miejsce'];
	$zdane = $rekord10['zdane'];
	$pobrane = $rekord10['pobrane'];
	$stan_koncowy = $rekord10['stan'];
	$uwagi = $rekord10['uwagi'];
	$moje2 = $rekord10['moje'];
	$idp = $rekord10['idp'];
	$podpis = $rekord10['podpis'];
	
	$podpis2 = '<img src="data:image/png;base64,'. $rekord10['podpis'] .'" style="width: 200px; height: 86px;"/>';

  $size = strlen($rekord10['podpis']);

  if ($size > 9360) $uwagi = "$uwagi<br />$podpis2";

  echo "<tr>";
	echo "<td>$data</td><td>$miejsce</td><td>$zdane</td><td>$pobrane</td><td>$stan_koncowy</td><td>$uwagi</td>";
	?><td><a href="\cigla/podpis.php?akcja=zidp&idp=<?php echo $rekord10['idp']; ?>">Podpisz</a></td><?php
	echo "</tr>";
	
  } } else {
	
  $wynik10 = $pdo->query("select idp,data,miejsce,zdane,pobrane,stan,uwagi,moje,podpis from palety  where data>='$data_od' and data<='$data_do' order by idp  ASC");
	foreach($wynik10 as $rekord10) {
	$data = $rekord10['data'];
	$miejsce = $rekord10['miejsce'];
	$zdane = $rekord10['zdane'];
	$pobrane = $rekord10['pobrane'];
	$stan_koncowy = $rekord10['stan'];
	$uwagi = $rekord10['uwagi'];
	$moje2 = $rekord10['moje'];
	$idp = $rekord10['idp'];
	$podpis = $rekord10['podpis'];
	
	$podpis2 = '<img src="data:image/png;base64,'. $rekord10['podpis'] .'" style="width: 200px; height: 86px;"/>';

  $size = strlen($rekord10['podpis']);

  if ($size > 9360) $uwagi = "$uwagi<br />$podpis2";

  echo "<tr>";
	echo "<td>$data</td><td>$miejsce</td><td>$zdane</td><td>$pobrane</td><td>$stan_koncowy</td><td>$uwagi</td>";
	?><td><a href="\cigla/podpis.php?akcja=zidp&idp=<?php echo $rekord10['idp']; ?>">Podpisz</a></td><?php
	echo "</tr>";
	
} }
	
	if ($stan_koncowy == '') $stan_koncowy = 0;
	
if ($moje2 == 1) $pn2 = 'moja.';
if (($moje2 >= 2) and ($moje2 <= 4)) $pn2 = 'moje.';
if (($moje2 >= 5) and ($moje2 <= 21)) $pn2 = 'moich.';
if (($moje2 >= 22) and ($moje2 <= 24)) $pn2 = 'moje.';
if ($moje2 >= 25) $pn2 = 'moich.';
	
	if ($moje2 > 0) $moj4 = "w tym ( $moje2 ) $pn2"; else $moj4 = '';

	echo "
	</table>
	  <h3>Końcowy stan palet ( $stan_koncowy ) $moj4</h3>";
		
		
	if ($_POST['id']) {	
		
	$wynik10k = $pdo->query("select stan_pl,stan_eu,stan_uk,data from kasa where id=$ost_idk");
	foreach($wynik10k as $rekord10k) {
	$stan_pl = $rekord10k['stan_pl'];
	$stan_eu = $rekord10k['stan_eu'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];} } else {
	
	$wynik10k = $pdo->query("select stan_pl,stan_eu,stan_uk,data from kasa where data>='$data_od' order by id  DESC");
	foreach($wynik10k as $rekord10k) {
	$stan_pl = $rekord10k['stan_pl'];
	$stan_eu = $rekord10k['stan_eu'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];} }
	
	$kasa1 = "
	<html>
	<body>
	  <h2>Informacja o wydatkach i zaliczkach</h2>
	<table border =1 cellpadding=5 >
	<tr>
		<th>Waluta</th><th>PLN</th><th>EUR</th><th>GBP</th><th>Data</th>
	</tr>
	<tr><td>Stan zaliczek początkowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_od</td></tr>";
	
	
	if ($_POST['id']) {
	
	$wynik10k = $pdo->query("select pl,stan_pl,eu,stan_eu,uk,stan_uk,data from kasa  where id>$ost_idk and data<='$data_do' order by id  ASC");
	foreach($wynik10k as $rekord10k) {
	$pl2 = $rekord10k['pl'];
	$stan_pl = $rekord10k['stan_pl'];
	$eu2 = $rekord10k['eu'];
	$stan_eu = $rekord10k['stan_eu'];
	$uk2 = $rekord10k['uk'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];
	
	if (($pl2 < 0) or ($eu2 < 0) or ($uk2 < 0)) {
	
  if ($pl2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>$pl2</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>0</td><td>$eu2</td><td>0</td><td>$data_k</td></tr>";
	if ($uk2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>0</td><td>0</td><td>$uk2</td><td>$data_k</td></tr>";
	
	$wiersz_wyd2 ="$wiersz_wyd2$lanekw2"; }
	
	if (($pl2 > 0) or ($eu2 > 0) or ($uk2 > 0)) {
	
	if ($pl2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>$pl2</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>0</td><td>$eu2</td><td>0</td><td>$data_k</td></tr>";
	if ($uk2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>0</td><td>0</td><td>$uk2</td><td>$data_k</td></tr>";
	
	$wiersz_zal2 ="$wiersz_zal2$lanekz2"; }
	
	$label = "$label$wiersz_wyd2$wiersz_zal2"; 
	
	$wiersz_wyd2 = "";
	$wiersz_zal2 = ""; }
	
	$kasa2 = "<tr><td>Stan zaliczek końcowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_do</td></tr>";
	
	echo "$kasa1$label$kasa2";
	
	} else {
	
	$wynik10k = $pdo->query("select pl,stan_pl,eu,stan_eu,uk,stan_uk,data from kasa where data>='$data_od' and data<='$data_do' order by id  ASC");
	foreach($wynik10k as $rekord10k) {
	$pl2 = $rekord10k['pl'];
	$stan_pl = $rekord10k['stan_pl'];
	$eu2 = $rekord10k['eu'];
	$stan_eu = $rekord10k['stan_eu'];
	$uk2 = $rekord10k['uk'];
	$stan_uk = $rekord10k['stan_uk'];
	$data_k = $rekord10k['data'];
	
	if (($pl2 < 0) or ($eu2 < 0) or ($uk2 < 0)) {
	
  if ($pl2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>$pl2</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>0</td><td>$eu2</td><td>0</td><td>$data_k</td></tr>";
	if ($uk2 < 0) $lanekw2 = "<tr><td>Wydatek</td><td>0</td><td>0</td><td>$uk2</td><td>$data_k</td></tr>";
	
	$wiersz_wyd2 ="$wiersz_wyd2$lanekw2"; }
	
	if (($pl2 > 0) or ($eu2 > 0) or ($uk2 > 0)) {
	
	if ($pl2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>$pl2</td><td>0</td><td>0</td><td>$data_k</td></tr>"; 
	if ($eu2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>0</td><td>$eu2</td><td>0</td><td>$data_k</td></tr>";
	if ($uk2 > 0) $lanekz2 = "<tr><td>Zaliczka</td><td>0</td><td>0</td><td>$uk2</td><td>$data_k</td></tr>";
	
	$wiersz_zal2 ="$wiersz_zal2$lanekz2"; }
	
	$label = "$label$wiersz_wyd2$wiersz_zal2"; 
	
	$wiersz_wyd2 = "";
	$wiersz_zal2 = ""; }	
	
	$kasa2 = "<tr><td>Stan zaliczek końcowy</td><td>$stan_pl</td><td>$stan_eu</td><td>$stan_uk</td><td>$data_do</td></tr>";
	
	echo "$kasa1$label$kasa2"; }
	

	

?><div style="position: absolute; left: 680px; top: -230px"><h1><big><big><big><big><big><big><?php echo '&#8595'; echo '&#8595'; echo '&#8595'; ?></big></big></big></big></big></big></h1></div><?php 
} } 

?></div>


<div style="position: absolute; left: 50px; top: 150px"><big><h3><?php echo $info; ?></h3></big></div>
</body>

</html>