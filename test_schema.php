<?php
$mysqli = new mysqli("192.168.10.7", "evsakippmk", "Kemenkopmk03", "evsakippmk");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$result = $mysqli->query("DESCRIBE komentar_evaluasi");
if ($result) {
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "Error: " . $mysqli->error;
}
