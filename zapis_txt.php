<?php

  $pl = 0;
	$eu = 0;
	$uk = 0;
	$wuk = 0;
	$wekend = 0;
	$przestoj = 0;
	$war = 0;
	
	$wynik4 = $pdo->query("select data_stop,eu,pl,uk,wekend,przestoj from dane where mies='$mies2' order by id  asc");
	foreach($wynik4 as $rekord4) {
	$data_stop2 = $rekord4['data_stop']; }
	
	$mies_test2 = dateV('F', strtotime("$data_stop2"));
	
	if (($data_stop2 <> NULL) and ($mies_test2 == $mies)) {
	if ($rekord4['pl'] == 1) { $pl = $pl + 1; $kr_wstecz = 1; }
	if ($rekord4['eu'] == 1) { $eu = $eu + 1; $kr_wstecz = 2; }
	if ($rekord4['uk'] == 1) { $uk = $uk + 1; $kr_wstecz = 3; } 
	$wekend = $wekend + $rekord4['wekend']; 
	$przestoj = $przestoj + $rekord4['przestoj']; }
	
	$dubel = $data_stop2;    

	$wynik3 = $pdo->query("select id,data_start,data_stop,eu,pl,uk,wekend,przestoj from dane where mies='$mies' order by id  asc");
	foreach($wynik3 as $rekord3) {
	$data_start = $rekord3['data_start'];
	$data_stop = $rekord3['data_stop'];
	$rok = strftime('%Y', strtotime("$data_start"));
	
	if ($rok == $rok_dzis) {	

	@$wekend = $wekend + $rekord3['wekend']; 
	$przestoj = $przestoj + $rekord3['przestoj'];
	
	$kr_a = '';
	$kr_b = '';
	
	$mies_test = dateV('F', strtotime("$data_stop"));
	
	if ((($rekord3['wekend'] > 0 ) or ($rekord3['przestoj'] > 0)) and ($rekord3['uk'] == 1)) {
	@$wuk = $wuk + $rekord3['wekend'] + $rekord3['przestoj'];
	if (($data_stop <> NULL) and ($mies_test == $mies)) $wuk = $wuk + 1; }
	

	if (($data_stop <> NULL) and ($mies_test == $mies)) { 
	
	if (($rekord3['eu'] == 2) or ($rekord3['pl'] == 2) or ($rekord3['uk'] == 2)) { 
	
	if ($rekord3['pl'] == 2) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 2) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 2) { $uk = $uk + 1; $kr_a = 3; }
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 1; $kr_b = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 1; $kr_b = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 1; $kr_b = 3; } } else { 
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 2; $kr_b = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 2; $kr_b = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 2; $kr_b = 2; $war = $war + 1; } } } else { 
	
	if (($rekord3['eu'] == 2) or ($rekord3['pl'] == 2) or ($rekord3['uk'] == 2)) {
	
	if ($rekord3['pl'] == 2) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 2) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 2) { $uk = $uk + 1; $kr_a = 3; } } else { 	
	
	if ($rekord3['pl'] == 1) { $pl = $pl + 1; $kr_a = 1; }
	if ($rekord3['eu'] == 1) { $eu = $eu + 1; $kr_a = 2; }
	if ($rekord3['uk'] == 1) { $uk = $uk + 1; $kr_a = 3; } } }
	
	if (($data_stop <> NULL) and ($mies_test <> $mies)) {
	$wekend = $wekend - $rekord3['wekend']; 
	$przestoj = $przestoj - $rekord3['przestoj']; }

	if ($data_start == $dubel) {
	
	if ($kr_a == '') $kr_a = $kr_b; 
	
  if ($kr_wstecz < $kr_a) $us = $kr_wstecz; else $us = $kr_a; 
	
	if ($us == 1) $pl = $pl - 1;
	if ($us == 2) $eu = $eu - 1;
	if ($us == 3) $uk = $uk - 1; } 

	if ($kr_b == '') $kr_b = $kr_a;   

	$kr_wstecz = $kr_b; 
	
	$kr_a = '';
	$kr_b = '';
	
	if ($data_stop <> NULL) $dubel = $data_stop; else $dubel = $data_start; } }
	
	
	$eu = $eu + $uk;
	
	$uk = $uk + $wuk - $war;
	
	$eu_sum = $eu * 0;

	$pl_sum = $pl * 0;

	$uk_sum = $uk * 0;

	$wekend_sum = $wekend * 0;
	
	$przestoj_sum = $przestoj * 0;

	$suma = $eu + $pl + $wekend + $przestoj;

	$suma_euro = $eu_sum + $pl_sum + $uk_sum + $wekend_sum + $przestoj_sum;

 $podsuma = "
