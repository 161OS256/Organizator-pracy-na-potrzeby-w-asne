<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">

  <title> Terminy </title>
	
	<link rel="stylesheet" href=" [nazwa_arkusza_stylow.css] " type="text/css">
	<style type="text/css">

input {border:1px solid black; margin-bottom:3px; }
input.krotki {width:80px; text-align:center;}
 
div.clndr
{ 
 background-color:#d0d0d0;  position:absolute; 
 cursor:default; display:none; border:3px ridge #9ab; left: 400px; top: 40px 
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

<?php include('conect.php'); ?>

<div style="position: absolute; left: 850px; top: 330px"><a href=\cigla/index.php><button><h1>>Powrót<<br />pulpit</h1></button></a></div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<div style="position: absolute; left: 895px; top: 230px"><button input type="submit" name="dodaj" value="dodaj"><h1>Dodaj</h1></button></div>

</form><br />
	<?php
		$za_rok = strftime('%Y-%m-%d', strtotime("$data +1 year")); 
 
 if ($_GET['akcja']=='zid') {
  $zid = $_GET['id'];
	$pdo->exec("update temp set id_zmien='$zid'");
  ?><div style="position: absolute; left: 0px;">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Data do <input class="krotki" readonly name="data" value="<?php echo $za_rok ?>" onfocus="Calendar('DatePicker1',this)">
  <button input type="submit" name="zmien" value="zmien">Zapisz</button>
	<button input type="submit" name="anul" value="anul">Anulój</button>
	<div id="DatePicker1" class="clndr"></div>
  </form> <?php }
	
	if ($_GET['akcja']=='usu') {
	$zid = $_GET['id'];
	$pdo->exec("update temp set id_zmien='$zid'");
	?><div style="position: absolute; left: 0px;">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <button input type="submit" name="usun" value="usun"><h2>>>Usuń<<</h2></button>
	<button input type="submit" name="anul" value="anul"><h2>>>Anulój<<</h2></button>
  </form> <?php }
	
	if ($_POST['usun']) {
	$wynik3 = $pdo->query("select id_zmien from temp");
	foreach($wynik3 as $rekord3) {
	$id_usun = $rekord3['id_zmien']; }
	
	$pdo->exec("DELETE FROM `terminy` WHERE `terminy`.`id` = $id_usun"); }

	
	
 if ($_POST['zmien']) {
  $wynik3 = $pdo->query("select id_zmien from temp");
	foreach($wynik3 as $rekord3) {
	$id_zmien = $rekord3['id_zmien']; } 
 
	$data = trim($_POST['data']);
	if ($data == '') echo 'Wypełnij pola'; else
  $pdo->exec("update terminy set data='$data' where id='$id_zmien'"); }
	
 
	$wynik = $pdo->query("select data_start from temp");
	foreach($wynik as $rekord) {
	$data = $rekord['data_start']; }
	
	if ($_POST['term']) {
	$nazwa = trim($_POST['nazwa']);
	$data = trim($_POST['data']);
	if (($nazwa == '') or ($data == '')) echo 'Wypełnij pola'; else
  $pdo->exec("INSERT INTO terminy set nazwa='$nazwa', data='$data'"); }

	
	if ($_POST['dodaj']) { ?><div style="position: absolute; left: 0px;">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	Nazwa <input size="15" name="nazwa" /> Data do <input class="krotki" readonly name="data" value="<?php echo $za_rok ?>" onfocus="Calendar('DatePicker1',this)">
  <button input type="submit" name="term" value="term">Zapisz</button>
	<div id="DatePicker1" class="clndr"></div>
  </form> <?php }
	
	echo "
	<html>
	<body>
	  <h2>Terminy</h2>
	<table border =1 cellpadding=5 >
	<tr>
		<th width=300>Nazwa</th><th width=120>Data</th><th width=80>Zmień</th><th width=80>Usuń</th>
	</tr>";

	$wynik2 = $pdo->query("select id, nazwa, data from terminy order by data ASC");
	foreach($wynik2 as $rekord2) {
	$id = $rekord2['id'];
	$nazwa = $rekord2['nazwa']; 
	$data2 = $rekord2['data']; 
 
	
	echo "<tr>";
	echo "<td>$nazwa</td><td>$data2</td>";
	?><td><a href="?akcja=zid&id=<?php echo $rekord2['id']; ?>">Zmień</a></td>
	<td><a href="?akcja=usu&id=<?php echo $rekord2['id']; ?>">Usuń</a></td><?php
	echo "</tr>"; }

	echo "</table>";
?>
</body>
</html>