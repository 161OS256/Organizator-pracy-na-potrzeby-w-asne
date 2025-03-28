
<?php
  try
   { $pdo = new PDO('mysql:host=localhost;dbname=dbname;encoding=utf-8', 'user', 'pas'); }
   catch(PDOException $e)
   { echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage(); }
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
function dateV($format,$timestamp=null){
	$to_convert = array(
		'l'=>array('dat'=>'N','str'=>array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela')),
		'F'=>array('dat'=>'n','str'=>array('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień')), );
		
	if ($pieces = preg_split('#[:/.\-, ]#', $format)){	
		if ($timestamp === null) { $timestamp = time(); }
		foreach ($pieces as $datepart){
			if (array_key_exists($datepart,$to_convert)){
				$replace[] = $to_convert[$datepart]['str'][(date($to_convert[$datepart]['dat'],$timestamp)-1)];
			}else{
				$replace[] = date($datepart,$timestamp);
			}
		}
		$result = strtr($format,array_combine($pieces,$replace));
		return $result;
	}
}
 	$kolor1 = $pdo->query("select kolor from temp");
  foreach($kolor1 as $rekord_kolor1) {
  $farba = $rekord_kolor1['kolor']; }
?>
<style type="text/css">
body {background-color:<?php echo $farba ?>; }
</style>
 
<div style="position: absolute; left: 855px; top: 5px">Marek Bartocha</div>