<html>
<body>
  <h2>Rozliczenie diet</h2>
  <table>
    <tr>
      <th>Dieta</th><td></td><th>Dni</th><td></td><th>Euro</th>
    </tr>
    <tr>
      <td>PL</td><td>-</td><td>$pl</td><td>=</td><td>$pl_sum</td>
    </tr>
    <tr>
      <td>EU</td><td>-</td><td>$eu</td><td>=</td><td>$eu_sum</td>
    </tr>
		<tr>
      <td>Wekend</td><td>-</td><td>$wekend</td><td>=</td><td>$wekend_sum</td>
    </tr>
		<tr>
      <td>Przestój</td><td>-</td><td>$przestoj</td><td>=</td><td>$przestoj_sum</td>
    </tr>	
		<tr>
      <td>-----------</td><td>---</td><td>-----</td><td>---</td><td>-----</td>
    </tr>	
			<tr>
      <td>UK Noc</td><td>-</td><td>$uk</td><td>=</td><td>$uk_sum</td>
    </tr>
			<tr>
      <td>-----------</td><td>---</td><td>-----</td><td>---</td><td>-----</td>
    </tr>
		<tr>
      <td>Suma</td><td>-  </td><td>$suma</td><td>=</td><td>$suma_euro</td>
    </tr>
  </table>
</body>
</html>";  

$wynik2 = $pdo->query("select stan_pl,stan_eu,stan_uk from kasa ");
foreach($wynik2 as $rekord2) {
$zal_zl = $rekord2['stan_pl']; 
$zal_euro = $rekord2['stan_eu'];
$zal_gbp = $rekord2['stan_uk']; }

$zal = "
<html>
<body>
  <h2>Stan Zaliczki</h2>
  <table>
    <tr>
      <th>Stan </th><th> Waluta</th>
    </tr>	
    <tr>
      <td>$zal_zl </td><td> ZŁ</td>
    </tr>
    <tr>
      <td>$zal_euro </td><td> EURO</td>
    </tr>
		<tr>
      <td>$zal_gbp </td><td> GBP</td>
    </tr>
  </table>
</body>
<h2>Raport</h2>
</html>";
 
