<?php
  function CalcMin($currTime2, $origTime2) {
	$showDiff2 = '';
	$currTime2 = intval($currTime2);
	$origTime2 = intval($origTime2);
	if ($currTime2<$origTime2) { $diff2 = $origTime2-$currTime2; }
	else { $diff2 = $currTime2-$origTime2; }

	$mins2 = floor($diff2/60); 
	if ($mins2 > 0) {
	$diff2 = $diff2 - ($mins2*60);
	$showDiff2 .= empty($showDiff2) ? '' : '';
	$showDiff2 .= "{$mins2}"; }
	unset($mins2); 
	
	unset($diff2); 
	if ($currTime2<$origTime2) { $showDiff2 = "- {$showDiff2}"; }
	return $showDiff2; }
?>