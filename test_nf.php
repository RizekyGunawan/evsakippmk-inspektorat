<?php
// Test number_format
$val = null;
echo "Null: [" . number_format($val, 2) . "]\n";
$val2 = "30";
echo "String 30: [" . number_format($val2, 2) . "]\n";
$val3 = "";
echo "Empty String: [" . number_format($val3, 2) . "]\n";
?>