$wynik5 = $pdo->query("select data_start,start,data_stop,stop,dzien,p9a,p9b,jazda_10h,notatka,eu,pl,uk,wekend,wekend_dom,przestoj,przestoj_dom,pauza_3h from dane where mies='$mies' order by id  ASC");

 foreach($wynik5 as $rekord5) {
 $p9a = $rekord5['p9a'];
 $p9b = $rekord5['p9b'];
 $jazda_10h = $rekord5['jazda_10h'];
 $eu = $rekord5['eu'];
 $pl = $rekord5['pl'];
 $uk = $rekord5['uk'];
 $wekend = $rekord5['wekend'];
 $wekend_dom = $rekord5['wekend_dom'];
 $przestoj = $rekord5['przestoj'];
 $przestoj_dom = $rekord5['przestoj_dom'];
 $data_stop = $rekord5['data_stop'];
 $ns_dz = $rekord5['data_stop'];
 $spr_rok = $rekord5['data_start'];
 $pauza_3h = $rekord5['pauza_3h'];
 
 $rok2 = strftime('%Y', strtotime("$spr_rok"));
 
 if ($rok2 == $rok_dzis) { 
 
 if($ns_dz) $ns_dz = " $ns_dz"; else $ns_dz = '';
 
 $dniowka1 = ' ';
 $dniowka2 = ' ';
 $dniowka3 = ' ';
 
 if ($data_stop <> NULL) {
 if (($eu == 2) or ($pl == 2) or ($uk == 2)) {
 
 if ($eu == 2) $dniowka1 = 'EU >>>';
 if ($pl == 2) $dniowka1 = 'PL >>>';
 if ($uk == 2) $dniowka1 = 'UK >>>';
 
 if ($eu == 1) $dniowka2 = "EU";
 if ($pl == 1) $dniowka2 = "PL";
 if ($uk == 1) $dniowka2 = "UK"; } else {
 
 if ($eu == 1) $dniowka1 = 'EU';
 if ($pl == 1) $dniowka1 = 'PL';
 if ($uk == 1) $dniowka1 = 'UK'; } } else {
 
 if (($eu == 2) or ($pl == 2) or ($uk == 2)) {
 if ($eu == 2) $dniowka1 = 'EU';
 if ($pl == 2) $dniowka1 = 'PL';
 if ($uk == 2) $dniowka1 = 'UK'; } else {
 
 if ($eu == 1) $dniowka1 = 'EU';
 if ($pl == 1) $dniowka1 = 'PL';
 if ($uk == 1) $dniowka1 = 'UK'; } }
 
 
 if (($wekend == 'x') or ($wekend >= 1)) $dniowka3 = 'Wekend w trasie <br />'; 
 if ($wekend_dom == 1) $dniowka3 = 'Wekend w domu <br />';
 if ($przestoj >= 1) $dniowka3 = 'Przestój <br />';
 if ($przestoj_dom == 1) $dniowka3 = 'Przestój w domu <br />';
 
 if (($p9a == 1) or ($p9b == 1)) { $p9h = '  *** Pauza 9h <br />';
 if ($jazda_10h == 1) {
 $p9h = '  *** Pauza 9h';
 $j10h = ' Jazda 10h <br />'; } else $j10h = ''; } else { $p9h = ''; 
 if ($jazda_10h == 1) $j10h = '  *** Jazda 10h <br />'; else $j10h = ''; }
 
 if (($jazda_10h == 0) and ($pauza_3h == 1)) $p9h = '  *** Pauza 3h+9h <br />';
 if (($jazda_10h == 1) and ($pauza_3h == 1)) { 
 $p9h = '  *** Pauza 3h+9h';
 $j10h = ' Jazda 10h <br />'; }
 
 $x1 = $rekord5['data_start'];
 $x2 = $rekord5['start'];
 $x3 = $rekord5['stop'];
 $x4 = $rekord5['dzien'];
 $x5 = $rekord5['notatka'];
 
 $x5 = str_replace( "***", '<br />***', $x5 );
 $x5 = str_replace( "Zdane", '<br />Zdane', $x5 );
 $x5 = str_replace( "Wydatek", 'Wydatek<br />', $x5 );
 $x5 = str_replace( "Zaliczka", 'Zaliczka<br />', $x5 );
 
 if($ns_dz == NULL) $x6 = ''; else {
 $ns_dz = strftime('%d', strtotime("$ns_dz"));
 $x6 = "/$ns_dz"; }
 
 $stare = "
 <html>
 <body>
  $x1$x6 $x4<br />
	Start $x2 / Stop $x3 $dniowka1$dniowka2
	$x5
	<br />$p9h$j10h
	$dniowka3<br /><br />
 </body>
 </html>"; 
 
$dane1 = "$dane1$stare"; } }

$dane = "$podsuma$zal$dane1";

?>