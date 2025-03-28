<?php 
include('conect.php');

$wynik = $pdo->query("select idp from temp");
foreach($wynik as $rekord) {
$idp = $rekord['idp']; }

if (isset($_POST["filecode"])) {
  $imageData = $_POST["filecode"];
  $filteredData = substr($imageData, strpos($imageData, ",") + 1);
	
  $fp = fopen("file_png.png", "wb");
  fwrite($fp, $filteredData);
  fclose($fp);

	$filesrc = 'file_png.png';
	$filesize = filesize($filesrc);
	
	$plik = fopen($filesrc, "r");
	$mysqlplik = addslashes(fread($plik,$filesize));
	
	fclose($plik);
	unlink($filesrc); 
	
	$pdo->exec("update palety set podpis='$mysqlplik' where idp='$idp'"); 
} 
?>
