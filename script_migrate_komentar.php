<?php
$mysqli = new mysqli("192.168.10.7", "evsakippmk", "Kemenkopmk03", "evsakippmk");
if ($mysqli->connect_error) die("DB Error");

// 1. ADD COLUMNS
$mysqli->query("ALTER TABLE komentar_evaluasi ADD COLUMN id_unit INT NULL");
$mysqli->query("ALTER TABLE komentar_evaluasi ADD COLUMN tahun VARCHAR(10) NULL");

// 2. BACKFILL DATA
$res = $mysqli->query("SELECT * FROM komentar_evaluasi");
while($row = $res->fetch_assoc()) {
    $id = $row['id'];
    $id_unit = null;
    $tahun = '2024'; // Default guess, but let's try to refine it

    if ($row['pengirim_role'] == 'evaluator') {
        // Find target user's unit
        if ($row['target_user_id']) {
            $user_res = $mysqli->query("SELECT id_unit FROM ta_user WHERE id_user = " . intval($row['target_user_id']));
            if ($user_row = $user_res->fetch_assoc()) {
                $id_unit = $user_row['id_unit'];
            }
        }
    } else {
        // Sender is UK user, their evaluator_id is their own id_user ? Let's check
        $user_res = $mysqli->query("SELECT id_unit FROM ta_user WHERE id_user = " . intval($row['evaluator_id']));
        if ($user_row = $user_res->fetch_assoc()) {
            if ($user_row['id_unit'] && $user_row['id_unit'] < 10) { // Usually unit kerjas have ID 1-7
                $id_unit = $user_row['id_unit'];
            }
        }
    }
    
    // Attempt to infer 'tahun' and fine-tune 'id_unit' if possible from ta_ev !
    if ($id_unit && $row['indikator_id']) {
        $ev_res = $mysqli->query("SELECT tahun FROM ta_ev WHERE id_aspek = ".intval($row['indikator_id'])." AND id_unit = ".intval($id_unit)." LIMIT 1");
        if ($ev_row = $ev_res->fetch_assoc()) {
            $tahun = $ev_row['tahun'];
        }
    } elseif ($id_unit && $row['subkomponen_id']) {
        $ev0_res = $mysqli->query("SELECT tahun FROM ta_ev0 WHERE id_subkomponen = ".intval($row['subkomponen_id'])." AND id_unit = ".intval($id_unit)." LIMIT 1");
        if ($ev0_row = $ev0_res->fetch_assoc()) {
            $tahun = $ev0_row['tahun'];
        }
    }

    if ($id_unit) {
        $mysqli->query("UPDATE komentar_evaluasi SET id_unit = " . intval($id_unit) . ", tahun = '" . $mysqli->real_escape_string($tahun) . "' WHERE id = " . intval($id));
    }
}
echo "Migration Done.";
