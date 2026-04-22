<?php
$db = new mysqli('192.168.10.7', 'evsakippmk', 'Kemenkopmk03', 'evsakippmk');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

echo "Starting patch...\n";

// Get all comments where id_unit IS NULL or id_unit = 0 or id_unit = ''
$res = $db->query("SELECT id, evaluator_id, target_user_id, pengirim_role FROM komentar_evaluasi WHERE id_unit IS NULL OR id_unit = 0 OR id_unit = ''");
$count = 0;

while($row = $res->fetch_assoc()) {
    $id = $row['id'];
    $pengirim_role = $row['pengirim_role'];
    $evaluator_id = intval($row['evaluator_id']);
    $target_user_id = intval($row['target_user_id']);
    
    $id_unit = null;
    
    if ($pengirim_role === 'evaluator') {
        // Evaluator is sending a comment TO a unit. Which unit? target_user_id!
        if ($target_user_id > 0) {
            $u_res = $db->query("SELECT id_unit FROM ta_user WHERE id_user = $target_user_id");
            if ($u_res && $u_row = $u_res->fetch_assoc()) {
                $id_unit = $u_row['id_unit'];
            }
        }
    } else {
        // Unit is sending a comment (replying). They are the evaluator_id (sender).
        if ($evaluator_id > 0) {
            $u_res = $db->query("SELECT id_unit, id_role FROM ta_user WHERE id_user = $evaluator_id");
            if ($u_res && $u_row = $u_res->fetch_assoc()) {
                if (in_array($u_row['id_role'], [1, 5, 14])) {
                    $id_unit = $u_row['id_unit'];
                }
            }
        }
    }
    
    if ($id_unit && $id_unit > 0) {
        $db->query("UPDATE komentar_evaluasi SET id_unit = $id_unit WHERE id = $id");
        echo "Patched Comment ID $id with Unit ID $id_unit\n";
        $count++;
    } else {
        echo "Could not resolve Unit ID for Comment ID $id\n";
    }
}

echo "Done! Patched $count comments.\n";

$db->close();
?>
