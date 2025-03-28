<?php
 
 $wynik4 = $pdo->query("select data_start,godz_start,data_stop,godz_stop, do_oddania from oddawanie where id='1'");
 foreach($wynik4 as $rekord4) {  
 $oddaj_data_start = $rekord4['data_start'];
 $oddaj_godz_start = $rekord4['godz_start']; 
 $oddaj_data_stop = $rekord4['data_stop'];
 $oddaj_godz_stop = $rekord4['godz_stop'];
 $do_oddania = $rekord4['do_oddania']; }

 if (($oddaj_data_start == NULL) or ($oddaj_godz_start == NULL) or ($oddaj_data_stop == NULL) or ($oddaj_godz_stop == NULL)) {
 $wekend_do_oddania = ' '; } else { 
 $g = 0; $do_oddania0 = $do_oddania;
 if ($do_oddania > 0) { while($do_oddania0 > 59) { $do_oddania0 = $do_oddania0 - 60; $g = ++$g; } 
 if ($do_oddania0 < 10) $do_oddania0 = "0$do_oddania0";
 $oddac_do = strftime('%Y-%m-%d / %H:%M', strtotime("$oddaj_data_stop $oddaj_godz_stop +21 day -$do_oddania min"));
 $wekend_do_oddania = "Do oddania $g:$do_oddania0 do $oddac_do   Wekend z dnia $oddaj_data_start"; } }
 
 
 
 
 $wynik5 = $pdo->query("select data_start,godz_start,data_stop,godz_stop, do_oddania from oddawanie where id='2'");
 foreach($wynik5 as $rekord5) {  
 $oddaj_data_start1 = $rekord5['data_start'];
 $oddaj_godz_start1 = $rekord5['godz_start']; 
 $oddaj_data_stop1 = $rekord5['data_stop'];
 $oddaj_godz_stop1 = $rekord5['godz_stop'];
 $do_oddania1 = $rekord5['do_oddania']; }

 if (($oddaj_data_start1 == NULL) or ($oddaj_godz_start1 == NULL) or ($oddaj_data_stop1 == NULL) or ($oddaj_godz_stop1 == NULL)) {
 $wekend_do_oddania1 = ' '; } else {
 $g1 = 0; $do_oddania1a = $do_oddania1;
 if ($do_oddania1 > 0) { while($do_oddania1a > 59) { $do_oddania1a = $do_oddania1a - 60; $g1 = ++$g1; } 
 if ($do_oddania1a < 10) $do_oddania1a = "0$do_oddania1a";
 $oddac_do1 = strftime('%Y-%m-%d / %H:%M', strtotime("$oddaj_data_stop1 $oddaj_godz_stop1 +21 day -$do_oddania1 min"));
 $wekend_do_oddania1 = "Do oddania $g1:$do_oddania1a do $oddac_do1   Wekend z dnia $oddaj_data_start1"; } }
 
 
 

 $wynik6 = $pdo->query("select data_start,godz_start,data_stop,godz_stop, do_oddania from oddawanie where id='3'");
 foreach($wynik6 as $rekord6) {  
 $oddaj_data_start2 = $rekord6['data_start'];
 $oddaj_godz_start2 = $rekord6['godz_start']; 
 $oddaj_data_stop2 = $rekord6['data_stop'];
 $oddaj_godz_stop2 = $rekord6['godz_stop'];
 $do_oddania2 = $rekord6['do_oddania']; }

 if (($oddaj_data_start2 == NULL) or ($oddaj_godz_start2 == NULL) or ($oddaj_data_stop2 == NULL) or ($oddaj_godz_stop2 == NULL)) {
 $wekend_do_oddania2 = ' '; } else {
 $g2 = 0; $do_oddania2a = $do_oddania2;
 if ($do_oddania2 > 0) { while($do_oddania2a > 59) { $do_oddania2a = $do_oddania2a - 60; $g2 = ++$g2; } 
 if ($do_oddania2a < 10) $do_oddania2a = "0$do_oddania2a";
 $oddac_do2 = strftime('%Y-%m-%d / %H:%M', strtotime("$oddaj_data_stop2 $oddaj_godz_stop2 +21 day -$do_oddania2 min"));
 $wekend_do_oddania2 = "Do oddania $g2:$do_oddania2a do $oddac_do2   Wekend z dnia $oddaj_data_start2"; } }

?>