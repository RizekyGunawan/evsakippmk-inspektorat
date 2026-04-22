<?php
$db = new mysqli('192.168.10.7', 'evsakippmk', 'Kemenkopmk03', 'evsakippmk');
$res = $db->query('SELECT id, id_unit, target_user_id, evaluator_id, isi_komentar, indikator_id, subkomponen_id FROM komentar_evaluasi ORDER BY id DESC LIMIT 5');
while($row = $res->fetch_assoc()) {
    print_r($row);
}
