<?php
$f = 'c:\laragon\www\evsakippmk-inspektorat\application\models\m_pm.php';
$c = file_get_contents($f);
$count = substr_count($c, 'inner join ta_dokumen');
echo "Found: " . $count . "\n";
$c = str_replace('inner join ta_dokumen', 'left join ta_dokumen', $c);
file_put_contents($f, $c);
echo "Replaced inner join with left join.";
