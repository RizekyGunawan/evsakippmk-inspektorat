<?php
$mysqli = new mysqli("192.168.10.7", "evsakippmk", "Kemenkopmk03", "evsakippmk");
if ($mysqli->connect_error) die("DB Error");
$result = $mysqli->query("DESCRIBE ta_user");
while($row = $result->fetch_assoc()) {
    print_r($row);
}
